<?php
session_start();

header("Content-type: text/html; charset=utf-8");

// ログイン状態のチェック
if (!isset($_SESSION["mailAdress"])) {
	header("Location: login_form.php");
	exit();
}

$mailAdress = $_SESSION['mailAdress'];
echo "<p>".htmlspecialchars($mailAdress,ENT_QUOTES)."さん、こんにちは！</p>";

echo "<a href='logout.php'>ログアウトする</a>";
?>
