<?php
//SPL Countable接口示例
class Courier implements Countable{
	protected count = 0;
	
	public function ship(Parcel $parcel){
		$this->$count++;
		return true;
	}
	public function count(){
		return $this->$count;
	}
}
?>