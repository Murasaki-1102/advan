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
            <form  action="/main/equipmentInsertCheck.php" method="POST" enctype="multipart/form-data" name="Insert">
              <fieldset>
                <legend>機材追加</legend>
                <div class="form-group">
                  <label for="maker" class="col">maker</label>
                  <div class="col">
										<input type="text" class="form-control" id="maker" name="maker" placeholder="YAMAHA" value="">
										<span id="maker-error" class="error-message"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="name" class="col">name</label>
                  <div class="col">
										<input type="text" class="form-control" id="name" name="name" placeholder="MGP32X" value="">
										<span id="name-error" class="error-message"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="category" class="col">category</label>
                  <div class="col">
                    <select class="form-control" id="category" name="category">
                      <option value="" style="display: none;">選択してください</option>
                      <option value="Sound">Sound</option>
                      <option value="Stage">Stage</option>
											<option value="Light">Light</option>
											<option value="Other">Other</option>
										</select>
										<span id="category-error" class="error-message"></span>
                  </div>
								</div>
								<div class="form-group">
                  <label for="subCategory" class="col">subCategory</label>
                  <div class="col">
                    <select class="form-control" id="subCategory" name="subCategory" disabled>
                      <option value="" style="display: none;">選択してください</option>
											<option value="mixer" data-val="Sound">mixer</option>
											<option value="processor" data-val="Sound">processor</option>
											<option value="cable" data-val="Sound">cable</option>
											<option value="other" data-val="Sound">other</option>

											<option value="mic" data-val="Stage">mic</option>
											<option value="speaker" data-val="Stage">speaker</option>
											<option value="amp" data-val="Stage">amp</option>
											<option value="processor" data-val="Stage">processor</option>
											<option value="cable" data-val="Stage">cable</option>
											<option value="other" data-val="Stage">other</option>

											<option value="lightning console" data-val="Light">lightning console</option>
											<option value="lamp" data-val="Light">lamp</option>
											<option value="dimmer" data-val="Light">dimmer</option>
											<option value="other" data-val="Light">other</option>

											<option value="other" data-val="Other">other</option>
										</select>
										<span id="subCategory-error" class="error-message"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="comment" class="col">comment</label>
                  <div class="col">
										<textarea class="form-control" id="comment" name="comment" placeholder="使いやすいです。"value=""></textarea>
										<span id="comment-error" class="error-message"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="stock" class="col">stock</label>
                  <div class="col">
                    <input type="text" class="form-control" id="stock" name="stock" placeholder="1台" value="">
										<span id="stock-error" class="error-message"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="weight" class="col">weight</label>
                  <div class="col">
                    <input type="text" class="form-control" id="weight" name="weight" placeholder="20kg" value="">
										<span id="weight-error" class="error-message"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="power" class="col">power</label>
                  <div class="col">
                    <input type="text" class="form-control" id="power" name="power" placeholder="90W" value="">
										<span id="power-error" class="error-message"></span>
                  </div>
                </div>
                <div class="custom-file my-3">
                  <label class="custom-file-label" for="customFile">画像3枚まで選択...</label>
                  <div class="col">
                    <input type="file" class="custom-file-input" name="img[]" id="imgs" accept="image/jpeg, image/gif, image/png" multiple="multiple">
										<span id="imgs-error" class="error-message mt-2"></span>
									</div>
                </div>

                <div class="form-group mt-5">
                  <div class="col">
                    <button type="submit" class="btn btn-primary" id="btn">プレビュー</button>
                  </div>
                </div>
              </fieldset>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

	<footer>
  <?php include($_SERVER["DOCUMENT_ROOT"]."/component/footer.php"); ?>
	</footer>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script type="text/javascript" src="/js/equipmentInsert.js"></script>
</body>
</html>