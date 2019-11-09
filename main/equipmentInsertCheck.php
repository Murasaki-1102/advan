<?php
session_start();

header("Content-type: text/html; charset=utf-8");

//クリックジャッキング対策
header('X-FRAME-OPTIONS: SAMEORIGIN');

//前後にある半角全角スペースを削除する関数
function spaceTrim ($str)
{
  // 行頭
  $str = preg_replace('/^[ 　]+/u', '', $str);
  // 末尾
  $str = preg_replace('/[ 　]+$/u', '', $str);
  return $str;
}

$way = $_SESSION['way'];

if(empty($_POST)) {
  header("Location: /");
  exit();
}else{

  //POSTされたデータを変数に入れる
  $maker = spaceTrim(isset($_POST['maker']) ? $_POST['maker'] : NULL); //三項演算子
  $name = spaceTrim(isset($_POST['name']) ? $_POST['name'] : NULL);
  $category = isset($_POST['category']) ? $_POST['category'] : NULL;
  $subCategory = isset($_POST['subCategory']) ? $_POST['subCategory'] : NULL;
  $comment = spaceTrim(isset($_POST['comment']) ? $_POST['comment'] : NULL);
  $stock = spaceTrim(isset($_POST['stock']) ? $_POST['stock'] : NULL);
  $weight = spaceTrim(isset($_POST['weight']) ? $_POST['weight'] : NULL);
  $power = spaceTrim(isset($_POST['power']) ? $_POST['power'] : NULL);
  $img = isset($_POST['img[]']) ? $_POST['img[]'] : NULL;
	$date = date('Y/m/d H:i:s');

  $_SESSION['maker'] = $maker;
  $_SESSION['name'] = $name;
  $_SESSION['category'] = $category;
  $_SESSION['subCategory'] = $subCategory;
  $_SESSION['comment'] = $comment;
  $_SESSION['stock'] = $stock;
  $_SESSION['weight'] = $weight;
  $_SESSION['power'] = $power;
	$_SESSION['date'] = $date;

  $_SESSION['path'] = "";

  $src = array();
	$path = array();

	$mailAdress = $_SESSION['mailAdress'];

	//データベース接続
  require_once($_SERVER["DOCUMENT_ROOT"]."/database/db.php");
	$dbh = db_connect();

	$statement = $dbh->prepare("SELECT * FROM member WHERE mailAdress=(:mailAdress) AND flag =1");
  $statement->bindValue(':mailAdress', $mailAdress, PDO::PARAM_STR);
  $statement->execute();

  if($row = $statement->fetch()){
    $last_user = $row['account'];
		$_SESSION['last_user'] = $last_user;
	}

  if(empty($_FILES['img']['name'][0])){
    try{
      //例外処理を投げる（スロー）ようにする
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      //アカウントで検索
      $statement = $dbh->prepare("SELECT * FROM equipments WHERE name = '$name'");
      $statement->bindValue(':name', $name, PDO::PARAM_STR);
      $statement->execute();
			// 既に画像がアップロードされてる場合
      if($rows = $statement->fetch()){
        if(!empty($rows['image1'])){
          $path[] = $rows['image1'];
        }
        if(!empty($rows['image2'])){
          $path[] = $rows['image2'];
        }
        if(!empty($rows['image3'])){
          $path[] = $rows['image3'];
        }

        $_SESSION['path'] = $path;
			}
			$dbh = null;

    }catch (PDOException $e){
      print('Error:'.$e->getMessage());
      exit();
    }

  }elseif(isset($_FILES['img']) && is_array($_FILES['img']['error'])) {
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
        $save_dir = "../upload_img/";
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

        $msg = ['green', 'ファイルは正常にアップロードされました'];
      } catch (RuntimeException $e) {
        $msg = ['red', $e->getMessage()];
      }
    }
  }
}
include($_SERVER["DOCUMENT_ROOT"] ."/main/equipmentInsertCheck-page.php");
?>
