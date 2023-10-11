<?php
session_start();
if (!isset($_SESSION["id"])) {
    header("Location: login.php");
}
require 'database.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce</title>
    <!-- CSS -->
    <link rel="stylesheet" href="main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans&family=Poppins:wght@500&display=swap" rel="stylesheet">
</head>
<style>
    #cart {
        border-bottom: solid 3px orange;
    }
</style>

<body>
    <!-- NAVBAR -->
    <div class="nav cart-container">
        <button class="sidebar-open" onclick="opensidebar()">☰</button>
        <div class="logo" onclick="logo()">
            <img id="logo" src="images/logo.png" width="auto" height="30px" alt="logo" />
        </div>
        <div id="mySidebar" class="sidebar">
            <a href="javascript:void(0)" class="sidebar-close" onclick="closesidebar()">×</a>
            <a href="homepage.php">Home</a>
            <a href="collection.php">Collection</a>
            <a href="men.php">Men</a>
            <a href="women.php">Women</a>
            <a href="#">Contact</a>
        </div>

        <div class="list-item">
            <ul>
                <li id="collection" onclick="collection()"><a href="#">Collection</a></li>
                <li id="men" onclick="men()"><a href="#">Men</a></li>
                <li id="women" onclick="women()"><a href="#">Women</a></li>
                <li id="contact"><a href="#">Contact</a></li>
            </ul>
        </div>

        <div class="cart" id="cart">
            <a href="cart.php"><img src="images/icon-cart.png" width="auto" height="25px"></a>
            <?php
            $user = $_SESSION["id"];
            $rows = mysqli_query($conn, "SELECT * FROM cart WHERE buyer_id = $user ");
            $rowCount = mysqli_num_rows($rows);
            ?>
            <div class="cartamount" id="cartamount"><?php echo $rowCount; ?></div>
        </div>

        <?php
        $user = $_SESSION["id"];
        $rows = mysqli_query($conn, "SELECT * FROM users WHERE id = $user ");
        foreach ($rows as $row) :
        ?>
            <div class="avatar">
                <img id="icon" class="icon" src="imagescollected/<?php echo $row['image_path']; ?>" onclick="avatar()" width="50px" height="50px">
                <div id="myDropdownAvatar" class="dropdown-avatar">
                    <img id="icon" class="dropdown-icon" src="imagescollected/<?php echo $row['image_path']; ?>" width="50px" height="50px"><br>
                    <a href="collection.php" style="text-align: center; padding-top:35px;  background-color:white; color:orange"><br>@<?php echo $row['username']; ?></a>
                    <a href="editProf.php?id=<?php echo $row['id']; ?>">Change Profile Picture</a>
                    <a href="deleteUser.php?id=<?php echo $row['id']; ?>">Delete Account</a>
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        <?php endforeach ?>

    </div>

    <div class="cart-container">
        <h2 class="cart-title">Your Cart</h2>
        <div class="cart-body-content">
            <?php
            $user = $_SESSION["id"];
            $rows = mysqli_query($conn, "SELECT * FROM collection INNER JOIN cart ON collection.id=cart.item_id WHERE buyer_id = $user ");
            $total = 0;
            foreach ($rows as $row) : $explodeFiles = explode(" ", $row['image_path']);
            ?>
                <div class="cart-product-section">
                    <img src="imagescollected/<?php if (count($explodeFiles) > 1) {
                                                    echo $explodeFiles[0];
                                                } else {
                                                    echo $row['image_path'];
                                                } ?>" width="120px" height="120px" style="border-radius: 20px; object-fit:contain;">
                    <div class="collection-details">
                        <div class="cart-product-title"><?php echo $row['name'] ?></div>
                        <div class="cart-price">Price: $<?php echo $row['price'] ?></div>
                        <div class="cart-quantity">Order: <?php echo $row['orders'] ?></div>
                        <div class="cart-subtotal">Subtotal: $<?php echo $subtotal = $row['price'] * $row['orders'] ?></div>
                        <div class="cart-remove"><a href="removeitemcart.php?id=<?php echo $row['id']; ?>">Remove</a></div>
                    </div>
                </div>
                <?php 
                $total += $subtotal;
                endforeach ?>
        </div>
        <div class="cart-total" style="font-weight:700">Total: $<?php echo $total ?> </div>

        <div class="cart-checkout"><a href="checkout.php">Checkout</a></div>
    </div>
    <script src="main.js"></script>

</body>

</html