<?php
session_start();

header("Content-type: text/html; charset=utf-8");

//クリックジャッキング対策
header('X-FRAME-OPTIONS: SAMEORIGIN');

//データベース接続
require_once("../database/db.php");
$dbh = db_connect();

//エラーメッセージの初期化
$errors = array();

$genre = $_GET['genre'];
$name = $_GET['name'];

if($genre == "Sound"){
  $table = "sound_equipments";
}elseif($genre == "Stage"){
  $table = "stage_equipments";
}elseif($genre == "Light"){
  $table = "light_equipments";
}

if (count($errors) === 0){

  try{
    //例外処理を投げる（スロー）ようにする
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $dbh->beginTransaction();

    $statement = $dbh->prepare("DELETE FROM $table WHERE name='$name'");

    $statement->execute();

    $dbh->commit();

    //データベース接続切断
    $dbh = null;

    header("Location: list.php?genre=$genre");
  }catch (PDOException $e){
    print('Error:'.$e->getMessage());
    exit();
  }
}
?>
