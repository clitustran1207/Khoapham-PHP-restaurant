<?php
	include_once('Controller.php');
	include_once('model/HomeModel.php');
	include_once('model/pager.php');

	class HomeController extends Controller {

		public function getIndex(){
			$model = new HomeModel();
			$today = $model->getTodayFood(); //gọi hàm lấy data ra từ model
			$food = $model->getFoodPagination(); //lấy số phần tử trong food ra để đếm trước

			//tạo 4 tham số để truyền vào pager
			$totalItem = count($food); //62
			$currentPage = (isset($_GET['page']) && $_GET['page'] !=0 ) ? abs($_GET['page']) : 1; //
			$soluong = 6;
			$nPageShow = 4;

			$pager = new Pager($totalItem,$currentPage,$soluong,$nPageShow);

			$vitri = ($currentPage-1)*$soluong; 
			$food = $model->getFoodPagination($vitri,$soluong);

			$showPagination = $pager->showPagination();

			$arrayData = [ //tạo mảng này, để có thể truyền nhiều mảng con qua cho Controller vì trang này có nhiều mảng phải truyền qua
						'today'=>$today, 
						'foodlist'=>$food,
						'pagination'=>$showPagination
						]; 


			return $this->loadView('homepage', $arrayData); //truyền view và data cho hàm loadview
		}
	}


?>