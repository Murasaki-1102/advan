<?php
session_start();

if(!isset($_SESSION['login'])){
  header("Location: /auth/login.php");
}

require_once("../database/equipmentData.php");

$equipmentName = $_GET['name'];

$equipment = equipment::findByName($equipments,$equipmentName);
$_SESSION['equipmentName'] = $equipmentName;

$_SESSION['way'] = "edit";

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <?php include("../component/head.php"); ?>
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
            <form  action="/main/equipmentInsertCheck.php" method="POST" enctype="multipart/form-data" name="Insert">
              <fieldset>
                <legend>編集</legend>
                <div class="form-group">
                  <label for="maker" class="col">maker</label>
                  <div class="col">
                    <input type="text" class="form-control" id="maker" name="maker" value="<?php echo $equipment->getMaker() ?>">
                    <span id="maker-error" class="error-message"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="name" class="col">name</label>
                  <div class="col">
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $equipment->getName() ?>">
                    <span id="name-error" class="error-message"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="category" class="col">category</label>
                  <div class="col">
                    <select class="form-control" id="category" name="category">
                      <option value="<?php echo $equipment->getCategory() ?>" style="display: none;" selected><?php echo $equipment->getCategory() ?></option>
                      <option value="Sound">Sound</option>
                      <option value="Stage">Stage</option>
											<option value="Light">Light</option>
											<option value="Other">Other</option>
                    </select>
                    <span id="category-error" class="error-message"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="subCategory" class="col">subCategory</label>
                  <div class="col">
                    <select class="form-control" id="subCategory" name="subCategory">
                      <option value="<?php echo $equipment->getSubCategory() ?>" style="display: none;" selected><?php echo $equipment->getSubCategory() ?></option>
											<option value="mixer" data-val="Sound">mixer</option>
											<option value="processor" data-val="Sound">processor</option>
											<option value="cable" data-val="Sound">cable</option>
											<option value="other" data-val="Sound">other</option>

											<option value="mic" data-val="Stage">mic</option>
											<option value="speaker" data-val="Stage">speaker</option>
											<option value="amp" data-val="Stage">amp</option>
											<option value="processor" data-val="Stage">processor</option>
											<option value="cable" data-val="Stage">cable</option>
											<option value="other" data-val="Stage">other</option>

											<option value="lightning console" data-val="Light">lightning console</option>
											<option value="lamp" data-val="Light">lamp</option>
											<option value="dimmer" data-val="Light">dimmer</option>
											<option value="other" data-val="Light">other</option>

											<option value="other" data-val="Other">other</option>
										</select>
										<span id="subCategory-error" class="error-message"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="comment" class="col">comment</label>
                  <div class="col">
                    <textarea type="text" class="form-control" id="comment" name="comment"><?php echo $equipment->getComment() ?></textarea>
                    <span id="comment-error" class="error-message"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="stock" class="col">stock</label>
                  <div class="col">
                    <input type="text" class="form-control" id="stock" name="stock" value="<?php echo $equipment->getStock() ?>">
                    <span id="stock-error" class="error-message"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="weight" class="col">weight</label>
                  <div class="col">
                    <input type="text" class="form-control" id="weight" name="weight" value="<?php echo $equipment->getWeight() ?>">
                    <span id="weight-error" class="error-message"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="power" class="col">power</label>
                  <div class="col">
                    <input type="text" class="form-control" id="power" name="power" value="<?php echo $equipment->getPower() ?>">
                    <span id="power-error" class="error-message"></span>
                  </div>
                </div>
                <div class="custom-file my-3">
                  <label class="custom-file-label" for="customFile">画像3枚まで選択...</label>
                  <div class="col">
                    <input type="file" class="custom-file-input" name="img[]" id="imgs" accept="image/jpeg, image/gif, image/png" multiple="multiple">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col">
                    <button type="submit" id="btn" class="btn btn-primary">プレビュー</button>
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

    <section class="py-4 bg-light">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 border-bottom">
            <a onclick="history.back()" class="btn btn-primary btn-sm my-2" style="color: #fff;">戻る</a>
            <h1 class="equipment-title"><?php echo $equipmentName ?></h1>
          </div>
          <div class="equipment-comment equipment-part col-lg-9">
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
            <div class="equipment-part">
              <h2 class="equipment-subtitle">SubCategory</h2>
              <p><?php echo $equipment->getSubCategory() ?></p>
            </div>

          </div>
          <div class="col-md-6 col-lg-6">
            <div class="equipment-img">
              <div id="carousel-img" class="carousel slide">
                <ol class="carousel-indicators">
                  <li data-target="#carousel-img" data-slide-to="0" class="active"></li>
                  <?php if($equipment->getImg2()) : ?>
                    <li data-target="#carousel-img" data-slide-to="1"></li>
                  <?php endif; ?>
                  <?php if ($equipment->getImg3()) : ?>
                    <li data-target="#carousel-img" data-slide-to="2"></li>
                  <?php endif; ?>
                </ol>
                <div class="carousel-inner">

                  <?php if ($equipment->getImg1()) : ?>
                    <div class="carousel-item active">
                      <img class="d-block w-100" src="<?php echo $equipment->getImg1() ?>" alt="First slide">
                    </div>
                  <?php endif; ?>
                  <?php if ($equipment->getImg2()) : ?>
                    <div class="carousel-item">
                      <img class="d-block w-100" src="<?php echo $equipment->getImg2() ?>" alt="Second slide">
                    </div>
                  <?php endif; ?>
                  <?php if ($equipment->getImg3()) : ?>
                    <div class="carousel-item">
                      <img class="d-block w-100" src="<?php echo $equipment->getImg3() ?>" alt="Third slide">
                    </div>
                  <?php endif; ?>
                </div>

                <a class="carousel-control-prev" href="#carousel-img" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carousel-img" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
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

  <footer>
  <?php include($_SERVER["DOCUMENT_ROOT"]."/component/footer.php"); ?>
  </footer>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script type="text/javascript" src="/js/equipmentEdit.js"></script>
</body>
</html
