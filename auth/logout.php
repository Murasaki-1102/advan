<?php
session_start();

header("Content-type: text/html; charset=utf-8");

// ログイン状態のチェック
if(!isset($_SESSION['mailAdress'])){
  header("Location: login.php");
  exit();
}
//セッション変数を全て解除
$_SESSION = array();

//セッションクッキーの削除
if (isset($_COOKIE["PHPSESSID"])) {
  setcookie("PHPSESSID", '', time() - 1800, '/');
}

//セッションを破棄する
session_destroy();

?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <?php include("../component/head.php"); ?>
</head>

<body>
  <!-- ヘッダーの読み込み -->
  <?php include("../component/header.php");?>

  <div class="container">
    <div class="page-header">
      <div class="row">
        <div class="col-lg-12">
          <div class="well">
            <p>ログアウトしました。</p>
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
