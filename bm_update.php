<?php
//0. SESSION開始！！
session_start();

include("funcs2.php");  //funcs.phpを読み込む（関数群）
$pdo = db_conn();      //DB接続関数
sschk();

//1. POSTデータ取得
$bn = $_POST['bn'];
$ur = $_POST['ur'];
$cm = $_POST['cm']; //今回追加してます
$id = $_POST['id'];   //idを取得
$dt = $_POST['dt'];

//３．データ登録SQL作成
//$sql = "update gs_bm_table set bn=:bn, ur=:ur, cm=:cm, dt=:dt where id=:id";
$sql = "update gs_bm_table set bn=:bn, ur=:ur, cm=:cm where id=:id";


$stmt = $pdo->prepare($sql);

$stmt->bindValue(':bn',$bn,PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':ur', $ur,  PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':cm',   $cm,    PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行


//４．データ登録処理後
if($status==false){

    sql_error($stmt);
}else{

    redirect("bm_list_view.php");
}

?>
