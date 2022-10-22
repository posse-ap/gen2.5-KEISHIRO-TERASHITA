<?php
session_start();
// db接続
$pdo = db_connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// sqlのWHERE句で使う
$requested = [];

// 誰のデータ？ TODO
$_SESSION['member_id'] = 1;
$member_id = $_SESSION['member_id'];
$requested['member_id'] = $_SESSION['member_id'];

// いつを表示？ TODO
if ($_SESSION['shown_year'] === null){
  $_SESSION['shown_year'] = intval(DATE('Y'));
  $_SESSION['shown_month'] = intval(DATE('m'));
}
$shown_year = $_SESSION['shown_year'];
$requested['shown_year'] = $_SESSION['shown_year'];
$shown_month = $_SESSION['shown_month'];
$requested['shown_month'] = $_SESSION['shown_month'];

if(filter_input(INPUT_GET, "gap")){
  $gap = intval(filter_input(INPUT_GET, "gap"));
} else {
  $gap = 0;
}
// 学習時間の取得
// 総計
$hours_total = get_hours_total($pdo, $requested);
// 表示中の月
$hours_month = get_hours_month($pdo, $requested);
// 日毎
$hours_each_day = get_hours_day($pdo, $requested);
// 言語ごと
$hours_each_language = get_hours_language($pdo, $requested);
// コンテンツごと
$hours_each_content = get_hours_contents($pdo, $requested);
