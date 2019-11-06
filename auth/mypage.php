<?php
session_start();

header("Content-type: text/html; charset=utf-8");

if(!isset($_SESSION['login'])){
  header("Location: login.php");
  exit();
}

$mailAdress = $_SESSION['mailAdress'];

//データベース接続
require_once($_SERVER["DOCUMENT_ROOT"]."/database/db.php");
$dbh = db_connect();

try{
  //例外処理を投げる（スロー）ようにする
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  //アカウントで検索
  $statement = $dbh->prepare("SELECT * FROM member WHERE mailAdress=(:mailAdress) AND flag =1");
  $statement->bindValue(':mailAdress', $mailAdress, PDO::PARAM_STR);
  $statement->execute();

  if($row = $statement->fetch()){
    $account = $row['account'];
  }

}catch (PDOException $e){
  print('Error:'.$e->getMessage());
  exit();
}

include($_SERVER["DOCUMENT_ROOT"] ."/auth/mypage-page.php");
?>
