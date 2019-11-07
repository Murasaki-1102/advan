<?php
session_start();
require_once("database/equipment.php");
require_once("database/equipmentData.php");

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

  <main role="main">
    <section class="jumbotron text-center">
      <div class="container">
        <!-- <h1><?php echo $genre ?>Equipments</h1> -->
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
                    <a class="btn btn-sm btn-outline-secondary" href="/main/show.php?name=<?php echo $equipment->getName() ?>">見る</a>
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
  
  <?php include($_SERVER["DOCUMENT_ROOT"]."/component/footer.php"); ?>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
