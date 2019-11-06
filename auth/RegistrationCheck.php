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

if(empty($_POST)) {
  header("Location: /");
  exit();
}else{
  //POSTされたデータを変数に入れる
  $mailAdress = spaceTrim(isset($_POST['mailAdress']) ? $_POST['mailAdress'] : NULL); //三項演算子
  $account = spaceTrim(isset($_POST['account']) ? $_POST['account'] : NULL);
  $grade = spaceTrim(isset($_POST['grade']) ? $_POST['grade'] : NULL);
  $password = spaceTrim(isset($_POST['password']) ? $_POST['password'] : NULL);
  $password_hide = str_repeat('*', strlen($password));

  $_SESSION['mailAdress'] = $mailAdress;
  $_SESSION['account'] = $account;
  $_SESSION['grade'] = $grade;
  $_SESSION['password'] = $password;

  include($_SERVER["DOCUMENT_ROOT"] ."/auth/registrationCheck-page.php");
}
?>