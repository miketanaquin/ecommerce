<?php
	$id=$_GET['id'];
	include('database.php');
	mysqli_query($conn,"DELETE FROM `cart` WHERE id='$id'");
	header("Location: cart.php");
?>