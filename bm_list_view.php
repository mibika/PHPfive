<?php
//0. SESSION開始！！
session_start();

include("funcs2.php");  //funcs.phpを読み込む（関数群）
$pdo = db_conn();      //DB接続関数
sschk();

//２．データ登録SQL作成
$stmt   = $pdo->prepare("SELECT * FROM gs_bm_table"); //SQLをセット
$status = $stmt->execute(); //SQLを実行→エラーの場合falseを$statusに代入


// //３．データ表示
// $view=""; //HTML文字列作り、入れる変数
// if($status==false) {
//   //SQLエラーの場合
//   sql_error($stmt);
// }else{
//   //SQL成功の場合
//   while( $r = $stmt->fetch(PDO::FETCH_ASSOC)){ //データ取得数分繰り返す
//     //以下でリンクの文字列を作成, $r["id"]でidをdetail.phpに渡しています
//     $view .= '<a href="bm_update_view.php?'."ブックマーク更新".'">';
//     $view .= '<a href="bm_list_view2.php?'."ブックマーク表示".'">';
//     $view .= '<a href="bm_update_view.php?'."ユーザー登録".'">';
//     $view .= '<; href="select2.php?id='."ユーザー表示".'">';
//   }
// }

//３．データ表示
$view=""; //HTML文字列作り、入れる変数
if($status==false) {
  //SQLエラーの場合
  sql_error($stmt);
}else if ( $_SESSION["kanri_flg"] == 1){
  //SQL成功の場合
    $view .= '<a href="index2.php">ブックマーク登録</a>';
    $view .= '<br>';
    $view .= '<a href="bm_list_view2.php">ブックマーク表示</a>';
    $view .= '<br>';
    $view .= '<a href="index3.php">ユーザー登録</a>';
    $view .= '<br>';
    $view .= '<a href="bm_list_view3.php">ユーザー表示</a>';
  }else if ($_SESSION["kanri_flg"] == 0){
  //SQL成功の場合
  $view .= '<a href="index2.php">ブックマーク登録</a>';
  $view .= '<br>';
  $view .= '<a href="bm_list_view2.php">ブックマーク更新</a>';
  }




?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ブックマークアプリ</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">データ一覧</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron"><?=$view?></div>
</div>
<!-- Main[End] -->

</body>
</html>
