<?php
$hostName = "localhost:3306";
$dbUser = "root";
$dbPassword = "";
$dbName = "ecommerce";
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
if (!$conn) {
    die("Something went wrong;");
}
?>
