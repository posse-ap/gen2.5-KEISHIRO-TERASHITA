<?php
// db接続
$pdo = db_connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// 誰のデータ？
$member_id = intval(filter_input(INPUT_GET, "member_id"));
// いつを表示？
if(filter_input(INPUT_GET, "year")){
  $shown_year = intval(filter_input(INPUT_GET, "year"));
} else {
  $shown_year = intval(DATE('Y'));
}
if(filter_input(INPUT_GET, "month")){
  $shown_month = intval(filter_input(INPUT_GET, "month"));
} else {
  $shown_month = intval(DATE('m'));
}
if(filter_input(INPUT_GET, "gap")){
  $gap = intval(filter_input(INPUT_GET, "gap"));
} else {
  $gap = 0;
}
// 学習時間の取得 TODO func.php 内で関数化し、ここでは呼び出すだけにしたい
// 総計
$stmt = $pdo->prepare("SELECT SUM(hours) total FROM studies WHERE member_id = :member_id");
$stmt->execute(["member_id" => $member_id]);
$hours_total = $stmt->fetch(PDO::FETCH_ASSOC);
// 表示中の月
$stmt = $pdo->prepare(
  "SELECT SUM(hours) month FROM studies 
  WHERE member_id = :member_id 
  AND YEAR(date) = :shown_year  
  AND MONTH(date) = :shown_month"
);
$stmt->execute(["member_id" => $member_id, "shown_year" => $shown_year, "shown_month" => $shown_month]);
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
foreach ($hours_day as $day) {
  $hours_each_day += [$day["date"] => $day["hours"]];
}
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
$hours_each_language = [];
foreach ($hours_language as $language) {
  $hours_each_language += [$language["language"] => $language["hours"]];
}
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
$hours_each_content = [];
foreach ($hours_content as $content) {
  $hours_each_content += [$content["content"] => $content["hours"]];
}
