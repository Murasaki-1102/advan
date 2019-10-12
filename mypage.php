<?php
session_start();

header("Content-type: text/html; charset=utf-8");

if(!isset($_SESSION['mailAdress'])){
  header("Location: login.php");
  exit();
}

$mailAdress = $_SESSION['mailAdress'];

//データベース接続
require_once("db.php");
$dbh = db_connect();

try{
  //例外処理を投げる（スロー）ようにする
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  //アカウントで検索
  $statement = $dbh->prepare("SELECT * FROM member WHERE mailAdress=(:mailAdress) AND flag =1");
  $statement->bindValue(':mailAdress', $mailAdress, PDO::PARAM_STR);
  $statement->execute();

  if($row = $statement->fetch()){
    $account = $row['account'];
}

}catch (PDOException $e){
  print('Error:'.$e->getMessage());
  exit();
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
          <div class="well">


              <h1>Mypage</h1>
              <p>account: <?=htmlspecialchars($account, ENT_QUOTES)?></p>
              <p>mailAdress: <?=htmlspecialchars($mailAdress, ENT_QUOTES)?></p>
              <a href="logout.php">ログアウト</a>




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
