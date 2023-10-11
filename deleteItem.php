<?php
	$id=$_GET['id'];
	include('database.php');
	mysqli_query($conn,"DELETE FROM `collection` WHERE id='$id'");
	header("Location: collection.php");
?>