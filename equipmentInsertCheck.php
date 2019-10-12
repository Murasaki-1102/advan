<?php
session_start();
header("Content-type: text/html; charset=utf-8");

//クリックジャッキング対策
header('X-FRAME-OPTIONS: SAMEORIGIN');

//前後にある半角全角スペースを削除する関数
function spaceTrim ($str)
{
  // 行頭
  $str = preg_replace('/^[ 　]+/u', '', $str);
  // 末尾
  $str = preg_replace('/[ 　]+$/u', '', $str);
  return $str;
}

$genre = $_GET['genre'];

if(empty($_POST)) {
  header("Location: top.php");
  exit();
}else{

  //POSTされたデータを変数に入れる
  $maker = isset($_POST['maker']) ? $_POST['maker'] : NULL; //三項演算子
  $name = isset($_POST['name']) ? $_POST['name'] : NULL;
  $category = isset($_POST['category']) ? $_POST['category'] : NULL;
  $comment = isset($_POST['comment']) ? $_POST['comment'] : NULL;
  $stock = isset($_POST['stock']) ? $_POST['stock'] : NULL;
  $weight = isset($_POST['weight']) ? $_POST['weight'] : NULL;
  $power = isset($_POST['power']) ? $_POST['power'] : NULL;
  $date = date('Y/m/d H:i:s');

  $_SESSION['maker'] = $maker;
  $_SESSION['name'] = $name;
  $_SESSION['category'] = $category;
  $_SESSION['comment'] = $comment;
  $_SESSION['stock'] = $stock;
  $_SESSION['weight'] = $weight;
  $_SESSION['power'] = $power;
  $_SESSION['date'] = $date;

  //前後にある半角全角スペースを削除
  $maker = spaceTrim($maker);
  $name = spaceTrim($name);
  $comment = spaceTrim($comment);
  $stock = spaceTrim($stock);
  $weight = spaceTrim($weight);
  $power = spaceTrim($power);

  $src = array();
  var_dump($_FILES);
  if(isset($_FILES['img']) && is_array($_FILES['img']['error'])) {
    foreach($_FILES['img']['error'] as $k => $error) {
      try{
        // 更に配列がネストしていれば不正とする
        if (!is_int($error)) {
          throw new RuntimeException("[{$k}] パラメータが不正です");
        }

        // $_FILES['img']['error'] の値を確認
        switch ($error) {
          case UPLOAD_ERR_OK: // OK
          break;
          case UPLOAD_ERR_NO_FILE:   // ファイル未選択
          continue 2;
          case UPLOAD_ERR_INI_SIZE:  // php.ini定義の最大サイズ超過
          case UPLOAD_ERR_FORM_SIZE: // フォーム定義の最大サイズ超過
          throw new RuntimeException("[{$k}] ファイルサイズが大きすぎます");
          default:
          throw new RuntimeException('その他のエラーが発生しました');
        }

        // $_FILES['img']['mime']の値はブラウザ側で偽装可能なので
        // MIMEタイプを自前でチェックする
        if (!$info = @getimagesize($_FILES['img']['tmp_name'][$k])) {
          throw new RuntimeException("[{$k}] 有効な画像ファイルを指定してください");
        }
        //$info[2]はIMAGETYPE_XXX定数
        // 1 IMAGETYPE_GIF
        // 2 IMAGETYPE_JPEG
        // 3 IMAGETYPE_PNG
        if (!in_array($info[2], [IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG], true)) {
          throw new RuntimeException("[{$k}] 未対応の画像形式です");
        }

        // 元画像リソースを生成
        if($info[2] == IMAGETYPE_GIF){
          $result = imagecreatefromgif($_FILES['img']['tmp_name'][$k]);
        }elseif($info[2] == IMAGETYPE_JPEG){
          $result = imagecreatefromjpeg($_FILES['img']['tmp_name'][$k]);
        }elseif($info[2] == IMAGETYPE_PNG){
          $result = imagecreatefrompng($_FILES['img']['tmp_name'][$k]);
        }


        if(!$result){
          throw new RuntimeException("[{$k}] 画像リソースの生成に失敗しました");
        }
        // 保存先ディレクトリ、ファイル名
        $save_dir = "./upload_img/";
        $filename = date("YmdHis")."_{$k}".image_type_to_extension($info[2]);
        $img_result = $save_dir.$filename;

        // 画像の保存
        if($info[2] == IMAGETYPE_GIF){
          $save_result = imagegif($result, $save_dir.$filename);
          $src[] = $img_result;
          $_SESSION['path'] = array_push($_SESSION,$img_result);
        }elseif($info[2] == IMAGETYPE_JPEG){
          $save_result = imagejpeg($result, $save_dir.$filename);
          $src[] = $img_result;
          $_SESSION['path'] = array_push($_SESSION,$img_result);
        }elseif($info[2] == IMAGETYPE_PNG){
          $save_result = imagepng($result, $save_dir.$filename);
          $src[] = $img_result;
          $_SESSION['path'] = $src;

        }
        if(!$save_result){
          throw new RuntimeException("[{$k}] ファイル保存時にエラーが発生しました");
        }

        //  $_SESSION['path'] = $src[]

        $msg = ['green', 'ファイルは正常にアップロードされました'];
      } catch (RuntimeException $e) {
        $msg = ['red', $e->getMessage()];
      }
    }
  }
}


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

    <section class="py-5 bg-light">
      <div class="container">
        <div class="row">
          <div class="col-sm-6 offset-sm-3 text-center">

            <a onclick="history.back()" class="btn btn-primary my-2" style="color: #fff;">戻る</a>
            <a class="btn btn-primary my-2"  href="equipmentInsertComplete.php?genre=<?php echo $genre ?>">追加する</a>
            <h2 class="equipment-title">プレビュー</h2>
            <h2 class="equipment-title"><?php echo $name ?></h2>
          </div>
          <div class="equipment-comment col-xl-10 col-lg-10 offset-xl-2 offset-lg-1">
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

          </div>
          <div class="col-md-6 col-lg-6">
            <div class="equipment-img">
              <?php foreach ($src as $val) : ?>

                <img src="<?php echo $val ?>">
              <?php endforeach; ?>

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
