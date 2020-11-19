<?php
$host = '127.0.0.1';
$dbuser = 'root';
$pwd = '123456';
$dbname = 'qian';	//数据库名

$db = new mysqli( $host, $dbuser, $pwd, $dbname);
if($db -> connect_errno <> 0)
{
	echo "链接失败";
	
}
$db->query("SET NAMES UTF8");//使数据传输编码方式为utf8
?>
