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
    #women {
        border-bottom: solid 3px orange;
    }
</style>

<body>
    <!-- NAVBAR -->
    <div class="nav women-container">
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
        foreach ($rows as $row) : ?>
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

    <!-- END OF NAVBAR -->

    <div class="women-container">

        <div class="women-body-header">
            <h2 class="women-body-title" style="color: gray; font-weight:100">Items in Women's Collection</h2>
            <div class="women-dropdown">
                <button onclick="dropdown()" class="women-dropbtn">Category</button>
                <div id="myDropdown" class="women-dropdown-content">
                    <a href="men.php">Men</a>
                    <a href="women.php">Women</a>
                </div>
            </div>
        </div>
    </div>
    <div class="women-container">
        <div class="women-body-content">
            <?php
            $user = $_SESSION["id"];
            $rows = mysqli_query($conn, "SELECT * FROM collection WHERE user_id = $user AND NOT gender = 'Men' ORDER BY id DESC");
            foreach ($rows as $row) : $explodeFiles = explode(" ", $row['image_path']); ?>
                <div class="women-product-section">
                    <img src="imagescollected/<?php if (count($explodeFiles) > 1) {
                                                    echo $explodeFiles[0];
                                                } else {
                                                    echo $row['image_path'];
                                                } ?>" width="120px" height="120px" style="border-radius: 20px; object-fit:contain;">
                    <div class="collection-details">
                        <div class="women-product-title"><?php echo $row['name'] ?></div>
                        <div class="women-desc"><?php echo $row['description'] ?></div>
                        <div class="women-quantity">Stocks: <?php echo $row['quantity'] ?></div>
                        <div class="women-function">
                            <div class="women-edit"><a href="editItem.php?id=<?php echo $row['id']; ?>">Edit</a></div>
                            <div class="women-remove"><a href="deleteItem.php?id=<?php echo $row['id']; ?>">Remove</a></div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
            <?php
            $user = $_SESSION["id"];
            $rows = mysqli_query($conn, "SELECT * FROM collection WHERE NOT user_id = $user AND NOT gender = 'Men' ORDER BY id DESC");
            foreach ($rows as $row) : $explodeFiles = explode(" ", $row['image_path']); ?>
                <div class="women-product-section">
                    <a href="index.php?id=<?php echo $row['id']; ?>"><img src="imagescollected/<?php if (count($explodeFiles) > 1) {
                                                                                                    echo $explodeFiles[0];
                                                                                                } else {
                                                                                                    echo $row['image_path'];
                                                                                                } ?>" width="120px" height="120px" style="border-radius: 20px; object-fit:contain;"></a>
                    <div class="collection-details">
                        <div class="women-product-title"><a href="index.php?id=<?php echo $row['id']; ?>"><?php echo $row['name'] ?></a></div>
                        <div class="women-desc"><?php echo $row['description'] ?></div>
                        <div class="women-quantity">Stocks: <?php echo $row['quantity'] ?></div>
                        <div class="women-view"><a href="index.php?id=<?php echo $row['id']; ?>">View</a></div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>

    <script src="main.js"></script>
    <script>
        function dropdown() {
            document.getElementById("myDropdown").classList.toggle("women-show");
        }
        window.onclick = function(event) {
            if (!event.target.matches('.collection-dropbtn')) {
                var dropdowns = document.getElementsByClassName("collection-dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('women-show')) {
                        openDropdown.classList.remove('women-show');
                    }
                }
            }
        }
    </script>
    </head>

    <body>

    </body>

</html>