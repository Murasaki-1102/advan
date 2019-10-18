<?php
session_start();

require_once("../database/equipment.php");
require_once("../database/soundData.php");
require_once("../database/stageData.php");
require_once("../database/lightData.php");
$equipmentName = $_GET['name'];

$equipment = equipment::findByName($equipments,$equipmentName);

$genre = $_GET['genre'];

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
    <section class="py-5 bg-light">
      <div class="container">
        <div class="row">
          <div class="col-sm-6 offset-sm-3 text-center">
            <a onclick="history.back()" class="btn btn-primary my-2" style="color: #fff;">戻る</a>
            <a class="btn btn-primary my-2" href="edit.php?name=<?php echo $equipment->getName() ?>&genre=<?php echo $genre ?>">編集する</a>
            <h2 class="equipment-title"><?php echo $equipmentName ?></h2>
          </div>
          <div class="equipment-comment col-xl-8 col-lg-8 offset-xl-2 offset-lg-1">
            <pre><?php echo $equipment->getComment() ?></pre>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6 col-md-3 col-lg-3">
            <div class="equipment-part">
              <h2 class="equipment-subtitle">Maker</h2>
              <p><?php echo $equipment->getMaker() ?></p>
            </div>
            <div class="equipment-part">
              <h2 class="equipment-subtitle">Category</h2>
              <p><?php echo $equipment->getCategory() ?></p>
            </div>

          </div>
          <div class="col-md-6 col-lg-6">
            <div class="equipment-img">
              <img src="<?php echo $equipment->getImg1() ?>">
              <img src="<?php echo $equipment->getImg2() ?>">
              <img src="<?php echo $equipment->getImg3() ?>">
            </div>
          </div>
          <div class="col-sm-6 col-md-3 col-lg-3">
            <div class="equipment-part">
              <h2 class="equipment-subtitle">Weight</h2>
              <p><?php echo $equipment->getWeight() ?></p>
            </div>
            <div class="equipment-part">
              <h2 class="equipment-subtitle">Power</h2>
              <p><?php echo $equipment->getPower() ?></p>
            </div>
            <div class="equipment-part">
              <h2 class="equipment-subtitle">Stock</h2>
              <p><?php echo $equipment->getStock() ?></p>
            </div>
            <div class="equipment-part">
              <h2 class="equipment-subtitle">Last Modified</h2>
              <p><?php echo $equipment->getDate() ?></p>
            </div>
            <div class="equipment-part">
              <a class="btn btn-danger my-2 btn-sm" href="delete.php?name=<?php echo $equipment->getName() ?>&genre=<?php echo $genre ?>">削除する</a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <!-- フッターの読み込み -->
  <?php include("../component/footer.php");?>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html
