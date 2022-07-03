<?php
//最初にSESSIONを開始！！ココ大事！！
session_start();

//POST値
$lid = $_POST["lid"];
$lpw = $_POST["lpw"];

//1.  DB接続します
include("funcs2.php");
$pdo = db_conn();

//* PasswordがHash化→条件はlidのみ！！
$stmt = $pdo->prepare("select * from gs_user_table where lid = :lid"); 
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
//$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);
$status = $stmt->execute();

//3. SQL実行時にエラーがある場合STOP
if($status==false){
    sql_error($stmt);
}

//4. 抽出データ数を取得
$val = $stmt->fetch();         //1レコードだけ取得する方法
//$count = $stmt->fetchColumn(); //SELECT COUNT(*)で使用可能()

//5.該当１レコードがあればSESSIONに値を代入
//入力したPasswordと暗号化されたPasswordを比較！[戻り値：true,false]
//ハッシュ化されたもの出ないとうまくいかない
$pw = password_verify($lpw, $val["lpw"]);
// $pw = $lpw == $val["lpw"];
// var_dump($pw);

//trueの場合
if( $pw ){ 
  //Login成功時、＄_SESSIONを使うとページを跨いで使える変数になる
  $_SESSION["chk_ssid"]  = session_id();
  $_SESSION["kanri_flg"] = $val['kanri_flg'];
  $_SESSION["name"]      = $val['name'];
  //Login成功時（リダイレクト）
  redirect("bm_list_view.php");
}else{
  //Login失敗時(Logoutを経由：リダイレクト)
  redirect("login2.php");
}
