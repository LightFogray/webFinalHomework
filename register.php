<?php
try{
	$user = "root";
	$pass = "qwh263625";
	$dbname = "qian";
	$dbh = new PDO('mysql:host=localhost;dbname='.$dbname,$user,$pass);
	
	$dbh->beginTransaction();//启动一个事务

	$dbh->exec("SET NAMES 'UTF8'");//编码格式
	$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
//	if($dbh){
//		echo "数据库连接成功";
//	}
	
	
	$username = $_POST['param_name'];
	$userpass = $_POST['param_pass'];
	$userpassrep = $_POST['param_pass_rep'];
	
//	var_dump($username,$userpass,$userpassrep);
	//再次验证
	if($userpass != $userpassrep){
		die('密码不一致！');
	}
	//若用户名密码存在则执行插入语句
	if(isset($username) && isset($userpass)){
		$sql1 = "INSERT INTO `lywebuser` (`username`, `password`) VALUES ('{$username}', '{$userpass}')";
		$dbh->query($sql1);
//		header("location:register.html");
		echo "<script>
			alert('注册成功');
			window.location = 'login.html';	
		</script>";
	}
	
	

//	$rec = $dbh->exec($sql);

//	echo "受影响的行数为：".$rec;

$dbh->commit();//提交事务

}catch(PDOException $e){
	$dbh->rollBack();//事务回滚
	echo $e->getMessage();
}
?>