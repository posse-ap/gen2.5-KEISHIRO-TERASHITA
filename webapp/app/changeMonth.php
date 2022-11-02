<?php
session_start();
switch ($_POST['move']) {
  case 'prev' :
    if ($_SESSION['shown_month'] === 1) {
      $_SESSION['shown_month'] = 12;
      $_SESSION['shown_year'] --;
    } else {
      $_SESSION['shown_month'] --;
    }
    break;

  case 'next' :
    if ($_SESSION['shown_month'] === 12) {
      $_SESSION['shown_month'] = 1;
      $_SESSION['shown_year'] ++;
    } else {
      $_SESSION['shown_month'] ++;
    }
    break;
}

header('Location: ../index.php');
