<?php
	include_once('Controller.php');

	class SearchController extends Controller {

		public function getSearch(){
			return $this->loadView('search');
		}
	}


?>