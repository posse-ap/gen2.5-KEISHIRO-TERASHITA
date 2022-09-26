<?php
  
  try {
    //日付関係 表示中の月の一日と翌月の一日を取得
    $today = date("Y-m-d");
    $year = intval(date("Y"));
    $month = intval(date("m"));
    $first_day = (string)$year . "-" . (string)$month . "-01";
    if ($month === 12){
      $next_month = (string)($year + 1) . "-01-01";
    } else {
      $next_month = (string)($year) . "-" . (string)($month + 1) . "-01";
    }

    //データベースに接続
    $pdo = new PDO(
      "mysql:host=db;dbname=posse;charset=utf8mb4",
      "root",
      "password"
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // 誰のデータ？
    $member_id = intval(filter_input(INPUT_GET, "member_id"));

    // to do ダミーデータを一括で入力したい。ランダム？

    // 学習時間の取得
    // 総計
    $stmt = $pdo->prepare("SELECT SUM(hours) total FROM studies WHERE member_id = :member_id");
    $stmt->execute(["member_id" => $member_id]);
    $hours_total = $stmt->fetch(PDO::FETCH_ASSOC);
    // その月
    $stmt = $pdo->prepare(
    "SELECT SUM(hours) month FROM studies 
    WHERE member_id = :member_id 
    AND date >= :first_day 
    AND date < :next_month"
    );
    $stmt->execute(["member_id" => $member_id, "first_day" => $first_day, "next_month" => $next_month]);
    $hours_month = $stmt->fetch(PDO::FETCH_ASSOC);
    // 日毎
    $stmt = $pdo->prepare(
      "SELECT SUM(hours) hours, date FROM studies 
      WHERE member_id = :member_id 
      GROUP BY date
      ORDER BY date ASC"
      );
      $stmt->execute(["member_id" => $member_id]);
      $hours_day = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $hours_each_day = [];
      foreach($hours_day as $day){
        $hours_each_day += [$day["date"] => $day["hours"]];
      }
      // for($day_counter = 1; $day_counter < 32; $day_counter ++){
      //   $the_day = date("Y") . "-" . date("m") . "-" . (string)sprintf("%02d", $day_counter);
      //   if($hours_each_day[$the_day] === null){
      //     echo 0;
      //   } else {
      //     echo $hours_each_day[$the_day];
      //   }
      // }

    // 言語ごと
    $stmt = $pdo->prepare(
      "SELECT SUM(hours) hours, language 
      FROM languages JOIN studies 
      on studies.language_id = languages.id 
      WHERE member_id = :member_id 
      GROUP BY language_id
      ORDER BY language_id DESC"
      );
    $stmt->execute(["member_id" => $member_id]);
    $hours_language = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // コンテンツごと
    $stmt = $pdo->prepare(
      "SELECT SUM(hours) hours, content 
      FROM studies JOIN contents 
      on studies.content_id = contents.id 
      WHERE member_id = :member_id 
      GROUP BY content_id
      ORDER BY content_id DESC"
      );
    $stmt->execute(["member_id" => $member_id]);
    $hours_content = $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    echo $e->getMessage();
  } finally {
    $pdo = null;
  }
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>webapp</title>
    <link rel="stylesheet" href="./style/style.css" />
    <script src="https://www.gstatic.com/charts/loader.js" defer></script>
    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8" defer></script>
    <script src="./js/makeChart.js" defer></script>
    <script src="./js/webapp.js" defer></script>
  </head>
  <body>
    <header>
      <div>
        <img src="./img/header-logo.png" alt="posseロゴ" />
        <p>4th week</p>
      </div>
      <button onclick="showModal()">記録・投稿</button>
    </header>

    <div id="chartArea">
      <div id="columnChartArea">
        <div id="data">
          <div class="datum" id="study_today">
            <p class="dataTitle">Today</p>
            <p class="data_hour">
              <?php
                  if ($hours_each_day[$today] === null){
                    echo 0;
                  } else {
                    echo $hours_each_day[$today];
                  }
              ?>
            </p>
            <p class="hour">hour</p>
          </div>
          <div class="datum" id="study_month">
            <p class="dataTitle">Month</p>
            <p class="data_hour"><?= $hours_month["month"] ?></p>
            <p class="hour">hour</p>
          </div>
          <div class="datum" id="study_total">
            <p class="dataTitle">Total</p>
            <p class="data_hour"><?= $hours_total["total"] ?></p>
            <p class="hour">hour</p>
          </div>
        </div>
        <div class="chartContainer">
          <div id="columnChart"></div>
        </div>
      </div>
      <div id="pieChartArea">
        <div class="chartContainer" id="container_pieChart_language">
          <p class="pieChartTitle">学習言語</p>
          <div id="pieChart_language"></div>
          <div class="pieChartElementsArea">
            <?php foreach($hours_language as $language): ?>
            <div class="pieChartElements">
              <?= $language["language"], "　", $language["hours"] ?>
            </div>
            <?php endforeach ?>
          </div>
        </div>
        <div class="chartContainer" id="container_pieChart_contents">
          <p class="pieChartTitle">学習コンテンツ</p>
          <div id="pieChart_contents"></div>
          <div class="pieChartElementsArea">
            <?php foreach($hours_content as $content): ?>
            <div class="pieChartElements">
              <?= $content["content"], "　", $content["hours"] ?>
            </div>
            <?php endforeach ?>
          </div>
        </div>
      </div>
    </div>
    <div class="month">
      <section class="prev"></section>
      <p><?= $year ?>年 <?= $month ?>月</p>
      <section class="next"></section>
    </div>

    <button onclick="showModal()" id = "button_sp" class="button">記録・投稿</button>

    <!-- モーダル -->
    <div id="modal">
      <div id="modalContent">
        <section id = "modalClose">&times;</section>
        <div id="formRapper">
          <div id="form_1">
            <p>学習日</p>
            <input type="text" id="date" class = "text" onclick="showCalendar()"/>
            <p>学習コンテンツ（複数選択可）</p>
            <div class="checkboxRapper">
              <div class="checkbox">
                <input type="checkbox" id="N" value="N" name="contents" />
                <label for="N">N予備校</label>
              </div>
  
              <div class="checkbox">
                <input type="checkbox" id="dotInstall" value="dotInstall" name="contents"/>
                <label for="dotInstall">ドットインストール</label>
              </div>
  
              <div class="checkbox">
                <input type="checkbox" id="POSSE" value="POSSE" name="contents"/>
                <label for="POSSE">POSSE課題</label>
              </div>
            </div>

            <p>学習言語（複数選択可）</p>
            <div class="checkboxRapper">
              <div class="checkbox">
                <input type="checkbox" id="html" name="language" />
                <label for="html">HTML</label>
              </div>
  
              <div class="checkbox">
                <input type="checkbox" id="css" name="language" />
                <label for="css">CSS</label>
              </div>
  
              <div class="checkbox">
                <input type="checkbox" id="js" name="language" />
                <label for="js">JavaScript</label>
              </div>
  
              <div class="checkbox">
                <input type="checkbox" id="php" name="language" />
                <label for="php">PHP</label>
              </div>
  
              <div class="checkbox">
                <input type="checkbox" id="laravel" name="language" />
                <label for="laravel">Laravel</label>
              </div>
  
              <div class="checkbox">
                <input type="checkbox" id="SQL" name="language" />
                <label for="SQL">SQL</label>
              </div>
  
              <div class="checkbox">
                <input type="checkbox" id="SHELL" name="language" />
                <label for="SHELL">SHELL</label>
              </div>
  
              <div class="checkbox">
                <input type="checkbox" id="others" name="language"/>
                <label for="others">情報システム基礎知識（その他）</label>
            </div>
            </div>
          </div>

          <div id="form_2">
            <p>学習時間</p>
            <input type="text" id="learningTime" class = "text" />
            <p>ツイッター用コメント</p>
            <input type="textarea" name="twitterMessage" id="twitterMessage" class = "textarea" />
            <br />
            <div class="shareButton">
              <input type="checkbox" id = "share" />
              <label for="share">twitterにシェアする</label>
            </div>
          </div>
        </div>
        
        <a href="" target="blank" id="link_share">
          <button class="button" id = "submitButton">記録・投稿</button>
        </a>
      </div>
    </div>

    <div id="calendarBackGround">
      <div id="calendarRapper">
        <div class="month">
          <section class="prev" onclick = "prev()"></section>
          <p id = "calendarHead" onclick = "showDate()"></p>
          <section class="next" onclick = "next()"></section>
        </div>
        <div id="calendarArea"></div>
        <button class="button" onclick="getValueOfDate()">決定</button>
      </div>
    </div>
  </body>
</html>
