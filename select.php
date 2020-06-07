<?php 

//0.セッションの記述（この項目は基本コピペで使い回しOK)
session_start();
include('funcs.php');//別の階層にfuncs.phpがある場合は「betukaisou/funcs.php」などパスを変えてincludesする
loginCheck();
$pdo = db_connect();//1.DB接続のコピペの記述を関数化したものの呼び出し(この関数外でも使用している変数（＄pdo)が使用できるように関数内でリターンし、関数の呼び出し時に変数の＄pdoで変数処理している


//2．データ登録SQL作成(sqlのところのtable名だけその時々で変えて、あとは基本のまるコピ)
//prepare("")の中にはmysqlのSQLで入力したINSERT文を入れて修正すれば良いイメージ
$stmt = $pdo->prepare("SELECT* FROM gs_user_table");
$status = $stmt->execute();


//3．データ登録処理後（基本コピペ使用でOK)
$view='';
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("SQLError:".$error[2]);//エラーが起きたらエラーの2番目の配列から取ります。ここは考えず、これを使えばOK
                             // SQLEErrorの部分はエラー時出てくる文なのでなんでもOK
}else{
 //selectデータの数だけ自動でループしてくれる
 while( $r = $stmt->fetch(PDO::FETCH_ASSOC)){
  //このwhile内の記述は必要に応じて変更する。ここでやっていることは各項目名を指定して表示している


  //更新用リンクを埋め込んだ表示コード(元のselect.phpから修正する箇所)
  $view .='<p>';
  // $view .='<a href="u_view.php? id='.$r["id"].'">';
  $view .=$r["indate"]." : ログイン中の方は ".$r["uname"].'  さんです';
  // $view .='</a>';
//以下はupdateのリンクタグの記述
  $view .='  ';
  $view .='<a href="U_view.php? id='.$r["id"].'">';
  $view .='[更新]';
  $view .='</a>';
//以下はdeleteのリンクタグの記述
  $view .='  ';
  $view .='<a href="delete.php? id='.$r["id"].'">';
  $view .='[削除]';
  $view .='</a>';
  $view .='</p>';
 }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h1>登録内容表示</h1>
  <a href="index.php">データ登録</a>
  <a href="logout.php">Logout</a>
 <p><?=$view?></p>
</body>
</html>