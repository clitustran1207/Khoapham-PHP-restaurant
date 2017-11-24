<?php
	include_once('Controller.php');
	include_once('Cart.php');
	include_once('model/CheckoutModel.php');
	include_once('include/functions.php');
	include_once('include/mailer.php');
	session_start();

	class CheckoutController extends Controller {

		/*public function getCheckout(){
			$oldcart = isset($_SESSION['cart']) ? $_SESSION['cart'] : null;
			$cart = new Cart($oldcart);
			//session_destroy();
			//print_r($cart->items);
			return $this->loadView('cart', $cart);
		}

		public function postCheckout(){
			echo $name = $_POST['fullname'];
		}*/
	
		public function checkout(){
			$oldcart = isset($_SESSION['cart']) ? $_SESSION['cart'] : null;
			$cart = new Cart($oldcart);

			if(!isset($_POST['btnCheckout'])){
				return $this->loadView('cart', $cart);
			} 
			else{
				$name = $_POST['fullname'];
				$email = $_POST['email'];
				$address = $_POST['address'];
				$phone = $_POST['phone'];

				$model = new CheckoutModel;
				$idCustomer = $model->insertCustomer($name,$email,$address,$phone);

				//print_r($result);

				if ($idCustomer) {
					//sẽ lưu bill
					$dateOrder = date('Y-m-d',time());
					$total = $cart->totalPrice;
					$note = $_POST['message'];
					$token = createToken();
					$tokenDate = date('Y-m-d h:i:s',time());

					$tokenTime = strtotime($tokenDate);

					$idBill = $model->insertBill($idCustomer,$dateOrder,$total,$note,$token,$tokenDate);

					if ($idBill>0) {
						//echo $idBill;
						$temp = 1;
						foreach ($cart->items as $idFood => $food) {
							$result = $model->insertBillDetail($idBill,$idFood,$food['qty'],$food['price']);
							if ($result) {
								$temp += 1; 
							}
						}
						if ($temp==1) { //có lỗi k add vào bill detail
							$model->delRecentInsertBillDetail($idBill);
							$model->delRecentInsertBill($idBill);
							$model->delRecentInsertCus($idCustomer);
						}
						else{
							//gửi mail
							$link = "http://localhost:88/Khoapham/restaurant/confirm_order.php?token=$token&t=$tokenTime";
							$subject = "Xác nhận đơn hàng mả số DH-$idBill";
							$content = "Chào bạn $name, Vui lòng nhấp vào link bên dưới để xác nhận đơn hàng của bạn: $link";

							mailer($email,$name,$subject,$content);


							//xóa session cart
							unset($_SESSION['cart']);
							unset($cart);

							setcookie('success', "Đặt hàng thành công, vui lòng kiểm tra hộp thư để xác nhận đơn hàng",time()+5);
							header("Location:checkout.php");
							return;
						}
					}
					else{
						//xóa customer
						$model->delRecentInsertCus($idCustomer);
					}
				}
				setcookie('error', 'Có lỗi xảy ra, vui lòng kiểm tra lại', time()+5);
				//return $this->loadView('cart', $cart); load view chỉ hiển thị nội dung ở giữa
				header("Location:checkout.php"); //load cả trang
			}
		}

	}


?>