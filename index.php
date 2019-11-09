<?php
session_start();
require_once("database/equipmentData.php");

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

  <main role="main">
    <section class="jumbotron">
      <div class="container text-center">
        <p><a href="/main/equipmentInsert.php" class="btn btn-primary my-2">追加する</a></p>
        <div class="mt-5">
          <button class="btn btn-secondary sort-btn trigger my-2" data-filter="All">All</button>
          <button class="btn btn-secondary sort-btn trigger my-2" data-filter="Sound">Sound</button>
          <button class="btn btn-secondary sort-btn trigger my-2" data-filter="Stage">Stage</button>
          <button class="btn btn-secondary sort-btn trigger my-2" data-filter="Light">Light</button>
          <button class="btn btn-secondary sort-btn trigger my-2" data-filter="Other">Other</button>
        </div>
      </div>
    </section>

    <div class="py-5 bg-light">
      <div class="container-fluid">
        <div class="row" id="filter-list">

          <?php foreach ($equipments as $equipment): ?>
            <div class="col-md-3 filter <?php echo $equipment->getCategory() ?>">
              <div class="card mb-3 shadow-sm">
                <img class="card-img-top" src="<?php echo $equipment->getImg1() ?>">
                <div class="card-body">
                  <p class="card-text"><?php echo $equipment->getName() ?></p>
                  <div class="d-flex justify-content-between align-items-center">
                    <a href="/main/show.php?name=<?php echo $equipment->getName() ?>"><button class="btn btn-sm btn-outline-secondary">見る</button></a>
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

  <footer>
  <?php include($_SERVER["DOCUMENT_ROOT"]."/component/footer.php"); ?>
  </footer>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script type="text/javascript" src="/js/sort.js"></script>
</body>
</html>
