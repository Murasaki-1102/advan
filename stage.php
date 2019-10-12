<?php
require_once("equipment.php");
require_once("stageData.php");

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
  <main role="main">
		<section class="jumbotron text-center">
			<div class="container">
				<h1>StageEquipments</h1>
				<p class="lead text-muted"></p>
				<p>
					<a href="equipmentInsert.php?genre=舞台" class="btn btn-primary my-2">追加する</a>

				</p>
			</div>
		</section>

		<div class="py-5 bg-light">
			<div class="container">
				<div class="row">
          <?php foreach ($equipments as $equipment): ?>
					<div class="col-md-4">
						<div class="card mb-4 shadow-sm">
							<img class="card-img-top" src="<?php echo $equipment->getImg1() ?>">
							<div class="card-body">
								<p class="card-text"><?php echo $equipment->getName() ?></p>
								<div class="d-flex justify-content-between align-items-center">
									<div class="btn-group">
                    <a class="btn btn-sm btn-outline-secondary" href="show.php?name=<?php echo $equipment->getName() ?>">見る</a>
										<a class="btn btn-sm btn-outline-secondary" href="show.php">編集</a>

									</div>
									<small class="text-muted">9 分前</small>
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
  <?php include("footer.php");?>



  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
