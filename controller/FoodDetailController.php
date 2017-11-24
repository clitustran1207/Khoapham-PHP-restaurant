<?php
	include_once('Controller.php');
	include_once('model/FoodDetailModel.php');

	class FoodDetailController extends Controller {

		public function getDetail(){
			$id = $_GET['id'];
			$alias = $_GET['alias'];

			$model = new FoodDetailModel();
			
			$food = $model->getDetail($id,$alias);
			$relatedFood = $model->getFoodByType($id);

			/*if($food==null){
				header("location:404.php");
			}*/
			$arrayData = ['food'=>$food,
						'relatedFood'=>$relatedFood
						];
			return $this->loadView('fooddetail', $arrayData);
		}
	}


?>