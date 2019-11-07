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
            <form action="createUser.php" method="POST">
              <fieldset>
                <legend>会員登録確認</legend>
                <div class="form-group">
                  <label for="mailAdress" class="col">mailAdress：<?=htmlspecialchars($mailAdress, ENT_QUOTES)?></label>
                </div>
                <div class="form-group">
                  <label for="account" class="col" name="account">accountName：<?=htmlspecialchars($account, ENT_QUOTES,'UTF-8')?></label>
                </div>
                <div class="form-group">
                  <label for="grade" class="col">grade：<?=htmlspecialchars($grade, ENT_QUOTES,'UTF-8')?></label>
                </div>
                <div class="form-group">
                  <label for="password" class="col">password：<?=$password_hide?></label>
                </div>
                <div class="form-group">
                  <div class="col">
                    <button type="submit" class="btn btn-success">登録</button>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col">
                    <button type="button" class="btn btn-primary" onclick="history.back()">戻る</button>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col">
                    <input type="hidden" name="hidden" value="create">
                  </div>
                </div>
              </fieldset>
						</form>
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
