<?php 
//loout.phpはコピペで使用OK（ログアウトの記述は決まり文句）

//1番最初に必ず記述
session_start();

//SESSIONを初期化（空っぽにする）
$_SESSION = array();

//Cookieに保存してある'SessionIDの保存期間を過去にして破棄
if(isset($_COOKIE[session_name()])){//session_name()はセッションIDを返す関数
  setcookie(session_name(), '', time()-42000,'/');
}

//サーバー側での、セッションIDの破棄(セッションのファイルをこの記述で削除している)
session_destroy();

//処理後、login.php(初期画面）へリダイレクト（毎回変える必要があるのはこの遷移先のみ。あとはコピペで使う！）
header('Location: login.php')

?>