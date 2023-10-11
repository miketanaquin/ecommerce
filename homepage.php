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
    .mySlides {
        display: none;
        border: solid 3px orange;
    }

    .mySlides:hover {
        cursor: pointer;
    }

    img {
        vertical-align: middle;
    }

    .homepage-body-title {
        text-align: center;
        margin: 10px;
        padding: 10px;
        color: gray;
    }

    .slideshow-container {
        max-width: 1200px;
        position: relative;
        margin: auto;
    }

    .text {
        color: orange;
        font-size: 20px;
        font-weight: 700;
        padding: 8px 12px;
        position: absolute;
        bottom: 8px;
        width: 100%;
        text-align: center;
    }

    .dot {
        height: 15px;
        width: 15px;
        margin: 0 2px;
        background-color: #bbb;
        border-radius: 50%;
        display: inline-block;
        transition: background-color 0.6s ease;
    }

    .dot.active {
        background-color: #717171;
    }

    .fade {
        animation-name: fade;
        animation-duration: 1.5s;
    }

    @keyframes fade {
        from {
            opacity: .4
        }

        to {
            opacity: 1
        }
    }

    @media screen and (max-width: 435px) {
        .text {
            font-size: 15px;
        }

        .dot {
            height: 10px;
            width: 10px;
        }
    }
</style>

<body>
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
    <h2 class="homepage-body-title">SD Sneaker Shop</h2>

    <div class="slideshow-container">

        <div class="mySlides fade">
            <img onclick="collection()" src="images/slideshow1.jpg" style="width:100%">
            <div class="text">View Collection</div>
        </div>

        <div class="mySlides fade">
            <img onclick="men()" src="images/slideshow2.jpg" style="width:100%">
            <div class="text">View Men's sneakers</div>
        </div>

        <div class="mySlides fade">
            <img onclick="women()" src="images/slideshow3.jpg" style="width:100%">
            <div class="text">View Women's sneakers</div>
        </div>

    </div>
    <br>
    <div style="text-align:center">
        <span class="dot"></span>
        <span class="dot"></span>
        <span class="dot"></span>
    </div>

    <script src="main.js"></script>
    <script>
        //  HOMEPAGE SLIDESHOW //
        let slideIndex = 0;
        showSlides();

        function showSlides() {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            let dots = document.getElementsByClassName("dot");
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slideIndex++;
            if (slideIndex > slides.length) {
                slideIndex = 1
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";
            setTimeout(showSlides, 2000); // Change image every 2 seconds
        }
        var dropdownProfile = document.getElementsByClassName("dropdown-profile");
        var i;
        for (i = 0; i < dropdownProfile.length; i++) {
            dropdownProfile[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var dropdownContentProfile = this.nextElementSibling;
                if (dropdownContentProfile.style.display === "block") {
                    dropdownContentProfile.style.display = "none";
                } else {
                    dropdownContentProfile.style.display = "block";
                }
            });
        }
        // END OF HOMEPAGE //
    </script>




</body>

</html>