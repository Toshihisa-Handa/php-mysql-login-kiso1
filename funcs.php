<?php 
//1.共通に使う関数を記述

//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES);
}


//2.セッションリジェネレイト処理を全てのページで行うため、関数化し記述を簡略化する(Login認証)

//手打ち入力でログイン後のページにログインせずに行ってもエラーになるようにしている） 
  function loginCheck(){
    if( !isset($_SESSION['chk_ssid']) || $_SESSION['chk_ssid']!=session_id()){
      echo 'Login Error!';
      exit();
    }
    else{//elseの記述は元のコードではなく新規記述
      session_regenerate_id(true);
      $_SESSION['chk_ssid'] = session_id();
      // echo $_SESSION['chk_ssid'];
    }

  }
   

//3.DB接続を関数化
function db_connect(){
  try {
    //localhostの時はこれ。さくらの場合さくらのデータベースをいれる
    //Password:MAMP='root',XAMPP=''
    $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','root');
  } catch (PDOException $e) {//$eにエラー内容が入っている。
    exit('DBConnectError:'.$e->getMessage());//ここのDBConnectErrorはエラー時の文字表示の為、ここはなんでも良い。この項目２は基本idとpass以外コピペで覚えればOK
  }
 return $pdo;//※重要！！※ ここでリターンすることで他の項目でも使用している変数($pdo)を関数の外でも使用できるようにしている
}




?>