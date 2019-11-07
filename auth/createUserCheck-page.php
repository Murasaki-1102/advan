<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include($_SERVER["DOCUMENT_ROOT"] ."/component/head.php"); ?>
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
            <?php if (count($errors) === 0): ?>
              <h1>会員登録完了</h1>
              <p class="mt-5"><?=$message?></p>
            <?php elseif(count($errors) > 0): ?>
              <?php foreach($errors as $value) : ?>
                <p><?=$value?></p>
              <?php endforeach ?>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php include($_SERVER["DOCUMENT_ROOT"]."/component/footer.php"); ?>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>