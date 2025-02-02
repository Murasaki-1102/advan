<?php
session_start();
require_once("database/equipmentData.php");

if (!isset($_SESSION['login'])) {
  $_SESSION = array();
}

if (!isset($_GET['page_id'])) {
  $now = 1;
} else {
  $now = $_GET['page_id'];
}

if (!isset($_GET['sort'])) {
  $sort = returnAll();
} elseif ($_GET['sort'] == "Sound"){
  $sort = returnSound();
} elseif ($_GET['sort'] == "Stage"){
  $sort = returnStage();
} elseif ($_GET['sort'] == "Light"){
  $sort = returnLight();
} elseif ($_GET['sort'] == "Other"){
  $sort = returnOther();
}

define("MAX","24");

$data_num  = count($sort);
$max_page = ceil($data_num / MAX);

$start_number = ($now - 1) * MAX;

$display_data = array_slice($sort,$start_number,MAX, true);
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
          <a href="/"><button class="btn btn-secondary sort-btn trigger my-2" data-filter="All">All</button></a>
          <a href="/?sort=Sound&"><button class="btn btn-secondary sort-btn trigger my-2" data-filter="Sound">Sound</button></a>
          <a href="/?sort=Stage&"><button class="btn btn-secondary sort-btn trigger my-2" data-filter="Stage">Stage</button></a>
          <a href="/?sort=Light&"><button class="btn btn-secondary sort-btn trigger my-2" data-filter="Light">Light</button></a>
          <a href="/?sort=Other&"><button class="btn btn-secondary sort-btn trigger my-2" data-filter="Other">Other</button></a>
        </div>
      </div>
    </section>

    <div class="py-4 bg-light">
      <div class="container-fluid">
        <div class="row" id="filter-list">
          <?php foreach ($display_data as $val) : ?>
            <div class="col-lg-4 col-md-4 col-sm-6 filter <?php echo $val->getCategory() ?>">
              <div class="card main-contents">
                <a href="/main/show.php?name=<?php echo $val->getName() ?>"><img class="card-img-top" src="<?php echo $val->getImg1() ?>"></a>
                <div class="card-body">
                  <p class="card-text"><?php echo $val->getName() ?></p>
                  <div class="d-flex justify-content-between align-items-center">
                    <a href="/main/show.php?name=<?php echo $val->getName() ?>"><button class="btn btn-sm btn-outline-secondary">見る</button></a>
                    <small class="text-muted card-body_modified" style="padding-left:10px">Last Modified <?php echo $val->getDate() ?></small>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach ?>

        </div>
      </div>
      <nav aria-label="">
        <ul class="pagination justify-content-center">
          <li class="page-item">
            <?php if ($now <= $max_page && $now > 1) : ?>
              <a class="page-link" href="?<?=$_SERVER['QUERY_STRING']?>page_id=<?php echo $now - 1 ?>" aria-label="前">
                <span aria-hidden="true">&laquo;</span>
              </a>
            <?php endif; ?>

          </li>
          <?php for ($i=1; $i <= $max_page; $i++) : ?>
            <?php if ($i == $now) : ?>
            <li class="page-item"><a class="page-link"><?php echo $now ?></a></li>
            <?php else : ?>
              <li class="page-item"><a class="page-link" href="/?<?=$_SERVER['QUERY_STRING']?>&page_id=<?php echo $i ?>"><?php echo $i ?></a></li>
            <?php endif; ?>
          <?php endfor; ?>
          <li class="page-item">
            <?php if ($now < $max_page && $now != $max_page) : ?>

              <a class="page-link" href="/?<?=$_SERVER['QUERY_STRING']?>&page_id=<?php echo $now + 1 ?>" aria-label="次">
                <span aria-hidden="true">&raquo;</span>
              </a>
            <?php endif; ?>
          </li>
        </ul>
      </nav>
    </div>
  </main>

  <footer>
    <?php include($_SERVER["DOCUMENT_ROOT"]."/component/footer.php"); ?>
  </footer>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
