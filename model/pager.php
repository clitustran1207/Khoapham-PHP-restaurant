<?php 
/**
* Phân trang by Huong Huong
*/
class Pager{

	private $_totalItem;// tổng số item
	public $_nItemOnPage; // số lượng item trong 1 page
	private $_nPageShow ; // số lượng link page hiển thị
	private $_totalPage; // tổng số page
	private $_currentPage; // page hiện tại

	//10.3 => 11
	//6

	public function __construct($totalItem,$currentPage = 1,$nItemOnPage = 5,$nPageShow = 5){
		$this->_totalItem 	= $totalItem;
		$this->_nItemOnPage	= $nItemOnPage;

		if ($nPageShow%2==0) {
			$nPageShow 		= $nPageShow + 1; //số trang hiện ra nên là số lẻ, để trang hiện tại luôn dc canh giữa và tránh trang bị chuyển thành số thập phân
		}

		$this->_nPageShow 	= $nPageShow;
		$this->_currentPage = $currentPage;
		$this->_totalPage  	= ceil($totalItem/$nItemOnPage); //ceil(62/6) = 11;
	}

	public function get_nItemOnPage(){
		return $this->_nItemOnPage;
	}
	public function getCurrentPage(){
		return $this->_currentPage;
	}
	public function showPagination(){
		
		$paginationHTML 	= '';
		if($this->_totalPage > 1){
			$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; 

			//http($SERVER['HTTPS']) ://localhost:8888($SERVER[HTTP_POST]) /Khoapham/restaurant/?page=1($SERVER[REQUEST_URI])


			/*if(isset($_GET['page'])){
				if((int)($_GET['page'])>=10){
					$actual_link = substr($actual_link,0,-8);
				}
				else{
					$actual_link = substr($actual_link,0,-7);
				}
			}*/

			$actual_link = explode('?page=', $actual_link)[0]; //cắt phần link ra khỏi tham số page, lấy phần tử đầu tiên để làm actual_link

			//làm start và prev
			$start 	= '';
			$prev 	= '';
			if($this->_currentPage > 1){ //nếu đang ở từ trang 2 trở đi
				$start 	= "<li><a href='$actual_link?page=1'>Start</a></li>"; //start sẽ gán link đến page=1
				$prev 	= "<li><a href='$actual_link?page=".($this->_currentPage-1)."'>«</a></li>"; //prev sẽ gán link đến trang hiện tại trừ 1
			}

			//làm next và end
			$next 	= '';
			$end 	= '';
			if($this->_currentPage < $this->_totalPage){ //nếu không phải ở trang cuối cùng
				$next 	= "<li><a href='$actual_link?page=".($this->_currentPage+1)."'>»</a></li>"; //next sẽ gán link đến trang tiếp theo
				$end 	= "<li><a href='$actual_link?page=".$this->_totalPage."'>End</a></li>"; //end sẽ gán link đến trang cuối cùng
			}

			//chỗ này sẽ tùy chỉnh số trang hiển thị ra ngoài
			if($this->_nPageShow < $this->_totalPage){ //nếu số trang muốn hiển thị ra nhỏ hơn tổng số trang
				if($this->_currentPage == 1){ //nếu đang ở trang đầu
					$startPage 	= 1; 
					$endPage 	= $this->_nPageShow; //hiện ra ngoài từ trang 1 đến số trang muốn hiện ra (1-4)
				}else if($this->_currentPage == $this->_totalPage){ //nếu đang ở trang cuối
					$startPage		= $this->_totalPage - $this->_nPageShow + 1; //trang đầu tiên = tổng trang - số trang muốn hiện +1 (11-5+1 = 8)
					$endPage		= $this->_totalPage; //trang cuối cùng = tổng trang
				}else{ //nếu ở giữa
					$startPage		= $this->_currentPage - ($this->_nPageShow-1)/2;
								  //= 8 - (5-1)/2 = 6 
					$endPage		= $this->_currentPage + ($this->_nPageShow-1)/2; //= 8 + (5-1)/2 = 10

					if($startPage < 1){ // ? làm sao có  trường hợp này được??? 
						$endPage	= $endPage + 1;
						$startPage 	= 1;
					}
					if($endPage > $this->_totalPage){ //nếu trang cuối cùng lớn hơn tổng số trang (đang ở trang 10, endpage sẽ lên tới 10 + (5-1)/2 = 12)
						$endPage	= $this->_totalPage; //đặt lại trang cuối cùng
						$startPage 	= $endPage - $this->_nPageShow + 1; // = 11 - 5 + 1 = 7
					}
				}

			}else{ //trường hợp này số trang muốn hiện ra lớn hơn tổng số trang, v thì là hiện ra hết
				$startPage		= 1;
				$endPage		= $this->_totalPage;
			}
			

			//active trang đang hiển thị và gán link cho các trang khác
			$listPages = '';
			for($i = $startPage; $i <= $endPage; $i++){
				if($i == $this->_currentPage) {
					$listPages .= "<li class='active'><a href='#'>".$i.'</a>'; //kích hoạt trạng thái "active" cho trang đang hiện thị
				}else{
					$listPages .= "<li><a href='$actual_link?page=".$i."'>".$i.'</a>'; //gán link cho các trang khác
				}
			}
			$paginationHTML = '<ul class="pagination">'.$start.$prev.$listPages.$next.$end.'</ul>'; //gọi class pagination để hiển thị trang, sau đó nối chuỗi bằng các biến đã gán giá trị trước đó
		}
		return $paginationHTML;
	}
}


 ?>