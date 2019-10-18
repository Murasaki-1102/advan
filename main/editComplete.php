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

$maker = spaceTrim($maker);
$name = spaceTrim($name);
$comment = spaceTrim($comment);
$stock = spaceTrim($stock);
$weight = spaceTrim($weight);
$power = spaceTrim($power);

$src = array();

if(isset($_FILES['img']) && is_array($_FILES['img']['error'])) {
  foreach($_FILES['img']['error'] as $k => $error) {
    try{
      // 更に配列がネストしていれば不正とする
      if (!is_int($error)) {
        throw new RuntimeException("[{$k}] パラメータが不正です");
      }

      // $_FILES['img']['error'] の値を確認
      switch ($error) {
        case UPLOAD_ERR_OK: // OK
        break;
        case UPLOAD_ERR_NO_FILE:   // ファイル未選択
        continue 2;
        case UPLOAD_ERR_INI_SIZE:  // php.ini定義の最大サイズ超過
        case UPLOAD_ERR_FORM_SIZE: // フォーム定義の最大サイズ超過
        throw new RuntimeException("[{$k}] ファイルサイズが大きすぎます");
        default:
        throw new RuntimeException('その他のエラーが発生しました');
      }

      // $_FILES['img']['mime']の値はブラウザ側で偽装可能なので
      // MIMEタイプを自前でチェックする
      if (!$info = @getimagesize($_FILES['img']['tmp_name'][$k])) {
        throw new RuntimeException("[{$k}] 有効な画像ファイルを指定してください");
      }
      //$info[2]はIMAGETYPE_XXX定数
      // 1 IMAGETYPE_GIF
      // 2 IMAGETYPE_JPEG
      // 3 IMAGETYPE_PNG
      if (!in_array($info[2], [IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG], true)) {
        throw new RuntimeException("[{$k}] 未対応の画像形式です");
      }

      // 元画像リソースを生成
      if($info[2] == IMAGETYPE_GIF){
        $result = imagecreatefromgif($_FILES['img']['tmp_name'][$k]);
      }elseif($info[2] == IMAGETYPE_JPEG){
        $result = imagecreatefromjpeg($_FILES['img']['tmp_name'][$k]);
      }elseif($info[2] == IMAGETYPE_PNG){
        $result = imagecreatefrompng($_FILES['img']['tmp_name'][$k]);
      }


      if(!$result){
        throw new RuntimeException("[{$k}] 画像リソースの生成に失敗しました");
      }
      // 保存先ディレクトリ、ファイル名
      $save_dir = "./upload_img/";
      $filename = date("YmdHis")."_{$k}".image_type_to_extension($info[2]);
      $img_result = $save_dir.$filename;

      // 画像の保存
      if($info[2] == IMAGETYPE_GIF){
        $save_result = imagegif($result, $save_dir.$filename);
        $src[] = $img_result;
        $_SESSION["path"] = $src;
      }elseif($info[2] == IMAGETYPE_JPEG){
        $save_result = imagejpeg($result, $save_dir.$filename);
        $src[] = $img_result;
        $_SESSION["path"] = $src;
      }elseif($info[2] == IMAGETYPE_PNG){
        $save_result = imagepng($result, $save_dir.$filename);
        $src[] = $img_result;
        $_SESSION['path'] = $src;

      }
      if(!$save_result){
        throw new RuntimeException("[{$k}] ファイル保存時にエラーが発生しました");
      }

      //  $_SESSION['path'] = $src[]

      $msg = ['green', 'ファイルは正常にアップロードされました'];
    } catch (RuntimeException $e) {
      $msg = ['red', $e->getMessage()];
    }
  }
}

if (count($errors) === 0){

  //ここでデータベースに登録する
  try{
    //例外処理を投げる（スロー）ようにする
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $dbh->beginTransaction();

    $statement = $dbh->prepare("UPDATE  $table set (maker,name,category,comment,stock,image1,image2,image3,weight,power,date) VALUES (:maker,:name,:category,:comment,:stock,:image1,:image2,:image3,:weight,:power,now() )");

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
    $dbh = null;

    header("Location: list.php?genre=$genre");
  }catch (PDOException $e){
    print('Error:'.$e->getMessage());
    exit();
  }

}

?>
