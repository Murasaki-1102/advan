<?php

session_start();

header("Content-type: text/html; charset=utf-8");

//クリックジャッキング対策
header('X-FRAME-OPTIONS: SAMEORIGIN');

//データベース接続
require_once("db.php");
$dbh = db_connect();

//エラーメッセージの初期化
$errors = array();

//前後にある半角全角スペースを削除する関数
function spaceTrim ($str)
{
  // 行頭
  $str = preg_replace('/^[ 　]+/u', '', $str);
  // 末尾
  $str = preg_replace('/[ 　]+$/u', '', $str);
  return $str;
}

if(empty($_POST)) {
  header("Location: top.php");
  exit();
}else{
  //POSTされたデータを変数に入れる
  $mailAdress = isset($_POST['mailAdress']) ? $_POST['mailAdress'] : NULL; //三項演算子
  $account = isset($_POST['account']) ? $_POST['account'] : NULL;
  $grade = isset($_POST['grade']) ? $_POST['grade'] : NULL;
  $password = isset($_POST['password']) ? $_POST['password'] : NULL;
  $password_conf = isset($_POST['password_conf']) ? $_POST['password_conf'] : NULL;

  //前後にある半角全角スペースを削除
  $mailAdress = spaceTrim($mailAdress);
  $account = spaceTrim($account);
  $grade = spaceTrim($grade);
  $password = spaceTrim($password);
  $password_conf = spaceTrim($password_conf);

  //メールアドレス入力判定
  if($mailAdress == "") :
    $errors['mailAdress'] = "メールアドレスが入力されていません。";
  elseif(!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $mailAdress)) :
    $errors['mail_check'] = "メールアドレスの形式が正しくありません。";
  endif;


  //アカウント入力判定
  if ($account == '') :
    $errors['account'] = "アカウントが入力されていません。";
  elseif(mb_strlen($account)>10) :
    $errors['account_length'] = "アカウントは10文字以内で入力して下さい。";
  endif;

  //学年入力判定
  if($grade == '') :
    $errors['grade'] = "学年が入力されていません。";
  endif;


  //パスワード入力判定
  if ($password == '') :
    $errors['password'] = "パスワードが入力されていません。";
  elseif($password != $password_conf) :
    $errors['password'] = "パスワードが合いません。";
  elseif(!preg_match('/^[0-9a-zA-Z]{5,30}$/', $_POST["password"])) :
    $errors['password_length'] = "パスワードは半角英数字の5文字以上30文字以下で入力して下さい。";
  else :
    $password_hide = str_repeat('*', strlen($password));
  endif;
}
/*
ここで本登録用のmemberテーブルにすでに登録されているmailadressかどうかをチェックする。
$errors['member_check'] = "このメールアドレスはすでに利用されております。";
*/
//エラーが無ければセッションに登録


if(count($errors) === 0){

  $_SESSION['mailAdress'] = $mailAdress;
  $_SESSION['account'] = $account;
  $_SESSION['grade'] = $grade;
  $_SESSION['password'] = $password;


  $urltoken = hash('sha256',uniqid(rand(),1));
  $_SESSION['urltoken'] = $urltoken;
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

  <title>Advan機材リスト</title>

  <link rel="stylesheet" href="advan.css">
  <!-- Web font CSS -->
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
</head>

<body>

  <!-- ヘッダーの読み込み -->
  <?php include("header.php");?>

  <div class="container">
    <div class="page-header">
      <div class="row">
        <div class="col-lg-12">
          <div class="well err">
            <?php if (count($errors) === 0): ?>
              <form class="form-horizontal" action="createUser.php" method="POST">
                <fieldset>
                  <legend>会員登録確認</legend>

                  <div class="form-group">
                    <label for="mailAdress" class="col-lg-2">mailAdress：<?=htmlspecialchars($mailAdress, ENT_QUOTES)?></label>
                  </div>

                  <div class="form-group">
                    <label for="account" class="col-lg-2" name="account">accountName：<?=htmlspecialchars($account, ENT_QUOTES,'UTF-8')?></label>
                  </div>

                  <div class="form-group">
                    <label for="grade" class="col-lg-2">grade：<?=htmlspecialchars($grade, ENT_QUOTES,'UTF-8')?></label>
                  </div>

                  <div class="form-group">
                    <label for="password" class="col-lg-2">password：<?=$password_hide?></label>
                  </div>

                  <div class="form-group">
                    <div class="col-lg-10">
                      <button type="submit" name="send" class="btn">登録</button>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-lg-10">
                      <button type="button" class="btn" onclick="history.back()">戻る</button>
                    </div>
                  </div>

                </fieldset>
              </form>
            <?php elseif(count($errors) > 0): ?>

              <?php
              foreach($errors as $value){
                echo "<p>".$value."</p>";
              }
              ?>
              <div class="col-lg-10">
                <button type="button" class="btn" onclick="history.back()">戻る</button>
              </div>

            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>


<hr>

<!-- フッターの読み込み -->
<?php include("footer.php");?>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
