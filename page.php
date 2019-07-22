<?php
#将页码封装成类
class Page{
	public $maxPage;
	public $page;
	function __construct( $dataTotal, $pageNum ){//构造函数  实例化即执行
		
				
		//获取当前页码，若存在则赋值如不存在则默认为1
		if( isset( $_GET['page'] ) ){
			$this->page = $_GET['page'];
		}else{
			$this->page = 1;
		}

		
		
		$this->maxPage = ceil($dataTotal / $pageNum);
		
		//计算数据偏移量
		$this->offset = ($this->page-1) * $pageNum;

	}
	function show(){
		for( $i = 1; $i <= $this->maxPage; $i++ ){
				if($i == $this->page){
					echo "<a class='hover' href='message.php?page={$i}'>{$i}</a>";
				}else{
					echo "<a href='message.php?page={$i}'>{$i}</a>";
				}
				
			}	
	}
}


?>