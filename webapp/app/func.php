<?php 
function db_connect(){
    try {
        $pdo = new PDO('mysql:dbname=posse;host=db','root','password');
      } catch (PDOException $e) {
        exit('接続失敗:'.$e->getMessage());
      }
    return $pdo;
}

function insert_data(array $data, string $index){
  if($data[$index] === null){
    echo 0;
  } else {
    echo $data[$index];
  }
}
