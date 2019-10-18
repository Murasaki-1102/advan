<?php
session_start();

header("Content-type: text/html; charset=utf-8");

//クリックジャッキング対策
header('X-FRAME-OPTIONS: SAMEORIGIN');

//データベース接続
require_once("../database/db.php");
$dbh = db_connect();

//前後にある半角全角スペースを削除する関数
function spaceTrim ($str) {
	// 行頭
	$str = preg_replace('/^[ 　]+/u', '', $str);
	// 末尾
	$str = preg_replace('/[ 　]+$/u', '', $str);
	return $str;
}

//エラーメッセージの初期化
$errors = array();

if(empty($_POST)) {
	header("Location: login.php");
	exit();
}else{
	//POSTされたデータを各変数に入れる
	$mailAdress = spaceTrim(isset($_POST['mailAdress']) ? $_POST['mailAdress'] : NULL);
	$password = spaceTrim(isset($_POST['password']) ? $_POST['password'] : NULL);

	//アカウント入力判定
	if ($mailAdress == ''){
		$errors['mailAdress'] = "メールアドレスが入力されていません。";
	}elseif(!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $mailAdress)){
		$errors['mail_check'] = "メールアドレスの形式が正しくありません。";
	}

	//パスワード入力判定
	if ($password == ''){
		$errors['password'] = "パスワードが入力されていません。";
	}elseif(!preg_match('/^[0-9a-zA-Z]{5,30}$/', $_POST["password"])){
		$errors['password_length'] = "パスワードは半角英数字の5文字以上30文字以下で入力して下さい。";
	}else{
		$password_hide = str_repeat('*', strlen($password));
	}
}

//エラーが無ければ実行する
if(count($errors) === 0){
	try{
		//例外処理を投げる（スロー）ようにする
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		//アカウントで検索
		$statement = $dbh->prepare("SELECT * FROM member WHERE mailAdress=(:mailAdress) AND flag =1");
		$statement->bindValue(':mailAdress', $mailAdress, PDO::PARAM_STR);
		$statement->execute();

		//アカウントが一致
		if($row = $statement->fetch()){
			$password_hash = $row[password];

			//パスワードが一致
			if (password_verify($password, $password_hash)) {

				//セッションハイジャック対策
				session_regenerate_id(true);

				$_SESSION['mailAdress'] = $mailAdress;
				$_SESSION['login'] = "login";
				header("Location: http://localhost/advan/top.php");
				exit();
			}else{
				$errors['password'] = "アカウント及びパスワードが一致しません。";
			}
		}else{
			$errors['mailAdress'] = "メールアドレス及びパスワードが一致しません。";
		}

		//データベース接続切断
		$dbh = null;

	}catch (PDOException $e){
		print('Error:'.$e->getMessage());
		exit();
	}
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
	<?php include("../component/head.php"); ?>
</head>

<body>
	<!-- ヘッダーの読み込み -->
	<?php include("../component/header.php");?>
	<div class="container">
		<div class="page-header">
			<div class="row">
				<div class="col-lg-12">
					<div class="well">
						<?php if (count($errors) > 0): ?>
							<h1>ログイン失敗</h1>
							<?php
							foreach($errors as $value){
								echo "<p>".$value."</p>";
							} ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- フッターの読み込み -->
	<?php include("../component/footer.php");?>
	
	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
