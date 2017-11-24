<?php
	include_once('controller/MenuController.php');

	$index = new MenuController;
	$index->getFoodMenu();
?>