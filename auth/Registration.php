<?php
session_start();

header("Content-type: text/html; charset=utf-8");

//クリックジャッキング対策
header('X-FRAME-OPTIONS: SAMEORIGIN');

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <?php include($_SERVER["DOCUMENT_ROOT"] ."/component/head.php"); ?>
</head>

<body>

  <header>
  <?php include($_SERVER["DOCUMENT_ROOT"]."/component/header.php"); ?>
  </header>

  <div class="container">
    <div class="page-header">
      <div class="row">
        <div class="col">
          <div class="well">
            <form action="registrationCheck.php" method="POST">
              <fieldset>
                <legend>会員登録</legend>
                <div class="form-group">
                  <label for="mailAdress" class="col">mailAdress</label>
                  <div class="col">
                    <input type="text" class="form-control" id="mailAdress" name="mailAdress" placeholder="c011xxxxxx@xxxxxxxx.jp" value="">
                    <span id="mailAdress-error" class="error-message"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="account" class="col">accountName</label>
                  <div class="col">
                    <input type="text" class="form-control" id="account" name="account" placeholder="アカウント名" value="">
                    <span id="account-error" class="error-message"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="grade" class="col">grade</label>
                  <div class="col">
                    <select class="form-control" id="grade" name="grade">
                      <option value="" style="display: none;">選択してください</option>
                      <option>16</option>
                      <option>17</option>
                      <option>18</option>
                      <option>19</option>
                      <option>20</option>
                    </select>
                    <span id="grade-error" class="error-message"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="password" class="col">Password</label>
                  <div class="col">
                    <input type="password" class="form-control" id="password" name="password" placeholder="半角英数字の5文字以上30文字以下" value="">
                    <span id="password-error" class="error-message"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="password" class="col">Password(確認用)</label>
                  <div class="col">
                    <input type="password" class="form-control" id="password_conf" name="password_conf" placeholder="半角英数字の5文字以上30文字以下" value="">
                    <span id="password_conf-error" class="error-message"></span>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col">
                    <button type="submit" id="btn" class="btn btn-primary">登録</button>
                  </div>
                </div>
              </fieldset>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer>
  <?php include($_SERVER["DOCUMENT_ROOT"]."/component/footer.php"); ?>
  </footer>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script type="text/javascript" src="/js/signup.js"></script>
</body>
</html>
