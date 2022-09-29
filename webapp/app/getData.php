<?php
//日付関係 表示中の月の一日と翌月の一日を取得
$first_day = date("Y-m") . "-01";
$next_month = date("Y-m", strtotime("+1 month")) . "-01";
// db接続
$pdo = db_connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// 誰のデータ？
$member_id = intval(filter_input(INPUT_GET, "member_id"));
// 学習時間の取得
// 総計
$stmt = $pdo->prepare("SELECT SUM(hours) total FROM studies WHERE member_id = :member_id");
$stmt->execute(["member_id" => $member_id]);
$hours_total = $stmt->fetch(PDO::FETCH_ASSOC);
// 今月
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
