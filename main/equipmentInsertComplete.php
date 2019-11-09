<?php
session_start();

header("Content-type: text/html; charset=utf-8");

//クリックジャッキング対策
header('X-FRAME-OPTIONS: SAMEORIGIN');

require_once($_SERVER["DOCUMENT_ROOT"]."/database/db.php");
$dbh = db_connect();

$way = $_SESSION['way'];

$maker = isset($_SESSION['maker']) ? $_SESSION['maker'] : NULL; //三項演算子
$name = isset($_SESSION['name']) ? $_SESSION['name'] : NULL;
$category = isset($_SESSION['category']) ? $_SESSION['category'] : NULL;
$subCategory = isset($_SESSION['subCategory']) ? $_SESSION['subCategory'] : NULL;
$comment = isset($_SESSION['comment']) ? $_SESSION['comment'] : NULL;
$stock = isset($_SESSION['stock']) ? $_SESSION['stock'] : NULL;
$image1 = isset($_SESSION['path'][0]) ? $_SESSION['path'][0] : NULL;
$image2 = isset($_SESSION['path'][1]) ? $_SESSION['path'][1] : NULL;
$image3 = isset($_SESSION['path'][2]) ? $_SESSION['path'][2] : NULL;
$weight = isset($_SESSION['weight']) ? $_SESSION['weight'] : NULL;
$power = isset($_SESSION['power']) ? $_SESSION['power'] : NULL;
$date = date('Y/m/d H:i:s');
$last_user = isset($_SESSION['last_user']) ? $_SESSION['last_user'] : NULL;

if($way == "insert"){

  try{
    //例外処理を投げる（スロー）ようにする
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $dbh->beginTransaction();

    $statement = $dbh->prepare("INSERT INTO equipments (maker,name,category,subCategory,comment,stock,image1,image2,image3,weight,power,date,last_user) VALUES (:maker,:name,:category,:subCategory,:comment,:stock,:image1,:image2,:image3,:weight,:power,now(), :last_user)");

      //プレースホルダへ実際の値を設定する
      $statement->bindValue(':maker', $maker, PDO::PARAM_STR);
      $statement->bindValue(':name', $name, PDO::PARAM_STR);
      $statement->bindValue(':category', $category, PDO::PARAM_STR);
      $statement->bindValue(':subCategory', $subCategory, PDO::PARAM_STR);
      $statement->bindValue(':comment', $comment, PDO::PARAM_STR);
      $statement->bindValue(':stock', $stock, PDO::PARAM_STR);
      $statement->bindValue(':image1', $image1, PDO::PARAM_STR);
      $statement->bindValue(':image2', $image2, PDO::PARAM_STR);
      $statement->bindValue(':image3', $image3, PDO::PARAM_STR);
      $statement->bindValue(':weight', $weight, PDO::PARAM_STR);
      $statement->bindValue(':power', $power, PDO::PARAM_STR);
      $statement->bindValue(':last_user', $last_user, PDO::PARAM_STR);
      $statement->execute();

      $dbh->commit();

      //データベース接続切断
      $dbh = null;

      unset($_SESSION['maker']);
      unset($_SESSION['name']);
      unset($_SESSION['category']);
      unset($_SESSION['subCategory']);
      unset($_SESSION['comment']);
      unset($_SESSION['stock']);
      unset($_SESSION['weight']);
      unset($_SESSION['power']);
      unset($_SESSION['date']);
      unset($_SESSION['path']);
      unset($_SESSION['last_user']);

      header("Location: /");

    }catch (PDOException $e){
      print('Error:'.$e->getMessage());
      exit();
    }
  }elseif($way == "edit"){
    
    try{
      //例外処理を投げる（スロー）ようにする
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $dbh->beginTransaction();

      $statement = $dbh->prepare("UPDATE equipments set maker=:maker,name=:name,category=:category,subCategory=:subCategory,comment=:comment,stock=:stock,image1=:image1,image2=:image2,image3=:image3,weight=:weight,power=:power,date=now(),last_user=:last_user WHERE name='$name'");

      //プレースホルダへ実際の値を設定する
      $statement->bindValue(':maker', $maker, PDO::PARAM_STR);
      $statement->bindValue(':name', $name, PDO::PARAM_STR);
      $statement->bindValue(':category', $category, PDO::PARAM_STR);
      $statement->bindValue(':subCategory', $subCategory, PDO::PARAM_STR);
      $statement->bindValue(':comment', $comment, PDO::PARAM_STR);
      $statement->bindValue(':stock', $stock, PDO::PARAM_STR);
      $statement->bindValue(':image1', $image1, PDO::PARAM_STR);
      $statement->bindValue(':image2', $image2, PDO::PARAM_STR);
      $statement->bindValue(':image3', $image3, PDO::PARAM_STR);
      $statement->bindValue(':weight', $weight, PDO::PARAM_STR);
      $statement->bindValue(':power', $power, PDO::PARAM_STR);
      $statement->bindValue(':last_user', $last_user, PDO::PARAM_STR);
      $statement->execute();

      $dbh->commit();

      //データベース接続切断
      $dbh = null;
      unset($_SESSION['maker']);
      unset($_SESSION['name']);
      unset($_SESSION['category']);
      unset($_SESSION['subCategory']);
      unset($_SESSION['comment']);
      unset($_SESSION['stock']);
      unset($_SESSION['weight']);
      unset($_SESSION['power']);
      unset($_SESSION['date']);
      unset($_SESSION['path']);
      unset($_SESSION['last_user']);

      header("Location: /");

    }catch (PDOException $e){
      print('Error:'.$e->getMessage());
      exit();
    }
  }
?>
