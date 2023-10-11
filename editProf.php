<?php
session_start();
if (!isset($_SESSION["id"])) {
    header("Location: login.php");
}
?>
<?php
require 'database.php';
if (isset($_POST["submit"])) {
    $id = $_GET["id"];
    $fileName = $_FILES["image_path"]["name"];
    $fileSize = $_FILES["image_path"]["size"];
    $tmpName = $_FILES["image_path"]["tmp_name"];
    $validImageExtension = ['jpg', 'jpeg', 'png'];
    $imageExtention = explode('.', $fileName);
    $imageExtention = strtolower(end($imageExtention));
    if (!in_array($imageExtention, $validImageExtension)) {
        echo "<script>alert('Invalid image exntension')";
    } else if ($fileSize > 1000000) {
        echo "<script>alert('Image size is too large')";
    } else {
        $newImageName = uniqid();
        $newImageName .= '.' . $imageExtention;

        move_uploaded_file($tmpName, 'imagescollected/' . $newImageName);

        $sql = "UPDATE users " . "SET image_path = '$newImageName'" . "WHERE id = '$id'";
        mysqli_query($conn, $sql);
        echo "<script>alert('Your profile picture has been successfully updated!');
        document.location.href = 'homepage.php';</script>";
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
    .container {
        position: relative;
    }

    .form {
        position: block;
        height: 150px;
        width: 320px;
        background-color: orange;
        padding: 20px;
        border-radius: 20px;
        margin: 10% auto;
        box-shadow: 1px 4px 8px #000000;

    }

    input {
        padding: 5px;
        background-color: rgb(223, 221, 221);
        border: solid 2px black;
        margin: 10px 0;
        border-radius: 10px;
    }

    .profpic-submit:hover {
        cursor: pointer;
        background-color: orange;
        color: white;
    }

    @media screen and (max-width: 400px) {
        .form {
            width: 250px;
        }

        .image_path {
            width: 200px;
        }
    }

    /* END OF NAVBAR  */
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
                <li><a href="#">Contact</a></li>
            </ul>
        </div>

        <div class="cart" id="cart">
            <a href="cart.php"><img src="images/icon-cart.png" width="auto" height="25px"></a>
            <div class="cartamount" id="cartamount">0</div>
        </div>

        <?php
        $user = $_SESSION["id"];
        $rows = mysqli_query($conn, "SELECT * FROM users WHERE id = $user ");
        foreach ($rows as $row) :
        ?>
            <div class="avatar">
                <img id="icon" class="icon" src="imagescollected/<?php echo $row['image_path']; ?>" onclick="avatar()" width="50px" height="50px" alt="avatar">
                <div id="myDropdownAvatar" class="dropdown-avatar">
                    <a href="editProf.php?id=<?php echo $row['id']; ?>">Change Profile Picture</a>
                    <a href="deleteUser.php?id=<?php echo $row['id']; ?>">Delete Account</a>
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        <?php endforeach ?>

    </div>

    <!-- END OF NAVBAR -->

    <body>
        <div class="container">
            <div class="form">
                <form method="post" enctype="multipart/form-data">
                    <input type="hidden" value="<?php echo $id; ?>">
                    <input type="file" class="image_path" name="image_path" accept=".jpg, .jpeg, .png" required>
                    <input type="submit" class="profpic-submit" value="submit" name="submit">
                </form>
            </div>
        </div>
    </body>
    <script src="main.js"></script>

</html>