<?php
	include_once('controller/CheckoutController.php');

	$index = new CheckoutController;
	$index->Checkout();

	//isset($_POST['btnCheckout']) ? $index->postCheckout() : $index->getCheckout(); chia làm 2 function(cách 1)
?>