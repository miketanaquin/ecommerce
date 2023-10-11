<?php
session_start();
if (!isset($_SESSION["id"])) {
    header("Location: login.php");
}
require 'database.php';
?>

<?php
if (isset($_POST['addtocart'])) {
    $id = $_GET['id'];
    $user = $_SESSION['id'];
    $quantity = $_POST['numorder'];
    $sqlItem = mysqli_query($conn, "SELECT * FROM cart WHERE item_id = '$id' AND buyer_id = '$user'");
    $rowCountitem = mysqli_num_rows($sqlItem);
    if ($rowCountitem > 0) {
        echo "<script>alert('This Item is already in the Cart.')</script>";
    } else if ($quantity == 0 || $quantity == null) {
        echo "<script>alert('No quantity declared.')</script>";
    } else {
        $sql = "INSERT INTO cart (item_id, buyer_id, orders) VALUES ('$id','$user','$quantity')";
        mysqli_query($conn, $sql);
        echo "<script>alert('Successfully added to Cart!'); document.location.href = 'collection.php';</script>";
    }
}
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
    #collection {
        border-bottom: solid 3px orange;
    }
</style>

<body>
    <header>
        <!-- NAVBAR -->
        <div class="nav container">
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
                    <li id="contact" onclick="contact()"><a href="#">Contact</a></li>
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
            $user = $_SESSION['id'];
            $rows = mysqli_query($conn, "SELECT * FROM users WHERE id = $user");
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

        <!-- END OF NAVBAR -->

        <!-- CONTENT -->
        <section class="index-shop container">
            <div class="index-shop-content">
                <?php
                $id = $_GET['id'];
                $rows = mysqli_query($conn, "SELECT * FROM collection WHERE id = $id ");
                foreach ($rows as $row) : $explodeFiles = explode(" ", $row['image_path']);
                ?>
                    <div class="index-bodyimage">
                        <img id="index-imgproduct1" class="index-imgproduct1" src="imagescollected/<?php echo $explodeFiles[0]; ?>" style="object-fit:cover;">
                    </div>
                <?php endforeach ?>

                <div class="index-bodytext">

                    <?php
                    $user = $_SESSION["id"];
                    $rows = mysqli_query($conn, "SELECT * FROM collection WHERE user_id = $user");
                    ?>

                    <p class="index-toptext" style="color:Orange; font-weight:700; font-size:medium;">SD SNEAKER SHOP</p>

                    <h1 class="index-product-name" id="index-product-name" style="font-weight:bold;"><?php echo $row['name'] ?></h1>

                    <p class="index-product-description" style=" color:gray"><?php echo $row['description'] ?></p>

                    <p class="index-price" style="font-weight: 700; font-size: 25px;">$<?php echo $row['price'] ?></p>
                    <p class="index-product-gender"><?php echo $row['gender'] ?>'s Section</p>
                    <!-- <p class="index-discount" style="color:darkorange; font-weight:bolder; font-size:medium;">50%</p> -->

                    <!-- <p class="index-origprice" style="color:grey;">$250.00</p> -->
                    <p class="index-product-stocks">Stocks: <?php echo $row['quantity'] ?></p>
                    <form method="post" action="index.php?id=<?= $row['id'] ?>">
                        <div class="index-checkout">
                            <div class="index-minus" id="index-minus" onclick="dec()" return false value="1"><img src="images/icon-minus.png"></div>
                            <input class="index-numorder" id="index-numorder" name="numorder" style=" text-align:center; font-weight:700" type="number" max="<?php echo $row['quantity'] ?>" onchange="setVal(this.value)" value="1">
                            <div class="index-plus" id="index-plus" onclick="inc()" return false value="1"><img src="images/icon-plus.png"></div>
                            <input type="submit" class="index-addtocart" id="index-addtocart" name="addtocart" value="Add to Cart" style="font-size: large; color:white; justify-content: center;">
                        </div>
                    </form>
                </div>


                <div class="index-thumbnails">
                    <?php
                    $id = $_GET['id'];
                    $rows = mysqli_query($conn, "SELECT * FROM collection WHERE id = $id ");
                    foreach ($rows as $row) : $explodeFiles = explode(" ", $row['image_path']);
                        $count = count($explodeFiles);

                        for ($i = 0; $count > $i; $i++) {
                            echo "<img class='thumbnail$i' id='thumbnail$i' src='imagescollected/" . $explodeFiles[$i] . "' onclick='thumbnail$i()' style='object-fit: contain;' width='75px' height='75px'/>";
                        }
                    ?>
                    <?php endforeach ?>
                </div>

            </div>

            </div>
        </section>
        <!-- END OF CONTENT -->

        <!-- MODAL -->
        <div id="myModal" class="modal">
            <?php
            $id = $_GET['id'];
            $rows = mysqli_query($conn, "SELECT * FROM collection WHERE id = $id ");
            foreach ($rows as $row) : $explodeFiles = explode(" ", $row['image_path']);
                $count = count($explodeFiles);
                $arr = json_encode($explodeFiles);
                echo "<div class='modal-content'>
                <div class='modalproducts'>
                    <div href='#' class='previous' onclick='prev($arr);'>&#8249;</div>
                    <div class='close'>&times;</div>
                    <div href='#' class='next' onclick='next($arr);'>&#8250;</div>
                    <img id='modalimgproduct0' class='modalimgproduct0' src='imagescollected/" . $explodeFiles[0] . "' style='object-fit: contain;'/>
                </div>";



                for ($i = 0; $count > $i; $i++) {
                    echo "
                    <img class='modalthumbnail$i' id='modalthumbnail$i' src='imagescollected/" . $explodeFiles[$i] . "' onclick='modalthumbnail$i()' style='object-fit: contain;'/>";
                }
            endforeach
            ?>

        </div>

        <!-- END OF MODAL -->


    </header>

    <script src="index.js"></script>
</body>

</html>