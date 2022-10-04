<?php
// db接続
$pdo = db_connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// sqlのWHERE句で使う
$requested = [];

// 誰のデータ？ TODO セッションにしたいな
$member_id = intval(filter_input(INPUT_GET, "member_id"));
$requested['member_id'] = intval(filter_input(INPUT_GET, "member_id"));

// いつを表示？ TODO セッションにしたいな
if(filter_input(INPUT_GET, "year")){
  $shown_year = intval(filter_input(INPUT_GET, "year"));
  $requested['shown_year'] = intval(filter_input(INPUT_GET, "year"));
} else {
  $shown_year = intval(DATE('Y'));
  $requested['shown_year'] = intval(DATE('Y'));
}
if(filter_input(INPUT_GET, "month")){
  $shown_month = intval(filter_input(INPUT_GET, "month"));
  $requested['shown_month'] = intval(filter_input(INPUT_GET, "month"));
} else {
  $shown_month = intval(DATE('m'));
  $requested['shown_month'] = intval(DATE('m'));
}
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
