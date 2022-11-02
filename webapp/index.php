<?php
session_start();
require "./app/func.php";
require "./app/getData.php";
require "./app/chart.php";

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>webapp</title>
  <link rel="stylesheet" href="./style/style.css" />
  <script async src="https://platform.twitter.com/widgets.js" charset="utf-8" defer></script>
  <script src="./js/webapp.js" defer></script>
</head>

<body>
  <header>
    <div>
      <img src="./img/header-logo.png" alt="posseロゴ" />
      <p>4th week</p>
    </div>
    <button class="modalShower">記録・投稿</button>
  </header>
  <main>
    <article id="chartArea">
      <section id="columnChartArea">
        <section id="data">
          <div class="datum" id="study_today">
            <p class="dataTitle">Today</p>
            <p class="data_hour">
              <?php
              if ($hours_each_day[date("Y-m-d")] === null) {
                echo 0;
              } else {
                echo intval($hours_each_day[date("Y-m-d")]);
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
                echo intval($hours_month["month"]);
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
                echo intval($hours_total["total"]);
              }
              ?>

            </p>
            <p class="hour">hour</p>
          </div>
        </section>
        <section class="chartContainer">
          <div id="columnChart"></div>
        </section>
      </section>
      <section id="pieChartArea">
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
      </section>
    </article>
    <div class="month">
      <form action="app/changeMonth.php" method="POST">
        <input type="hidden" name="move" value="prev">
        <button class="prev"></button>
      </form>
      <p><?= $shown_year ?>年 <?= $shown_month ?>月</p>
      <form action="app/changeMonth.php" method="POST">
        <input type="hidden" name="move" value="next">
        <button class="next"></button>
      </form>
    </div>

    <button id="button_sp" class="button modalShower">記録・投稿</button>
  </main>

  <!-- モーダル -->
  <section id="modal">
    <form id="modalContent" method="POST" action="./app/post.php">
      <section id="modalClose">&times;</section>
      <div id="formRapper">
        <div id="form_1">
          <p>学習日</p>
          <input type="text" id="date" class="text calendarShower" name="date"/>
          <p>学習コンテンツ（複数選択可）</p>
          <div class="checkboxRapper">
            <div class="checkbox">
              <input type="checkbox" id="N" name="contents[]" value="1"/>
              <label for="N">N予備校</label>
            </div>

            <div class="checkbox">
              <input type="checkbox" id="dotInstall" name="contents[]" value="2"/>
              <label for="dotInstall">ドットインストール</label>
            </div>

            <div class="checkbox">
              <input type="checkbox" id="POSSE" name="contents[]" value="3"/>
              <label for="POSSE">POSSE課題</label>
            </div>

            <div class="checkbox">
              <input type="checkbox" id="otherContent" name="contents[]" value="4"/>
              <label for="otherContent">その他</label>
            </div>
          </div>

          <p>学習言語（複数選択可）</p>
          <div class="checkboxRapper">
            <div class="checkbox">
              <input type="checkbox" id="html" name="languages[]" value="8"/>
              <label for="html">HTML</label>
            </div>

            <div class="checkbox">
              <input type="checkbox" id="css" name="languages[]" value="7"/>
              <label for="css">CSS</label>
            </div>

            <div class="checkbox">
              <input type="checkbox" id="js" name="languages[]" value="6"/>
              <label for="js">JS</label>
            </div>

            <div class="checkbox">
              <input type="checkbox" id="php" name="languages[]" value="5"/>
              <label for="php">PHP</label>
            </div>

            <div class="checkbox">
              <input type="checkbox" id="SQL" name="languages[]" value="4"/>
              <label for="SQL">SQL</label>
            </div>

            <div class="checkbox">
              <input type="checkbox" id="laravel" name="languages[]" value="3"/>
              <label for="laravel">Laravel</label>
            </div>

            <div class="checkbox">
              <input type="checkbox" id="SHELL" name="languages[]" value="2"/>
              <label for="SHELL">SHELL</label>
            </div>

            <div class="checkbox">
              <input type="checkbox" id="others" name="languages[]" value="1"/>
              <label for="others">その他</label>
            </div>
          </div>
        </div>

        <div id="form_2">
          <p>学習時間</p>
          <input type="text" id="learningTime" class="text" name="hours"/>
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
        </a>
        <input type="hidden" name="member_id" value="<?= $member_id ?>">
        <button class="button" id="submitButton">記録・投稿</button>
    </form>
  </section>

  <section id="calendarBackGround">
    <div id="calendarRapper">
      <div class="month">
        <section id="prevCalendar" class="prev"></section>
        <p id="calendarHead"></p>
        <section id="nextCalendar" class="next"></section>
      </div>
      <div id="calendarArea"></div>
      <button id="getDate" class="button">決定</button>
    </div>
  </section>
</body>

</html>