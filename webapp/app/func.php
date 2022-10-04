<?php 
function db_connect(){
    try {
        $pdo = new PDO('mysql:dbname=posse;host=db','root','password');
      } catch (PDOException $e) {
        exit('接続失敗:'.$e->getMessage());
      }
    return $pdo;
}


// 学習時間の総計
function get_hours_total($pdo, $requested){
  $stmt = $pdo->prepare("SELECT SUM(hours) total FROM studies WHERE member_id = :member_id");
$stmt->execute(["member_id" => $requested['member_id']]);
return $stmt->fetch(PDO::FETCH_ASSOC);
}
// 表示中の月の学習時間を取得
function get_hours_month($pdo, $requested){
  $stmt = $pdo->prepare(
    "SELECT SUM(hours) month FROM studies 
    WHERE member_id = :member_id 
    AND YEAR(date) = :shown_year  
    AND MONTH(date) = :shown_month"
  );
  $stmt->execute(["member_id" => $requested["member_id"], "shown_year" => $requested["shown_year"], "shown_month" => $requested["shown_month"]]);
  return $stmt->fetch(PDO::FETCH_ASSOC);
}
// 1日ごとの学習時間を取得し、配列として整形する
function get_hours_day($pdo, $requested){
  $stmt = $pdo->prepare(
    "SELECT SUM(hours) hours, date FROM studies 
      WHERE member_id = :member_id 
      GROUP BY date
      ORDER BY date ASC"
  );
  $stmt->execute(["member_id" => $requested['member_id']]);
  $hours_day = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $hours_each_day = [];
  foreach ($hours_day as $day) {
    $hours_each_day += [$day["date"] => $day["hours"]];
  }
  return $hours_each_day;
}
// 言語ごとに学習時間を取得し、配列として整形する
function get_hours_language($pdo, $requested){
  $stmt = $pdo->prepare(
    "SELECT SUM(hours) hours, language 
      FROM languages JOIN studies 
      on studies.language_id = languages.id 
      WHERE member_id = :member_id 
      GROUP BY language_id
      ORDER BY language_id DESC"
  );
  $stmt->execute(["member_id" => $requested['member_id']]);
  $hours_language = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $hours_each_language = [];
  foreach ($hours_language as $language) {
    $hours_each_language += [$language["language"] => $language["hours"]];
  }
  return $hours_each_language;
}
// コンテンツごとに学習時間を取得し、配列として整形する
function get_hours_contents($pdo, $requested){
  $stmt = $pdo->prepare(
    "SELECT SUM(hours) hours, content 
      FROM studies JOIN contents 
      on studies.content_id = contents.id 
      WHERE member_id = :member_id 
      GROUP BY content_id
      ORDER BY content_id DESC"
  );
  $stmt->execute(["member_id" => $requested['member_id']]);
  $hours_content = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $hours_each_content = [];
  foreach ($hours_content as $content) {
    $hours_each_content += [$content["content"] => $content["hours"]];
  }
  return $hours_each_content;
}

// グラフなどにデータを挿入する
function insert_data(array $data, string $index){
  if($data[$index] === null){
    echo 0;
  } else {
    echo $data[$index];
  }
}

//99以下の自然数を二桁の形の文字列にして返す
function num_to_str(int $num){
  if ($num < 10){
    $str = '0' . (string)$num;
  } else {
    $str = (string)$num;
  }
  return $str;
}

// ↓多分もうお役御免の２つ
function make_pre_link($gap, $pre){
  $gap = $gap - 1;
  $year = $pre[0];
  $month = $pre[1];
  return '?member_id=1&year=' . (string)$year . '&month=' . (string)$month . '&gap=' . (string)$gap;
}
function make_next_link($gap, $next){
  $gap = $gap + 1;
  $year = $next[0];
  $month = $next[1];
  return '?member_id=1&year=' . (string)$year . '&month=' . (string)$month . '&gap=' . (string)$gap;
}
