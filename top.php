<?php
session_start();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <?php include("component/head.php"); ?>
</head>

<body>

  <!-- ヘッダーの読み込み -->
  <?php include("component/header.php");?>

  <div class="top-message">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col mx-auto">
          <div class="site-heading">
            <h1>Advanced Creators</h1>
            <span class="subheading">機材をしっかり理解してイベントを成功させよう</span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-sm-6 offset-sm-3">
        <h1 class="text-center">機材リスト</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-4">
        <div class="genre">
          <div class="icon">
            <a href="http://localhost/advan/main/list.php?genre=Sound">
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
            <a href="http://localhost/advan/main/list.php?genre=Stage">
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
            <a href="http://localhost/advan/main/list.php?genre=Light">
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

  <!-- フッターの読み込み -->
  <?php include("component/footer.php");?>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
