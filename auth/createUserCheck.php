<?php
session_start();

header("Content-type: text/html; charset=utf-8");

//クリックジャッキング対策
header('X-FRAME-OPTIONS: SAMEORIGIN');

//PHPMailerを使用するための読み込み
require '../src/Exception.php';
require '../src/PHPMailer.php';
require '../src/SMTP.php';
require 'setting.php';

//データベース接続
require_once("../database/db.php");
$dbh = db_connect();

//エラーメッセージの初期化
$errors = array();

if(empty($_GET)) {
  header("Location: http://localhost/advan/top.php");
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

      /*
      登録完了のメールを送信
      */

      //メールの宛先
      $mailTo = $mailAdress;

      //Return-Pathに指定するメールアドレス
      $returnMail = 'tbtechbase@gmail.com';

      $name = "advan機材リスト管理人";
      $mailAdress = 'tbtechbase@gmail.com';
      $subject = "【Advan】会員登録完了のお知らせ";

      //Fromヘッダーを作成
      $header = 'From: '.$name."< ".$mailAdress." >";

      $mail = new PHPMailer\PHPMailer\PHPMailer();

      $mail->isSMTP(); // SMTPを使うようにメーラーを設定する
      $mail->SMTPAuth = true;
      $mail->Host = MAIL_HOST; // メインのSMTPサーバー（メールホスト名）を指定
      $mail->Username = MAIL_USERNAME; // SMTPユーザー名（メールユーザー名）
      $mail->Password = MAIL_PASSWORD; // SMTPパスワード（メールパスワード）
      $mail->SMTPSecure = MAIL_ENCRPT; // TLS暗号化を有効にし、「SSL」も受け入れます
      $mail->Port = SMTP_PORT; // 接続するTCPポート

      // メール内容設定
      $mail->CharSet = "UTF-8";
      $mail->Encoding = "base64";
      $mail->setFrom(MAIL_FROM,MAIL_FROM_NAME);
      $mail->addAddress($mailTo, '本登録'); //受信者（送信先）を追加する
      //    $mail->addReplyTo('xxxxxxxxxx@xxxxxxxxxx','返信先');
      //    $mail->addCC('xxxxxxxxxx@xxxxxxxxxx'); // CCで追加
      //    $mail->addBcc('xxxxxxxxxx@xxxxxxxxxx'); // BCCで追加
      $mail->Subject = $subject; // メールタイトル
      $mail->isHTML(true);    // HTMLフォーマットの場合はコチラを設定します
      $body = <<< EOM
      {$account} 様 <br />
      会員登録完了のお知らせメールです。<br />
      <br />
      EOM;

      $mail->Body  = $body.$header; // メール本文
      // メール送信の実行
      if(!$mail->send()) {
        $errors['mail_error'] = "メールの送信に失敗しました。";
        echo 'Mailer Error: ' . $mail->ErrorInfo;
      }else{

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
