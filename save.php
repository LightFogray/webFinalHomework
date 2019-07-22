<?php
session_start();
include( "connect.php" );
include( "upload.php" );
//var_dump( $_FILES );
//exit;

$content = $_POST['content'];
if(!$_SESSION['user']){
	die('您必须先登录！');
}
$user = $_SESSION['user'];



$upload = new Upload();
$filename = $upload->upload( 'file1' );
//检查留言内容，定义函数


//if( $is == false && $filename == '' ){	//留言内容可以仅仅是一张图片
//	echo "<script>alert('留言内容数据不正确');</script>";
//	die();
//}

//预先定义数据库链接参数

$sql = "INSERT INTO msg (USER,content,pic) VALUES ('{$user}','{$content}','{$filename}')";	//若链接成功，则执行该sql语句	{}起到定界符的作用
//echo $sql;
//数据库执行语句
$is = $db -> query($sql);
var_dump( $is );

//header语法：发送原生http头  跳转  自动跳回，且默认有网页刷新
header("location:message.php");
?>