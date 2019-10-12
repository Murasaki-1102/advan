<?php
session_start();
header("Content-type: text/html; charset=utf-8");

//クリックジャッキング対策
header('X-FRAME-OPTIONS: SAMEORIGIN');

$genre = $_GET['genre'];


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

  <script type="text/javascript" src="js/Insert.js"></script>

</head>

<body>

  <!-- ヘッダーの読み込み -->
  <?php include("header.php");?>

  <div class="container">
    <div class="page-header">
      <div class="row">
        <div class="col">
          <div class="well">
            <form  action="equipmentInsertCheck.php?genre=<?php echo $genre ?>" method="POST" enctype="multipart/form-data" name="Insert">
              <fieldset>

                <legend><?php echo $genre ?>機材追加</legend>

                <div class="form-group">
                  <label for="maker" class="col">maker</label>
                  <div class="col">
                    <input type="text" class="form-control" name="maker" placeholder="YAMAHA"
                    value="">
                  </div>
                </div>

                <div class="form-group">
                  <label for="name" class="col">name</label>
                  <div class="col">
                    <input type="text" class="form-control" name="name" placeholder="MGP32X"
                    value="">
                  </div>
                </div>

                <div class="form-group">
                  <label for="category" class="col">category</label>
                  <div class="col">
                    <select class="form-control" name="category">
                      <option></option>
                      <option>mixer</option>
                      <option>processor</option>
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
                    <textarea class="form-control" name="comment" placeholder="使いやすいです。"value=""></textarea>
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

                <div class="custom-file">
                  <label class="custom-file-label" for="customFile">Top画像</label>
                  <div class="col">
                    <input type="file" class="custom-file-input" name="img" id="select_img" accept="image/jpeg, image/gif, image/png">
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
                    <a href="javascript:void(0)" onclick="input_check()"><button type="submit" class="btn">プレビュー</button></a>
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


  <!-- フッターの読み込み -->
  <?php include("footer.php");?>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
