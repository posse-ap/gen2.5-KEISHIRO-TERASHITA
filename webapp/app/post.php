<?php
require './func.php';
session_start();
$data = [];
$hour = $_POST['hours'] / (count($_POST['contents']) * count($_POST['languages']));

foreach ($_POST['contents'] as $content)
{
  foreach ($_POST['languages'] as $language)
  {
    $datum = [
      'member_id' => $_POST['member_id'],
      'language_id' => $language,
      'content_id' => $content,
      'hours' => $hour,
      'date' => $_POST['date']
    ];
    array_push($data, $datum);
  }
}

$pdo = db_connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
foreach ($data as $datum) {
  $stmt = $pdo->prepare(
    'INSERT INTO studies 
    (member_id, language_id, content_id, hours, date) VALUES
    (:member_id, :language_id, :content_id, :hours, :date)'
  );
  $stmt->execute(['member_id' => $datum['member_id'], 'language_id' => $datum['language_id'], 'content_id' => $datum['content_id'], 'hours' => $datum['hours'], 'date' => $datum['date']]);
}

header('Location: ../index.php');
