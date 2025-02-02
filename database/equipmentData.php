<?php

require_once("equipment.php");

//データベース接続
require_once("db.php");
$dbh = db_connect();

function returnAll() {
  global $dbh;
  try{
    //例外処理を投げる（スロー）ようにする
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $name = "";

    $statement = $dbh->prepare("SELECT * FROM equipments ORDER BY date DESC");
    $statement->bindValue(':name', $name, PDO::PARAM_STR);
    $statement->execute();

    $rows = $statement->fetchAll();

    $i = 0;
    foreach ($rows as $row) {
      $maker = $row['maker'];
      $name = $row['name'];
      $category = $row['category'];
      $subCategory = $row['subCategory'];
      $comment = $row['comment'];
      $stock = $row['stock'];
      $img1 = $row['image1'];
      $img2 = $row['image2'];
      $img3 = $row['image3'];
      $weight = $row['weight'];
      $power = $row['power'];
      $date = $row['date'];
      $last_user = $row['last_user'];
      ${"equipment".$i} = new equipment($maker,$name,$category,$subCategory,$comment,$stock,$img1,$img2,$img3,$weight,$power,$date,$last_user);

      $equipments[] = ${"equipment".$i};
      $i++;
    }
  }catch (PDOException $e){
  print('Error:'.$e->getMessage());
  exit();
  }

  return $equipments;
}

function returnSound () {
  global $dbh;
  try{
    //例外処理を投げる（スロー）ようにする
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $name="";
    $statement = $dbh->prepare("SELECT * FROM equipments WHERE category LIKE 'Sound' ORDER BY date DESC");
    $statement->bindValue(':name', $name, PDO::PARAM_STR);
    $statement->execute();

    $rows = $statement->fetchAll();

    $i = 0;
    foreach ($rows as $row) {
      $maker = $row['maker'];
      $name = $row['name'];
      $category = $row['category'];
      $subCategory = $row['subCategory'];
      $comment = $row['comment'];
      $stock = $row['stock'];
      $img1 = $row['image1'];
      $img2 = $row['image2'];
      $img3 = $row['image3'];
      $weight = $row['weight'];
      $power = $row['power'];
      $date = $row['date'];
      $last_user = $row['last_user'];
      ${"equipment".$i} = new equipment($maker,$name,$category,$subCategory,$comment,$stock,$img1,$img2,$img3,$weight,$power,$date,$last_user);

      $equipments[] = ${"equipment".$i};
      $i++;
    }
  }catch (PDOException $e){
  print('Error:'.$e->getMessage());
  exit();
  }

  return $equipments;
}

function returnStage() {
  global $dbh;
  try{
    //例外処理を投げる（スロー）ようにする
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $name = "";

    $statement = $dbh->prepare("SELECT * FROM equipments WHERE category LIKE 'Stage' ORDER BY date DESC");
    $statement->bindValue(':name', $name, PDO::PARAM_STR);
    $statement->execute();

    $rows = $statement->fetchAll();

    $i = 0;
    foreach ($rows as $row) {

      $maker = $row['maker'];
      $name = $row['name'];
      $category = $row['category'];
      $subCategory = $row['subCategory'];
      $comment = $row['comment'];
      $stock = $row['stock'];
      $img1 = $row['image1'];
      $img2 = $row['image2'];
      $img3 = $row['image3'];
      $weight = $row['weight'];
      $power = $row['power'];
      $date = $row['date'];
      $last_user = $row['last_user'];
      ${"equipment".$i} = new equipment($maker,$name,$category,$subCategory,$comment,$stock,$img1,$img2,$img3,$weight,$power,$date,$last_user);

      $equipments[] = ${"equipment".$i};
      $i++;
    }
  }catch (PDOException $e){
  print('Error:'.$e->getMessage());
  exit();
  }

  return $equipments;
}

function returnLight() {
  global $dbh;
  try{
    //例外処理を投げる（スロー）ようにする
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $name = "";

    $statement = $dbh->prepare("SELECT * FROM equipments WHERE category LIKE 'Light' ORDER BY date DESC");
    $statement->bindValue(':name', $name, PDO::PARAM_STR);
    $statement->execute();

    $rows = $statement->fetchAll();

    $i = 0;
    foreach ($rows as $row) {

      $maker = $row['maker'];
      $name = $row['name'];
      $category = $row['category'];
      $subCategory = $row['subCategory'];
      $comment = $row['comment'];
      $stock = $row['stock'];
      $img1 = $row['image1'];
      $img2 = $row['image2'];
      $img3 = $row['image3'];
      $weight = $row['weight'];
      $power = $row['power'];
      $date = $row['date'];
      $last_user = $row['last_user'];
      ${"equipment".$i} = new equipment($maker,$name,$category,$subCategory,$comment,$stock,$img1,$img2,$img3,$weight,$power,$date,$last_user);

      $equipments[] = ${"equipment".$i};
      $i++;
    }
  }catch (PDOException $e){
  print('Error:'.$e->getMessage());
  exit();
  }

  return $equipments;
}

function returnOther() {
  global $dbh;
  try{
    //例外処理を投げる（スロー）ようにする
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $name = "";

    $statement = $dbh->prepare("SELECT * FROM equipments WHERE category LIKE 'Other' ORDER BY date DESC");
    $statement->bindValue(':name', $name, PDO::PARAM_STR);
    $statement->execute();

    $rows = $statement->fetchAll();

    $i = 0;
    foreach ($rows as $row) {

      $maker = $row['maker'];
      $name = $row['name'];
      $category = $row['category'];
      $subCategory = $row['subCategory'];
      $comment = $row['comment'];
      $stock = $row['stock'];
      $img1 = $row['image1'];
      $img2 = $row['image2'];
      $img3 = $row['image3'];
      $weight = $row['weight'];
      $power = $row['power'];
      $date = $row['date'];
      $last_user = $row['last_user'];
      ${"equipment".$i} = new equipment($maker,$name,$category,$subCategory,$comment,$stock,$img1,$img2,$img3,$weight,$power,$date,$last_user);

      $equipments[] = ${"equipment".$i};
      $i++;
    }
  }catch (PDOException $e){
  print('Error:'.$e->getMessage());
  exit();
  }

  return $equipments;
}
?>