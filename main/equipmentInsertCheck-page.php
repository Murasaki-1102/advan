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
    <section class="py-4 bg-light">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 border-bottom">
            <a onclick="history.back()" class="btn btn-primary btn-sm my-2" style="color: #fff;">戻る</a>
            <?php if($way == "insert") : ?>
              <a class="btn btn-success btn-sm my-2 float-right"  href="equipmentInsertComplete.php">追加する</a>
            <?php elseif($way == "edit") :?>
              <a class="btn btn-success btn-sm my-2 float-right"  href="equipmentInsertComplete.php">編集する</a>
            <?php endif; ?>
            <h1 class="insert-preview_title">プレビュー</>
            <h2 class="equipment-title mb-5"><?php echo $name ?></h2>
          </div>
          <div class="equipment-comment equipment-part col-lg-9">
            <pre><?php echo $comment ?></pre>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6 col-md-3 col-lg-3">
            <div class="equipment-part">
              <h2 class="equipment-subtitle">Maker</h2>
              <p><?php echo $maker ?></p>
            </div>
            <div class="equipment-part">
              <h2 class="equipment-subtitle">Category</h2>
              <p><?php echo $category ?></p>
            </div>
            <div class="equipment-part">
              <h2 class="equipment-subtitle">SubCategory</h2>
              <p><?php echo $subCategory ?></p>
            </div>
          </div>
          <div class="col-md-6 col-lg-6">
            <div class="equipment-img">
							<div id="carousel-img" class="carousel slide">
                <ol class="carousel-indicators">
									<li data-target="#carousel-img" data-slide-to="0" class="active"></li>
									<?php if (isset($rows['image2'])) : ?>
										<li data-target="#carousel-img" data-slide-to="1"></li>
									<?php elseif (isset($src[1])) : ?>
										<li data-target="#carousel-img" data-slide-to="1"></li>
									<?php endif; ?>
									<?php if (isset($rows['image3'])) : ?>
										<li data-target="#carousel-img" data-slide-to="2"></li>
									<?php elseif (isset($src[2])) : ?>
										<li data-target="#carousel-img" data-slide-to="2"></li>
									<?php endif; ?>
								</ol>
                <div class="carousel-inner">
									<?php if (isset($rows)) : ?>
										<?php foreach ($path as $result) :?>
											<?php if ($result === reset($path)) : ?>
												<div class="carousel-item active">
													<img class="d-block w-100" src="<?php echo $result ?>">
												</div>
											<?php else : ?>
												<div class="carousel-item">
													<img class="d-block w-100" src="<?php echo $result ?>">
												</div>
											<?php endif; ?>
										<?php endforeach; ?>
									<?php else : ?>
										<?php foreach ($src as $val) : ?>
											<?php if ($val === reset($src)) : ?>
												<div class="carousel-item active">
													<img class="d-block w-100" src="<?php echo $val ?>">
												</div>
											<?php else : ?>
												<div class="carousel-item">
													<img class="d-block w-100" src="<?php echo $val ?>">
												</div>
											<?php endif; ?>
										<?php endforeach; ?>
									<?php endif; ?>
                </div>
                <?php if (isset($rows['image2']) || isset($src[1])) : ?>
                  <a class="carousel-control-prev" href="#carousel-img" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carousel-img" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
                <?php endif; ?>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-3 col-lg-3">
            <div class="equipment-part">
              <h2 class="equipment-subtitle">Weight</h2>
              <p><?php echo $weight ?></p>
            </div>
            <div class="equipment-part">
              <h2 class="equipment-subtitle">Power</h2>
              <p><?php echo $power ?></p>
            </div>
            <div class="equipment-part">
              <h2 class="equipment-subtitle">Stock</h2>
              <p><?php echo $stock ?></p>
            </div>
            <div class="equipment-part">
              <h2 class="equipment-subtitle">Last Modified</h2>
							<p><?php echo $date ?></p>
							<p>modified by : <?php echo $last_user ?></p>
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
</body>
</html