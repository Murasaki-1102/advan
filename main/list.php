<?php
session_start();

require_once("../database/equipment.php");

$genre = $_GET['genre'];

if($genre == "Sound"){
  require_once("../database/soundData.php");
}elseif($genre == "Stage"){
  require_once("../database/stageData.php");
}else{
  require_once("../database/lightData.php");
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <?php include("../component/head.php"); ?>
</head>
<body>
  <!-- ヘッダーの読み込み -->
  <?php include("../component/header.php");?>

  <main role="main">
    <section class="jumbotron text-center">
      <div class="container">
        <h1><?php echo $genre ?>Equipments</h1>
        <p class="lead text-muted"></p>
        <p>
          <a href="equipmentInsert.php?genre=<?php echo $genre ?>" class="btn btn-primary my-2">追加する</a>
        </p>
      </div>
    </section>

    <div class="py-5 bg-light">
      <div class="container-fluid">
        <div class="row">

          <?php foreach ($equipments as $equipment): ?>
            <div class="col-md-3">
              <div class="card mb-3 shadow-sm">
                <img class="card-img-top" src="<?php echo $equipment->getImg1() ?>" style="">
                <div class="card-body">
                  <p class="card-text"><?php echo $equipment->getName() ?></p>
                  <div class="d-flex justify-content-between align-items-center">
                    <a class="btn btn-sm btn-outline-secondary" href="show.php?name=<?php echo $equipment->getName() ?>&genre=<?php echo $genre ?>">見る</a>
                    <small class="text-muted" style="padding-left:10px">Last Modified <?php echo $equipment->getDate() ?></small>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach ?>

        </div>
      </div>
    </div>
  </main>

  <!-- フッターの読み込み -->
  <?php include("../component/footer.php");?>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
