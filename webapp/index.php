<?php
require "./app/func.php";
require "./app/getData.php";
require "./app/chart.php";

$pre = [
  DATE('Y', strtotime((string)($gap - 1) . ' month')), 
  DATE('m', strtotime((string)($gap - 1) . ' month'))
];
$pre_link = make_pre_link($gap, $pre);
$next = [
  DATE('Y', strtotime((string)($gap + 1) . ' month')), 
  DATE('m', strtotime((string)($gap + 1) . ' month'))
];
$next_link = make_next_link($gap, $next);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>webapp</title>
  <link rel="stylesheet" href="./style/style.css" />
  <!-- <script src="https://www.gstatic.com/charts/loader.js" defer></script> -->
  <script async src="https://platform.twitter.com/widgets.js" charset="utf-8" defer></script>
  <!-- <script src="./js/makeChart.js" defer></script> -->
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
            if ($hours_each_day[date("Y-m-d")] === null) {
              echo 0;
            } else {
              echo $hours_each_day[date("Y-m-d")];
            }
            ?>
          </p>
          <p class="hour">hour</p>
        </div>
        <div class="datum" id="study_month">
          <p class="dataTitle">Month</p>
          <p class="data_hour">
            <?php
            if ($hours_month["month"] === null) {
              echo 0;
            } else {
              echo $hours_month["month"];
            }
            ?>
          </p>
          <p class="hour">hour</p>
        </div>
        <div class="datum" id="study_total">
          <p class="dataTitle">Total</p>
          <p class="data_hour">

            <?php
            if ($hours_total["total"] === null) {
              echo 0;
            } else {
              echo $hours_total["total"];
            }
            ?>

          </p>
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

          <?php foreach ($hours_each_language as $language => $hour) : ?>
            <div class="pieChartElements">
              <?= $language, "　" ?>
            </div>
          <?php endforeach ?>

        </div>
      </div>
      <div class="chartContainer" id="container_pieChart_contents">
        <p class="pieChartTitle">学習コンテンツ</p>
        <div id="pieChart_contents"></div>
        <div class="pieChartElementsArea">
          <?php foreach ($hours_each_content as $content => $hour) : ?>
            <div class="pieChartElements">
              <?= $content, "　" ?>
            </div>
          <?php endforeach ?>
        </div>
      </div>
    </div>
  </div>
  <div class="month">
    <!-- <a class="prev" href="<?= $pre_link ?>"></a> -->
    <form action="" method="POST">
      <input type="hidden" name="move" value="prev">
      <button class="prev"></button>
    </form>
    <p><?= $shown_year ?>年 <?= $shown_month ?>月</p>
    <!-- <a class="next" href="<?= $next_link ?>"></a> -->
    <form action="" method="POST">
      <input type="hidden" name="move" value="next">
      <button class="next"></button>
    </form>
  </div>

  <button onclick="showModal()" id="button_sp" class="button">記録・投稿</button>

  <!-- モーダル -->
  <div id="modal">
    <div id="modalContent">
      <section id="modalClose">&times;</section>
      <div id="formRapper">
        <div id="form_1">
          <p>学習日</p>
          <input type="text" id="date" class="text" onclick="showCalendar()" />
          <p>学習コンテンツ（複数選択可）</p>
          <div class="checkboxRapper">
            <div class="checkbox">
              <input type="checkbox" id="N" value="N" name="contents" />
              <label for="N">N予備校</label>
            </div>

            <div class="checkbox">
              <input type="checkbox" id="dotInstall" value="dotInstall" name="contents" />
              <label for="dotInstall">ドットインストール</label>
            </div>

            <div class="checkbox">
              <input type="checkbox" id="POSSE" value="POSSE" name="contents" />
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
              <input type="checkbox" id="others" name="language" />
              <label for="others">情報システム基礎知識（その他）</label>
            </div>
          </div>
        </div>

        <div id="form_2">
          <p>学習時間</p>
          <input type="text" id="learningTime" class="text" />
          <p>ツイッター用コメント</p>
          <input type="textarea" name="twitterMessage" id="twitterMessage" class="textarea" />
          <br />
          <div class="shareButton">
            <input type="checkbox" id="share" />
            <label for="share">twitterにシェアする</label>
          </div>
        </div>
      </div>

      <a href="" target="blank" id="link_share">
        <button class="button" id="submitButton">記録・投稿</button>
      </a>
    </div>
  </div>

  <div id="calendarBackGround">
    <div id="calendarRapper">
      <div class="month">
        <section class="prev" onclick="prev()"></section>
        <p id="calendarHead" onclick="showDate()"></p>
        <section class="next" onclick="next()"></section>
      </div>
      <div id="calendarArea"></div>
      <button class="button" onclick="getValueOfDate()">決定</button>
    </div>
  </div>
</body>

</html>