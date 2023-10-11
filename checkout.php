<?php
session_start();
if (!isset($_SESSION["id"])) {
    header("Location: login.php");
}
require 'database.php';
$user = $_SESSION["id"];
$orderZero = mysqli_query($conn, "SELECT * FROM cart WHERE buyer_id = $user");
$rowCount  = mysqli_num_rows($orderZero);
if ($rowCount == 0) {
    echo"<script>alert('There is no item(s) to checkout.'); document.location.href = 'cart.php';</script>";
}else {
    $rows = mysqli_query($conn, "SELECT * FROM collection INNER JOIN cart ON collection.id=cart.item_id WHERE buyer_id = $user ");
    while ($row = mysqli_fetch_assoc($rows)){
    if($row['quantity'] < $row['orders']){
            echo"<script>alert('Item stock is insufficient'); document.location.href = 'cart.php';</script>";
        }else{
                $rows = mysqli_query($conn, "SELECT * FROM collection INNER JOIN cart ON collection.id=cart.item_id WHERE buyer_id = $user ");
                while ($row = mysqli_fetch_assoc($rows)){
                $item_id = $row['item_id'];
                $qty = $row['quantity'];
                $order = $row['orders'];
                $update = $qty - $order;
                $sql = mysqli_query($conn, "UPDATE collection SET quantity = '$update' WHERE id = $item_id");
                if ($conn->query($sql) === FALSE){
                    mysqli_query($conn,"DELETE FROM `cart` WHERE buyer_id='$user'");
                    $checks = mysqli_query($conn, "SELECT * FROM collection WHERE id = '$item_id'");
                    while ($check = mysqli_fetch_assoc($checks)){
                        $item_id = $check['id'];
                        if ($check['quantity'] == 0) {
                            mysqli_query($conn,"DELETE FROM `collection` WHERE id='$item_id'");
                            echo"<script>alert('Order has been successfully placed! Thank you for Shopping!');
                            document.location.href = 'cart.php';</script>";
                        }
        
                    }
                    echo"<script>alert('Order has been successfully placed! Thank you for Shopping!');
                    document.location.href = 'cart.php';</script>";
                }
                else{
                    echo"<script>alert('Error!');document.location.href = 'cart.php';</script>";
                }
            
            }
        }
    }
}
?>
