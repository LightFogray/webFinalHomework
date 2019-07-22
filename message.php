<?php

include( 'page.php' );
session_start();
//var_dump($p);
// D:\xampp\php
$host = '127.0.0.1';
$dbuser = 'root';
$pwd = 'qwh263625';
$dbname = 'qian';	//数据库名
$db = new mysqli( $host, $dbuser, $pwd, $dbname);

$db->query("SET NAMES UTF8");//使数据传输编码方式为utf8

$sql = "SELECT count(*) as t FROM msg";
$mysqli_result = $db->query($sql);
$row = $mysqli_result->fetch_array( MYSQLI_ASSOC );
//var_dump($row['t']);


//数据总量
$dataTotal = $row['t'];
//每页显示数量
$pageNum = 1;

$p = new Page( $dataTotal, $pageNum );

//$maxPage = ceil( $dataTotal / $pageNum );


$sql = "SELECT * FROM msg ORDER BY id DESC LIMIT {$p->offset},{$pageNum}";//LIMIT函数----跳过几条，显示几条
//执行sql
$mysqli_result = $db->query( $sql );
//var_dump( $mysqli_result );
if($mysqli_result === false){
	echo "sql错误";
	exit;
}
$rows = [];
while($row = $mysqli_result->fetch_array( MYSQLI_ASSOC )){	//循环显示所有留言
	$rows[] = $row;											//存入数组，自动生成键值对

}
//var_dump( $rows );
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="首页">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <meta name="render" content="webkit">
    <title>留言</title>
	<link rel="stylesheet" href="css/bootstrap.css">	
    <link rel="stylesheet" href="css/base.css">
	<script src="http://hovertree.com/ziyuan/jquery/jquery-1.12.1.min.js"></script>
</head>
<body>
<div class="container-fluid">
	<div id="header">
		<nav class="navbar">
			<div class="container-fluid">
				<div class="navbar-header">
					<img src="img/Mountain.png" width="40"/>
					<a class="navbar-brand" href="####" style="margin-right:30px">洛阳风光</a>
				</div>

				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li class="active"><a href="index.html">首       页<span class="sr-only"></span></a></li>
						<li class="active"><a href="city.html">城市简介<span class="sr-only"></span></a></li>
						<li class="active"><a href="famous_story.html">名人事迹<span class="sr-only"></span></a></li>
						<li class="active"><a href="local_scene.html">当地美景<span class="sr-only"></span></a></li>
						<li class="active"><a href="special_food.html">特色美食<span class="sr-only"></span></a></li>
						<li class="active"><a href="map_guide.html">地图导航<span class="sr-only"></span></a></li>
						<li class="active"><a href="local_star.html">当地明星<span class="sr-only"></span></a></li>
						<li class="active"><a href="message.php">留言<span class="sr-only"></span></a></li>
					</ul>
					<div id="reg_log">
						<a href="register.html">注册</a>
						/
						<a href="login.html">登录</a>
					</div>
				</div>
			</div>
		</nav>
	</div>
	<div class="space"></div>
	<!--内容区-->
	<!--<div class="container">
		
	</div>-->
	<div style="margin-top:10px">	
		<p style="text-align:center;color:rgb(160,82,45);font-size:30px;"><strong>留言</strong></p>
				
		<div class="container">
			<div class="row">
				<!--发表留言-->
				<div class="showText col-md-6" style="overflow:hidden;">
					<form action="save.php" method="post" enctype="multipart/form-data">
						<textarea class="form-control area" name="content" rows="8" cols="54" placeholder="写下你想要留言的内容吧"></textarea>
						<p>可输入<span class="text-count">180</span>/180字</p>  
						<input type="file" name="file1" class="user-file" />
						<br/>
						<input type="submit" value="发表留言" class="btn-primary btn"/>
					</form>
					<br/>
				</div>

				<!--查看留言-->
				<!--foreach循环显示留言-->
				<!--分页-->
				<div class="showMsg col-md-6">
					<div class="page">
						<?php
							$p->show();
						?>
					</div>
					<?php
					foreach( $rows as $row ){
					?>
					
					<div class="info-all">
						<div class="user">
							<span style="color: brown;">昵称: </span><?php echo $row['user']; ?><a onclick="return confirm('确认要删除吗？')" href="delete.php?id=<?php echo $row['id'] ?>" style="float: right;display: inline-block;margin-right: 10px;font-size: 13px">删除</a>
						</div>
						
						<div class="content">
							<span style="color: brown;">留言内容: </span>				
							<?php 
							echo $row['content'];
							?>
							<br/>
							<?php
								if( $row['pic'] <> 0 )//如果链接地址不为空，则img地址为pic
								echo "<img src='./upload/{$row['pic']}' class='newimg'>";
							?>
						</div>
					</div>
				</div>
				<?php
				}
				?>
			</div>
		</div>
	
	<div class="space"></div>
	<!--尾部-->
	<div class="container-fluid">
		<div id="footer">
			<div class="about1 col-md-6">
				<p>&copy; Author : Qwh & Py</p>
			</div>

			<div class="about3">
				<marquee behavior="scroll" direction="right" scrollamount=3 onmouseover=this.stop() onmouseout=this.start()><p>洛阳城里见秋风，欲作家书意万重。 ————唐·张籍 《秋思》</p></marquee>
			</div>
		</div>
	</div>
<script type="text/javascript">
	/*字数限制*/  
    $(".area").on("input propertychange", function() {  
        var $this = $(this),  
            _val = $this.val(),  
            count = "";  
        if (_val.length > 180) {  
            $this.val(_val.substring(0, 180));  
        }  
        count = 180 - $this.val().length;  
        $(".text-count").text(count);  
    }); 
</script>
</div>
</body>

</html>