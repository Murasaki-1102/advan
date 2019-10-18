<?php
session_start();

if(!isset($_SESSION['login'])){
  header("Location: ../auth/login.php");
}

require_once("../database/equipment.php");
require_once("../database/soundData.php");
require_once("../database/stageData.php");
require_once("../database/lightData.php");
$equipmentName = $_GET['name'];

$equipment = equipment::findByName($equipments,$equipmentName);
$_SESSION['equipmentName'] = $equipmentName;

$_SESSION['way'] = "edit";

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
  <div class="container">
    <div class="page-header">
      <div class="row">
        <div class="col">
          <div class="well">
            <form  action="equipmentInsertCheck.php?genre=<?php echo $genre ?>" method="POST" enctype="multipart/form-data" name="Insert">
              <fieldset>
                <legend>編集</legend>
                <div class="form-group">
                  <label for="maker" class="col">maker</label>
                  <div class="col">
                    <input type="text" class="form-control" name="maker" value="<?php echo $equipment->getMaker() ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="name" class="col">name</label>
                  <div class="col">
                    <input type="text" class="form-control" name="name" value="<?php echo $equipment->getName() ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="category" class="col">category</label>
                  <div class="col">
                    <select class="form-control" name="category" value="<?php echo $equipment->getCategory() ?>">
                      <option></option>
                      <option>mixer</option>
                      <option>mic</option>
                      <option>amp</option>
                      <option>light</option>
                      <option>?</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="comment" class="col">comment</label>
                  <div class="col">
                    <textarea type="text" class="form-control" name="comment"><?php echo $equipment->getComment() ?></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label for="stock" class="col">stock</label>
                  <div class="col">
                    <input type="text" class="form-control" name="stock" value="<?php echo $equipment->getStock() ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="weight" class="col">weight</label>
                  <div class="col">
                    <input type="text" class="form-control" name="weight" value="<?php echo $equipment->getWeight() ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="power" class="col">power</label>
                  <div class="col">
                    <input type="text" class="form-control" name="power" value="<?php echo $equipment->getPower() ?>">
                  </div>
                </div>
                <div class="custom-file">
                  <label class="custom-file-label" for="customFile">画像3枚まで選択...</label>
                  <div class="col">
                    <input type="file" class="custom-file-input" name="img[]" id="select_img" accept="image/jpeg, image/gif, image/png" multiple="multiple">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col">
                    <button type="submit" class="btn">プレビュー</button>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col">
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

  <main role="main">

    <section class="py-5 bg-light">
      <div class="container">
        <div class="row">
          <div class="col-sm-6 offset-sm-3 text-center">

            <a onclick="history.back()" class="btn btn-primary my-2" style="color: #fff;">戻る</a>
            <h2 class="equipment-title"><?php echo $equipmentName ?></h2>
          </div>
          <div class="equipment-comment col-xl-10 col-lg-10 offset-xl-2 offset-lg-1">
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
