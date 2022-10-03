<?php 
function db_connect(){
    try {
        $pdo = new PDO('mysql:dbname=posse;host=db','root','password');
      } catch (PDOException $e) {
        exit('接続失敗:'.$e->getMessage());
      }
    return $pdo;
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
