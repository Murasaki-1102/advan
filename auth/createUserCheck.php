<?php
session_start();

header("Content-type: text/html; charset=utf-8");

//クリックジャッキング対策
header('X-FRAME-OPTIONS: SAMEORIGIN');

if(empty($_GET)) {
  header("Location: /");
  exit();
}else{
  //エラーメッセージの初期化
  $errors = array();
  $mailAdress = $_SESSION['mailAdress'];
  $account = $_SESSION['account'];
  $grade = $_SESSION['grade'];

  $urltoken = isset($_GET['urltoken']) ? $_GET['urltoken'] : NULL;

  if($urltoken == ""){
    $errors['urltoken'] = "もう一度登録をやりなおしてください。";
  }else{
    //データベース接続
    require_once($_SERVER["DOCUMENT_ROOT"]."/database/db.php");
    $dbh = db_connect();
    //ここでデータベースに登録する
    try{
      //例外処理を投げる（スロー）ようにする
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $statement = $dbh->prepare("SELECT mailadress FROM member WHERE urltoken=(:urltoken) AND flag =0 AND date > now() - interval 24 hour");
      $statement->bindValue(':urltoken', $urltoken, PDO::PARAM_STR);
      $statement->execute();

      $row_count = $statement->rowCount();

      if($row_count == 1){
        $mailadress_array = $statement->fetch();
        $mailAdress = $mailadress_array['mailadress'];

        //memberのflagを1にする
        $statement = $dbh->prepare("UPDATE member SET flag=1 WHERE mailadress=(:mailadress)");
        $statement->bindValue(':mailadress', $mailAdress, PDO::PARAM_STR);
        $statement->execute();

      }else{
        $errors['urltoken_timeover'] = "このURLはご利用できません。有効期限が切れています。";
      }

      //memberのflagを1にする
      $statement = $dbh->prepare("UPDATE member SET flag=1 WHERE mailadress=(:mailadress)");
      $statement->bindValue(':mailadress', $mailAdress, PDO::PARAM_STR);
      $statement->execute();

      //データベース接続切断
      $dbh = null;

      $mailTo = $mailAdress;  //宛先メールアドレス
      $subject = "【Advan】会員登録完了のお知らせ";

      $content ="{$account} 様\n";
      $content .="会員登録完了のお知らせメールです。\n";

      $headers = <<<HEAD
			From: c011729114@edu.teu.ac.jp
			Return-Path: c011729114@edu.teu.ac.jp
			HEAD;

      $is_success = mb_send_mail($mailTo, $subject, $content, $headers);

      if(!$is_success) {
        $errors['mail_error'] = "メールの送信に失敗しました。";
      }else {
        unset($_SESSION["account"]);
        unset($_SESSION["grade"]);
        unset($_SESSION["password"]);

        $message = "登録完了メールをお送りしました。";
        $_SESSION['login'] = "login";
      }
    }catch (PDOException $e){
      $errors['error'] = "もう一度やりなおして下さい。";
      print('Error:'.$e->getMessage());
    }
  }
  include($_SERVER["DOCUMENT_ROOT"] ."/auth/createUserCheck-page.php");
}
?>
