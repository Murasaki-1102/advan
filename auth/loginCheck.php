<?php
session_start();

header("Content-type: text/html; charset=utf-8");

//クリックジャッキング対策
header('X-FRAME-OPTIONS: SAMEORIGIN');

//前後にある半角全角スペースを削除する関数
function spaceTrim ($str) {
	// 行頭
	$str = preg_replace('/^[ 　]+/u', '', $str);
	// 末尾
	$str = preg_replace('/[ 　]+$/u', '', $str);
	return $str;
}

if(empty($_POST)) {
	header("Location: login.php");
	exit();
}else{
	//POSTされたデータを各変数に入れる
	$mailAdress = spaceTrim(isset($_POST['mailAdress']) ? $_POST['mailAdress'] : NULL);
	$password = spaceTrim(isset($_POST['password']) ? $_POST['password'] : NULL);

	//データベース接続
	require_once($_SERVER["DOCUMENT_ROOT"]."/database/db.php");
	$dbh = db_connect();

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
				header("Location: mypage.php");
				exit();
			}else{
				$_SESSION["password_error"]= "パスワードが一致しません。";
				$_SESSION['mailAdress'] = $mailAdress;
				header("Location: login.php");
			}
		}else{
			$_SESSION['mailAdress_error'] = "メールアドレス及びパスワードが一致しません。";
			$_SESSION['mailAdress'] = $mailAdress;
			header("Location: login.php");
		}
		//データベース接続切断
		$dbh = null;

	}catch (PDOException $e){
		print('Error:'.$e->getMessage());
		exit();
	}
}
?>
