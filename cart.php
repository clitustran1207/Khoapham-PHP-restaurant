<?php
	//echo $_POST['id']."-".$_POST['qty']."----"."ajax thành công";
	
	//file này dủng để xử lý cho ajax

	include_once('controller/CartController.php');

	$c = new CartController;

	$action = isset($_POST['action']) ? $_POST['action'] : "add";
	if ($action=="add") {
		$c->addToCart();
	} elseif ($action=="update"){
		$c->updateCart();
	} else{
		//delete
		$c->deleteCart();
	}
	
?>