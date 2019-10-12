<?php
require_once("equipment.php");
require_once("soundData.php");
require_once("stageData.php");
$equipmentName = $_GET['name'];

$equipment = equipment::findByName($equipments,$equipmentName);

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
        <div class="col">
          <div class="well">
            <form  action="RegistrationCheck.php" method="POST">
              <fieldset>

                <legend>機材追加</legend>

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
                    <input type="text" class="form-control" name="comment" value="<?php echo $equipment->getComment() ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label for="stock" class="col">stock</label>
                  <div class="col">
                    <input type="text" class="form-control" name="stock" placeholder="1台"
                    value="">
                  </div>
                </div>

                <div class="form-group">
                  <label for="weight" class="col">weight</label>
                  <div class="col">
                    <input type="text" class="form-control" name="weight" placeholder="20kg"
                    value="">
                  </div>
                </div>

                <div class="form-group">
                  <label for="power" class="col">power</label>
                  <div class="col">
                    <input type="text" class="form-control" name="power" placeholder="90W"
                    value="">
                  </div>
                </div>

                <div class="form-group">
                  <label for="img1" class="col">画像1</label>
                  <div class="col">
                    <input type="text" class="form-control" name="weight" placeholder="20kg"
                    value="">
                  </div>
                </div>

                <div class="form-group">
                  <div class="col">
                    <button type="submit" class="btn">登録</button>
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
        <div class="col-sm-6 offset-sm-3">

          <a onclick="history.back()" class="btn btn-primary my-2 text-center" style="color: #fff;">戻る</a>
					<a href="#" class="btn btn-primary my-2">編集する</a>
          <h2 class="equipment-title"><?php echo $equipmentName ?></h2>
          <div class="equipment-comment">
            <pre><?php echo $equipment->getComment() ?>
            </pre>
          </div>
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
  <?php include("footer.php");?>



  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html
