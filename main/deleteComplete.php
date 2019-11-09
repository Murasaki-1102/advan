<?php
session_start();

header("Content-type: text/html; charset=utf-8");

//クリックジャッキング対策
header('X-FRAME-OPTIONS: SAMEORIGIN');

//データベース接続
require_once("../database/db.php");
$dbh = db_connect();

$name = $_GET['name'];

try{
    //例外処理を投げる（スロー）ようにする
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $dbh->beginTransaction();

    $statement = $dbh->prepare("DELETE FROM equipments WHERE name='$name'");

    $statement->execute();

    $dbh->commit();

    //データベース接続切断
    $dbh = null;

    header("Location: /");

  }catch (PDOException $e){
    print('Error:'.$e->getMessage());
    exit();
  }

?>
