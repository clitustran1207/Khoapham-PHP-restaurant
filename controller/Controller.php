<?php
	class Controller{
		public function __construct(){
			date_default_timezone_set("Asia/Ho_Chi_Minh");
		}

		public function loadView($view, $data=[]){ //mảng data sẽ lưu data load ra từ database cho cái view đó
			include_once('view/layout.php');

		}


	}
?>