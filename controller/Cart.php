<?php
/*
totalQty : 1 + 1 + 1
items : 2  [
			4=> [ 
					qty  : 2
					price: 2*25k
					item : obj{id, name,price,decs.....}
				]
		  	5=> [ 
					qty  : 1
					price: 80k
					item : obj{id, name,price,decs.....}
				]
totalPrice: 2*25k + 80k
*/
class Cart
{
	public $items = [];
	public $totalQty = 0;
	public $totalPrice = 0;

	public function __construct($oldCart=null){
		if($oldCart){ //nếu có hàng r, thì gán 
			$this->items = $oldCart->items;
			$this->totalQty = $oldCart->totalQty;
			$this->totalPrice = $oldCart->totalPrice;
		}
	}
	public function add($item, $qty=1){
		$giohang = ['qty'=>0, 'price' => $item->price, 'item' => $item]; //biến tạm lưu thông tin để cập nhật khi thêm vào
		if($this->items){ //trong items có sp hay chưa
			if(array_key_exists($item->id, $this->items)){ //trong items có sẵn sp đang muốn thêm vào hay chưa
				$giohang = $this->items[$item->id]; //nếu đã có trong mảng r thì lấy ra gán vào mảng tạm để tính toán
			}
		}
		$giohang['qty'] = $giohang['qty'] + $qty; //cộng thêm 1 = 2
		$giohang['price'] = $item->price * $giohang['qty']; //25*2     //2 bước này là cập nhật lại số lượng và giá nếu đã nằm sẵn trong kho, còn nếu chưa có thì tạo mới

		$this->items[$item->id] = $giohang;
		$this->totalQty = $this->totalQty + $qty;
		$this->totalPrice = ($this->totalPrice + $qty*$giohang['item']->price);	//trong home thì khi add to cart luôn là 1 item, nhung trong phần xem chi tiết có thể chọn số lượng, nên phải nhân thêm qty vào
	}
	//giảm số lượng đi 1
	public function reduceByOne($id){ 
		$this->items[$id]['qty']--;
		$this->items[$id]['price'] -= $this->items[$id]['item']['price']; //lấy giá - đi đơn giá
		$this->totalQty--;
		$this->totalPrice = ($this->totalPrice - $this->items[$id]['item']['price']);
		if($this->items[$id]['qty']<=0){
			unset($this->items[$id]); //xóa phần tử mảng bằng unset
		}
	}
	//xóa sp ra khỏi giỏ hàng
	public function removeItem($id){ //nhớ là cập nhật trc r mới xóa nó đi
		$this->totalQty -= $this->items[$id]['qty'];
		$this->totalPrice -= $this->items[$id]['price'];
		unset($this->items[$id]);
	}
	//update
	public function update($item, $qty){
		$giohang = [
			'qty'=>$qty, //khác với addnew thì update cho phép tùy chỉnh số lượng
			'price' => $item->price, 
			'item' => $item
		];
		$id = $item->id;
		if($this->items){
			if(array_key_exists($id, $this->items)){
				$this->totalPrice -= $this->items[$id]['price'];
				$this->totalQty -= $this->items[$id]['qty'];
			}
		}
		$giohang['price'] = $item->price * $giohang['qty'];
		$this->items[$id] = $giohang;
		$this->totalQty = $this->totalQty + $qty;
		$this->totalPrice = $this->totalPrice + ($giohang['item']->price)*$qty;
	}
	
}