<?php
	require_once("includes/DBController.php");
	$conn = new DBController();
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		require_once("includes/DBController.php");
		$conn = new DBController();
		$flag = $conn->sil($_POST["imagelink"]);
		echo $flag;
	}
?>
