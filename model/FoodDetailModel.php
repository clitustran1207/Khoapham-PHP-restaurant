<?php
	require_once('DBConnect.php');

	class FoodDetailModel extends DBConnect{
		
		public function getDetail($id,$alias=''){

			$sql = "SELECT f.* FROM foods f
					INNER JOIN page_url p
					ON f.id_url = p.id
					WHERE f.id = $id"; 	
			if ($alias!='') {
				$sql .= " AND p.url = '$alias'";
			}
			$this->setQuery($sql);
			return $this->loadRow();
		}

		public function getFoodByType($id_food){
			$sql = "SELECT f.*, p.url FROM foods f
					INNER JOIN page_url p
					ON f.id_url = p.id
					WHERE id_type = (
							SELECT id_type FROM foods WHERE id=$id_food)
					AND f.id <> $id_food
					ORDER BY f.update_at DESC
					LIMIT 0,20
					";
			$this->setQuery($sql);
			return $this->loadAllRows();
		}
	}
?>