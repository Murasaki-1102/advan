<?php

session_start();

header("Content-type: text/html; charset=utf-8");

//クリックジャッキング対策
header('X-FRAME-OPTIONS: SAMEORIGIN');

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
            <form  action="RegistrationCheck.php" method="POST">
              <fieldset>

                <legend>会員登録</legend>

                <div class="form-group">
                  <label for="mailAdress" class="col-lg-2">mailAdress</label>
                  <div class="col-lg-10">
                    <input type="text" class="form-control" name="mailAdress" placeholder="c011xxxxxx@xxxxxxxx.jp"
                    value="">
                  </div>
                </div>

                <div class="form-group">
                  <label for="account" class="col-lg-2">accountName</label>
                  <div class="col-lg-10">
                    <input type="text" class="form-control" name="account" placeholder="アカウント名"
                    value="">
                  </div>
                </div>

                <div class="form-group">
                  <label for="grade" class="col-lg-2">grade</label>
                  <div class="col-lg-10">
                    <select class="form-control" name="grade">
                      <option></option>
                      <option>16</option>
                      <option>17</option>
                      <option>18</option>
                      <option>19</option>
                      <option>20</option>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="password" class="col-lg-2">Password</label>
                  <div class="col-lg-10">
                    <input type="password" class="form-control" name="password" placeholder="半角英数字の5文字以上30文字以下"
                    value="">
                  </div>
                </div>

                <div class="form-group">
                  <label for="password" class="col-lg-2">Password(確認用)</label>
                  <div class="col-lg-10">
                    <input type="password" class="form-control" name="password_conf" placeholder="半角英数字の5文字以上30文字以下"
                    value="">
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-lg-10">
                    <button type="submit" class="btn">登録</button>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-lg-10">
                    <input type="hidden" class="form-control" name="token" value="<?$token?>">
                  </div>
                </div>

              </fieldset>
            </form>
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
