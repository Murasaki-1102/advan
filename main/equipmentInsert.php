<?php
session_start();

header("Content-type: text/html; charset=utf-8");

//クリックジャッキング対策
header('X-FRAME-OPTIONS: SAMEORIGIN');

if(!isset($_SESSION['login'])){
  header("Location: ../auth/login.php");
}

$_SESSION['way'] = "insert";

include($_SERVER["DOCUMENT_ROOT"] ."/main/equipmentInsert-page.php");
?>

