<?php
session_start();
if (!isset($_SESSION["id"])) {
    header("Location: login.php");
}
require 'database.php';
$id = $_GET["id"];
mysqli_query($conn, "DELETE FROM collection WHERE user_id = $id");
mysqli_query($conn, "DELETE FROM users WHERE id = $id");
echo "<script>alert('User has been deleted'); 
document.location.href = 'login.php';</script>";
session_destroy();
?>