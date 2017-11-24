<?php
	include_once('controller/SeasonFoodController.php');

	$index = new SeasonFoodController;
	$index->getSeasonFood();
?>