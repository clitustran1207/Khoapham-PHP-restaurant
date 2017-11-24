<?php
	require_once('DBConnect.php');

	class HomeModel extends DBConnect{
		public function getTodayFood(){
			$sql = "SELECT f.*,p.url FROM `foods` f
					INNER JOIN page_url p
					ON f.id_url = p.id 
					WHERE today=1";
			$this->setQuery($sql);
			return $this->loadAllRows();
		}

		public function getFoodPagination($vitri=-1, $soluong=0){ //đưa -1 vào để query LIMIT sẽ lỗi, k cho nối vào
			$sql = "SELECT f.*,p.url FROM `foods` f
					INNER JOIN page_url p
					ON f.id_url = p.id";

			if ($vitri >= 0 && $soluong > 0) {
				$sql .= " LIMIT $vitri, $soluong";
			}
			$this->setQuery($sql);
			return $this->loadAllRows();
		}
	}

	
?>