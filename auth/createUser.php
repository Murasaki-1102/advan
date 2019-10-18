<?php
session_start();

header("Content-type: text/html; charset=utf-8");

//クリックジャッキング対策
header('X-FRAME-OPTIONS: SAMEORIGIN');

//データベース接続
require_once("../database/db.php");
$dbh = db_connect();

//エラーメッセージの初期化
$errors = array();

if(empty($_POST)) {
	header("Location: ../index.php");
	exit();
}else{
	$urltoken = $_SESSION['urltoken'];
	$mailAdress = $_SESSION['mailAdress'];
	$account = $_SESSION['account'];
	$grade = $_SESSION['grade'];
	$password_hash =  password_hash($_SESSION['password'], PASSWORD_DEFAULT);
}

if (count($errors) === 0){

	//ここでデータベースに登録する
	try{
		//例外処理を投げる（スロー）ようにする
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$statement = $dbh->prepare("SELECT * FROM member WHERE mailAdress='$mailAdress' AND flag =1");
		$statement->bindValue(':mailAdress', $mailAdress, PDO::PARAM_STR);
		$statement->execute();
		$row = $statement->fetch();
		if($row > 0){
			$errors['mail'] = "このメールアドレスは既に使用されています。";
		}else{

			$dbh->beginTransaction();

			$statement = $dbh->prepare("INSERT INTO member (urltoken,mailadress,account,grade,password,date) VALUES (:urltoken,:mailadress,:account,:grade,:password_hash,now() )");

			//プレースホルダへ実際の値を設定する
			$statement->bindValue(':urltoken', $urltoken, PDO::PARAM_STR);
			$statement->bindValue(':mailadress', $mailAdress, PDO::PARAM_STR);
			$statement->bindValue(':account', $account, PDO::PARAM_STR);
			$statement->bindValue(':grade', $grade, PDO::PARAM_STR);
			$statement->bindValue(':password_hash', $password_hash, PDO::PARAM_STR);
			$statement->execute();

			$dbh->commit();

			//データベース接続切断
			$dbh = null;

			$url = "http://advancedcreators.undo.jp/site/list/auth/createUserCheck.php"."?urltoken=".$urltoken;

			$mailTo = $mailAdress;  //宛先メールアドレス
			$subject = "【Advan】会員登録用URLのお知らせ";

			$content ="{$account} 様\n";
			$content .="24時間以内に下記のURLに進んでください\n";
			$content .="{$url}";

			$headers = <<<HEAD
			Return-Path: tbtechbase@gmail.com
			HEAD;

			$is_success = mb_send_mail($mailTo, $subject, $content, $headers);

			if(!$is_success) {
				$errors['mail_error'] = "メールの送信に失敗しました。";
			}else {
				$message = "メールをお送りしました。24時間以内にメールに記載されたURLへ進んでください。";
			}

		}

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
			<a name="Login"></a>
			<div class="row">
				<div class="col-lg-12">
					<div class="row">
						<div class="col-lg-12">
							<div class="well bs-component">

								<?php if (count($errors) === 0): ?>
									<p><?=$message?></p>
									<p>↓このURLが記載されたメールが届きます。</p>
									<a href="<?=$url?>"><?=$url?></a>
								<?php elseif(count($errors) > 0): ?>
									<?php foreach($errors as $value){
										echo "<p>".$value."</p>";
									} ?>
									<input type="button" value="戻る" onClick="history.back()">
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- フッターの読み込み -->
	<?php include("../component/footer.php"); ?>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
