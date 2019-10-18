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

if(empty($_GET)) {
  header("Location: ../index.php");
  exit();
}else{
  $mailAdress = $_SESSION['mailAdress'];
  $account = $_SESSION['account'];
  $grade = $_SESSION['grade'];

  $urltoken = isset($_GET['urltoken']) ? $_GET['urltoken'] : NULL;
  if($urltoken == ""){
    $errors['urltoken'] = "もう一度登録をやりなおしてください。";
  }else{
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
        $_SESSION['mailAdress'] = $mailAdress;

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
      $content .="{$url}";

      $headers = <<<HEAD
      From : tbtechbase@gmail.com
      Return-Path: tbtechbase@gmail.com
      HEAD;

      $is_success = mb_send_mail($mailTo, $subject, $content, $headers);

      if(!$is_success) {
        $errors['mail_error'] = "メールの送信に失敗しました。";
      }else {
        //セッション変数を全て解除
        $_SESSION = array();

        //クッキーの削除
        if (isset($_COOKIE["PHPSESSID"])) {
          setcookie("PHPSESSID", '', time() - 1800, '/');
        }

        //セッションを破棄する
        @session_destroy();

        $message = "登録完了メールをお送りしました。";
      }
    }catch (PDOException $e){
      $errors['error'] = "もう一度やりなおして下さい。";
      print('Error:'.$e->getMessage());
    }
  }
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include("../component/head.php");?>
</head>
<body>

  <!-- ヘッダーの読み込み -->
  <?php include("../component/header.php");?>

  <div class="container">
    <div class="page-header" id="banner">
      <a name="Login"></a>
      <div class="row">
        <div class="col-lg-12">
          <div class="well">
            <div class="well">
              <?php if (count($errors) === 0): ?>
                <h1>会員登録完了</h1>
                <p><?=$message?></p>
              <?php elseif(count($errors) > 0): ?>
                <?php foreach($errors as $value){
                  echo "<p>".$value."</p>";
                } ?>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- フッターの読み込み -->
  <?php include("../component/footer.php");?>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
