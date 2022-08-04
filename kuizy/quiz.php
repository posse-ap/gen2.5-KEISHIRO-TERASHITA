<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <?php 

try{
  $id = (int)filter_input(INPUT_GET, "id");
  //データベースに接続
  $pdo = new PDO (
    "mysql:host=db;dbname=posse;charset=utf8mb4",
    "root",
    "root"
  );
  // $stmt = $pdo->query("SHOW TABLES FROM posse");
  $stmt = $pdo->prepare("SELECT name from posse.big_questions WHERE id = :n");
  $stmt->execute(["n"=>(int)$id]);
  $title = $stmt->fetch();
}catch(PDOException $e) {
  echo $e->getMessage();
}
?>
  <title>
    <?= $title["name"] ?>
  </title>
  
</head>
<body>
</body>
</html>
