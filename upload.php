<?php
class Upload{
	function __construct(){
		
	}
	
	function upload( $formName ){
		
		if( isset($_FILES[$formName]) && $_FILES[$formName]['error'] <> 4){ //error--等于4时，表示用户没有上传文件
		$file = $_FILES[$formName];
	//	判断上传是否成功
		if( $file['error'] > 0 )//如果有错
		{
			die("文件上传失败");
		}
	//	pathinfo() 函数以数组的形式返回文件路径的信息
	//  判断文件后缀
		$ext = pathinfo( $file['name'],PATHINFO_EXTENSION );
		if( $ext != 'jpg' && $ext != 'png' && $ext != 'gif' ){
			die("不被允许的文件后缀");
		}
		
		//控制文件大小
		if($file['size'] > 1024*1024*2)	//2M大小  1024字节*1024kb
		{
			die("只能上传2M大小的文件");
		}
		
	//	通过函数将其上传的临时文件移动到服务器的指定文件夹中
	//	随机生成文件名
		$filename = uniqid().".jpg";
			move_uploaded_file( $file["tmp_name"], "./upload/{$filename}" );
			return $filename;
		}else{
			return '';
		}
			
	}
}	
	
?>