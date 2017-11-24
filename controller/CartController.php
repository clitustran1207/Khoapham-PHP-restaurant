<?php
	include_once('model/FoodDetailModel.php');
	include_once('Cart.php');
	session_start();

	class CartController{
		public function addToCart(){
			$id = (int)$_POST['id']; //khi click sp, id và alias của sp đó dc truyền theo method post (bằng ajax)
			$qty = (int)$_POST['qty'];

			$model = new FoodDetailModel();
			$product = $model->getDetail($id); //lấy id đó truyền vào hàm getDetail

			$oldCart = isset($_SESSION['cart']) ? $_SESSION['cart'] : null;

			$cart = new Cart($oldCart);
			$cart->add($product, $qty);
			$_SESSION['cart'] = $cart;

			/*echo "<pre>";
			print_r($_SESSION['cart']) ;
			echo "</pre>";*/

			echo $product->name;
		}

		public function updateCart(){
			$id = (int)$_POST['id'];
			$qty = (int)$_POST['qty'];

			$model = new FoodDetailModel();
			$product = $model->getDetail($id); //lấy id đó truyền vào hàm getDetail

			$oldCart = isset($_SESSION['cart']) ? $_SESSION['cart'] : null;

			$cart = new Cart($oldCart);
			$cart->update($product, $qty);
			$_SESSION['cart'] = $cart;

			$arr = [
				'totalPrice' => number_format($cart->totalPrice)." VNĐ",
				'dongiaSanpham' => number_format($cart->items[$id]['price'])." VNĐ"
			];
			//print_r($_SESSION['cart']);
			echo json_encode($arr);
		}

		public function deleteCart(){
			$id = (int)$_POST['id'];

			$model = new FoodDetailModel();
			$product = $model->getDetail($id); //lấy id đó truyền vào hàm getDetail

			$oldCart = isset($_SESSION['cart']) ? $_SESSION['cart'] : null; 
			$cart = new Cart($oldCart);
			$cart->removeItem($id);
			$_SESSION['cart'] = $cart;

			echo number_format($cart->totalPrice);
			//print_r($_SESSION['cart']);
		}
	}

?>