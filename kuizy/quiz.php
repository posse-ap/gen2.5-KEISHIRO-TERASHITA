<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <?php 
$id = filter_input(INPUT_GET, "id");
if ($id === "1"){ ?>
  <title>東京の難読地名クイズ</title>
  <?php }
if ($id === "2"){ ?>
<title>広島県の難読地名クイズ</title>
<?php } ?>

</head>
<body>
</body>
</html>