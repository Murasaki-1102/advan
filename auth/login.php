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
            <form action="loginCheck.php" method="POST">
              <fieldset>
                <legend>ログイン</legend>
                <?php if(isset($_SESSION['password_error'])) : ?>
                  <span class="error-message"><?=$_SESSION['password_error']?></span>
                <?php endif; ?>
                <?php if(isset($_SESSION['mailAdress_error'])) : ?>
                  <span class="error-message"><?=$_SESSION['mailAdress_error']?></span>
                <?php endif; ?>
                <div class="form-group">
                  <label for="mailAdress" class="col">MailAdress</label>
                  <div class="col">
                    <input type="text" class="form-control" id="mailAdress" name="mailAdress" placeholder="mailAdress"
                    value="">
                    <span id="mailAdress-error" class="error-message"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="password" class="col">Password</label>
                  <div class="col">
                    <input type="password" class="form-control" id="password" name="password" placeholder="password"
                    value="">
                    <span id="password-error" class="error-message"></span>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col">
                    <button type="submit" id="btn" class="btn btn-primary" name="login">ログイン</button>
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
  <script type="text/javascript" src="/js/login.js"></script>
</body>
</html>
