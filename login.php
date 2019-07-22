<?php

try{
	session_start();
	$dbname = 'qian';
	$user = 'root';
	$password = 'qwh263625';
	
	$dbh = new PDO("mysql:host=localhost;dbname=".$dbname,$user,$password);
	
	$dbh->beginTransaction();//启动事务
	
	$dbh->exec('SET NAMES UTF8');
	
	$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	//表单获取的用户名与密码
	$username = $_POST['param_name'];
	$password = $_POST['param_pass'];
//	echo $username,$password;

	$sql = "select password from lywebuser where username='{$username}'";

	$result = $dbh->query($sql);
	
	$data = $result->fetch(PDO::FETCH_ASSOC);
	
//	echo $data['password'];
	
	if($password == $data['password']){
		$_SESSION['user'] = $username;
		echo 
		"<script>
			alert('登录成功');
			window.location = 'index.html';	
		</script>";
	}else{
		echo 
		"<script>
			alert('登录失败');
			window.location = 'login.html';	
		</script>";
	}
	
	
	
	$dbh->commit();//提交事务
	
}catch(PODException $e){
	echo $e->getMessage();
	$dbh->rollBack();//事务回滚
}
?>