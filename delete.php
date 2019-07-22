<?php
include( "connect.php" );

//session_start();
//管理员才能实现删除功能
//if( isset($_SESSION['login']) === false ){
//	die("需要管理员登录才能进行删除功能");
//}

$id = (int) $_GET['id'];//避免sql注入攻击
if( $id < 1 ){
	die("无效数据");
}
$sql = "DELETE FROM msg WHERE id='{$id}'";
$is = $db->query( $sql );
header("location:message.php");
?>