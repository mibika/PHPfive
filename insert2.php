<?php
//0. SESSION開始！！
session_start();

ini_set('display_errors', 'On'); // エラーを表示させるようにしてください
error_reporting(E_ALL); // 全てのレベルのエラーを表示してください

include("funcs2.php");  //funcs.phpを読み込む（関数群）
$pdo = db_conn();      //DB接続関数
sschk();

//1. POSTデータ取得
//$name = filter_input( INPUT_GET, ","name" ); //こういうのもあるよ
//$email = filter_input( INPUT_POST, "email" ); //こういうのもあるよ
$bn = $_POST['bn'];
$ur = $_POST['ur'];
$cm = $_POST['cm'];

//３．データ登録SQL作成
$stmt = $pdo->prepare("insert into gs_bm_table(bn,ur,cm) values(:bn, :ur, :cm)");
$stmt->bindValue(':bn', $bn, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':ur', $ur, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':cm', $cm, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("SQL_ERROR:".$error[2]);
}else{
  //５．index.phpへリダイレクト
header('Location: index2.php');
exit();
}
?>
