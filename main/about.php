<?php
session_start();

if (!isset($_SESSION['login'])) {
  $_SESSION = array();
}
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

  <div class="top-message">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="site-heading">
            <h1>Advanced Creators</h1>
            <p class="subheading">機材を完璧に理解してイベントを成功させよう</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="section">
    <div class="container">
          <h1 class="text-center">機材リスト</h1>

      <div class="row">
        <div class="col-sm-4">
          <div class="genre">
            <div class="icon">
              <a href="/?sort=Sound">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fas fa-sliders-h fa-stack-1x fa-inverse" ></i>
                </span>
              </a>
            </div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="genre">
            <div class="icon">
              <a href="/?sort=Stage">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fas fa-microphone fa-stack-1x fa-inverse" ></i>
                </span>
              </a>
            </div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="genre">
            <div class="icon">
              <a href="/?sort=Light">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fas fa-lightbulb fa-stack-1x fa-inverse" ></i>
                </span>
              </a>
            </div>
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
</body>
</html>
