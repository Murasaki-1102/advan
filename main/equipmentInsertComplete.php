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
if($genre == "Sound"){
  $table = "sound_equipments";
}elseif($genre == "Stage"){
  $table = "stage_equipments";
}elseif($genre == "Light"){
  $table = "light_equipments";
}

$way = $_SESSION['way'];
$maker = isset($_SESSION['maker']) ? $_SESSION['maker'] : NULL; //三項演算子
$name = isset($_SESSION['name']) ? $_SESSION['name'] : NULL;
$category = isset($_SESSION['category']) ? $_SESSION['category'] : NULL;
$comment = isset($_SESSION['comment']) ? $_SESSION['comment'] : NULL;
$stock = isset($_SESSION['stock']) ? $_SESSION['stock'] : NULL;
$image1 = isset($_SESSION['path'][0]) ? $_SESSION['path'][0] : NULL;
$image2 = isset($_SESSION['path'][1]) ? $_SESSION['path'][1] : NULL;
$image3 = isset($_SESSION['path'][2]) ? $_SESSION['path'][2] : NULL;
$weight = isset($_SESSION['weight']) ? $_SESSION['weight'] : NULL;
$power = isset($_SESSION['power']) ? $_SESSION['power'] : NULL;
$date = date('Y/m/d H:i:s');


if (count($errors) === 0){
  if($way == "insert"){
    //ここでデータベースに登録する
    try{
      //例外処理を投げる（スロー）ようにする
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $dbh->beginTransaction();

      $statement = $dbh->prepare("INSERT INTO $table (maker,name,category,comment,stock,image1,image2,image3,weight,power,date) VALUES (:maker,:name,:category,:comment,:stock,:image1,:image2,:image3,:weight,:power,now() )");

      //プレースホルダへ実際の値を設定する
      $statement->bindValue(':maker', $maker, PDO::PARAM_STR);
      $statement->bindValue(':name', $name, PDO::PARAM_STR);
      $statement->bindValue(':category', $category, PDO::PARAM_STR);
      $statement->bindValue(':comment', $comment, PDO::PARAM_STR);
      $statement->bindValue(':stock', $stock, PDO::PARAM_STR);
      $statement->bindValue(':image1', $image1, PDO::PARAM_STR);
      $statement->bindValue(':image2', $image2, PDO::PARAM_STR);
      $statement->bindValue(':image3', $image3, PDO::PARAM_STR);
      $statement->bindValue(':weight', $weight, PDO::PARAM_STR);
      $statement->bindValue(':power', $power, PDO::PARAM_STR);
      $statement->execute();

      $dbh->commit();

      //データベース接続切断
      $dbh = null;//セッション変数を全て解除
      $_SESSION = array();

      //セッションクッキーの削除
      if (isset($_COOKIE["PHPSESSID"])) {
        setcookie("PHPSESSID", '', time() - 1800, '/');
      }

      //セッションを破棄する
      session_destroy();

      header("Location: http://localhost/advan/main/list.php?genre=$genre");

      //$_SESSION['login'] = "login";

    }catch (PDOException $e){
      print('Error:'.$e->getMessage());
      exit();
    }
  }elseif($way == "edit"){
    //ここでデータベースに登録する
    try{
      //例外処理を投げる（スロー）ようにする
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $dbh->beginTransaction();

      $statement = $dbh->prepare("UPDATE $table set maker=:maker,name=:name,category=:category,comment=:comment,stock=:stock,image1=:image1,image2=:image2,image3=:image3,weight=:weight,power=:power,date=now() WHERE name='$name'");


      //プレースホルダへ実際の値を設定する
      $statement->bindValue(':maker', $maker, PDO::PARAM_STR);
      $statement->bindValue(':name', $name, PDO::PARAM_STR);
      $statement->bindValue(':category', $category, PDO::PARAM_STR);
      $statement->bindValue(':comment', $comment, PDO::PARAM_STR);
      $statement->bindValue(':stock', $stock, PDO::PARAM_STR);
      $statement->bindValue(':image1', $image1, PDO::PARAM_STR);
      $statement->bindValue(':image2', $image2, PDO::PARAM_STR);
      $statement->bindValue(':image3', $image3, PDO::PARAM_STR);
      $statement->bindValue(':weight', $weight, PDO::PARAM_STR);
      $statement->bindValue(':power', $power, PDO::PARAM_STR);
      $statement->execute();

      $dbh->commit();

      //データベース接続切断
      $dbh = null;//セッション変数を全て解除
      $_SESSION = array();

      //セッションクッキーの削除
      if (isset($_COOKIE["PHPSESSID"])) {
        setcookie("PHPSESSID", '', time() - 1800, '/');
      }

      //セッションを破棄する
      session_destroy();

      //$_SESSION['login'] = "login";
      header("Location: http://localhost/advan/main/list.php?genre=$genre");

    }catch (PDOException $e){
      print('Error:'.$e->getMessage());
      exit();
    }
  }
}
?>
