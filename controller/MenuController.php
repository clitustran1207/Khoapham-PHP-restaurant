<?php
	include_once('Controller.php');

	class MenuController extends Controller {

		public function getFoodMenu(){
			return $this->loadView('foodmenu');
		}
	}


?>