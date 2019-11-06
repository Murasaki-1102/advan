<?php
session_start();

header("Content-type: text/html; charset=utf-8");

//クリックジャッキング対策
header('X-FRAME-OPTIONS: SAMEORIGIN');

//データベース接続
require_once($_SERVER["DOCUMENT_ROOT"]."/database/db.php");
$dbh = db_connect();

	$errors = array();
	$urltoken = hash('sha256',uniqid(rand(),1));
	$mailAdress = $_SESSION['mailAdress'];
	$account = $_SESSION['account'];
	$grade = $_SESSION['grade'];
	$password_hash =  password_hash($_SESSION['password'], PASSWORD_DEFAULT);
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

			$url = "http://localhost/auth/createUserCheck.php"."?urltoken=".$urltoken;

			$mailTo = $mailAdress;  //宛先メールアドレス
			$subject = "【Advan】会員登録用URLのお知らせ";

			$content ="{$account} 様\n";
			$content .="24時間以内に下記のURLに進んでください\n";
			$content .="{$url}";

			$headers = <<<HEAD
			From: c011729114@edu.teu.ac.jp
			Return-Path: c011729114@edu.teu.ac.jp
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
	include($_SERVER["DOCUMENT_ROOT"] ."/auth/createUser-page.php");
?>