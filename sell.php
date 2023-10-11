<?php
session_start();
if (!isset($_SESSION["id"])) {
    header("Location: login.php");
}
?>
<?php
require 'database.php';
if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];
    $gender = $_POST["gender"];
    $user = $_SESSION["id"];
    $fileName = $_FILES["image_path"]["name"];
    $fileSize = $_FILES["image_path"]["size"];
    $tmpName = $_FILES["image_path"]["tmp_name"];

    if (count($fileName) > 4) {
        echo "<script>alert('Pictures that can be uploaded is limited to 4')</script>";
    } else if (count($fileName) == 3) {
        $imageExtention1 = explode('.', $fileName[0]);
        $imageExtention2 = explode('.', $fileName[1]);
        $imageExtention3 = explode('.', $fileName[2]);

        $imageExtention1 = strtolower(end($imageExtention1));
        $imageExtention2 = strtolower(end($imageExtention2));
        $imageExtention3 = strtolower(end($imageExtention3));

        $newImageName1 = uniqid() . '.' . $imageExtention1;
        $newImageName2 = uniqid() . '.' . $imageExtention2;
        $newImageName3 = uniqid() . '.' . $imageExtention3;

        $files = [$newImageName1, $newImageName2, $newImageName3];
        $implodeFiles = implode(" ", $files);
        $query = "INSERT INTO collection (name, description, price, quantity, gender, image_path, user_id) VALUES ('$name','$description', '$price', '$quantity', '$gender', '$implodeFiles', '$user')";
        mysqli_query($conn, $query);
        $explodeFiles = explode(" ", $implodeFiles);
        move_uploaded_file($tmpName[0], 'imagescollected/' . $explodeFiles[0]);
        move_uploaded_file($tmpName[1], 'imagescollected/' . $explodeFiles[1]);
        move_uploaded_file($tmpName[2], 'imagescollected/' . $explodeFiles[2]);
        echo "<script>alert('Item has been successfully added!');
        document.location.href = 'collection.php';</script>";
    } else if (count($fileName) == 2) {
        $imageExtention1 = explode('.', $fileName[0]);
        $imageExtention2 = explode('.', $fileName[1]);

        $imageExtention1 = strtolower(end($imageExtention1));
        $imageExtention2 = strtolower(end($imageExtention2));

        $newImageName1 = uniqid() . '.' . $imageExtention1;
        $newImageName2 = uniqid() . '.' . $imageExtention2;

        $files = [$newImageName1, $newImageName2];
        $implodeFiles = implode(" ", $files);
        $query = "INSERT INTO collection (name, description, price, quantity, gender, image_path, user_id) VALUES ('$name','$description', '$price', '$quantity', '$gender', '$implodeFiles', '$user')";
        mysqli_query($conn, $query);
        $explodeFiles = explode(" ", $implodeFiles);
        move_uploaded_file($tmpName[0], 'imagescollected/' . $explodeFiles[0]);
        move_uploaded_file($tmpName[1], 'imagescollected/' . $explodeFiles[1]);
        echo "<script>alert('Item has been successfully added!');
        document.location.href = 'collection.php';</script>";
    } else if (count($fileName) == 1) {
        $imageExtention1 = explode('.', $fileName[0]);

        $imageExtention1 = strtolower(end($imageExtention1));

        $newImageName1 = uniqid() . '.' . $imageExtention1;

        $files = [$newImageName1, $newImageName2];
        $implodeFiles = implode(" ", $files);
        $query = "INSERT INTO collection (name, description, price, quantity, gender, image_path, user_id) VALUES ('$name','$description', '$price', '$quantity', '$gender', '$implodeFiles', '$user')";
        mysqli_query($conn, $query);
        $explodeFiles = explode(" ", $implodeFiles);
        move_uploaded_file($tmpName[0], 'imagescollected/' . $explodeFiles[0]);
        echo "<script>alert('Item has been successfully added!');
        document.location.href = 'collection.php';</script>";
    } else {
        $imageExtention1 = explode('.', $fileName[0]);
        $imageExtention2 = explode('.', $fileName[1]);
        $imageExtention3 = explode('.', $fileName[2]);
        $imageExtention4 = explode('.', $fileName[3]);

        $imageExtention1 = strtolower(end($imageExtention1));
        $imageExtention2 = strtolower(end($imageExtention2));
        $imageExtention3 = strtolower(end($imageExtention3));
        $imageExtention4 = strtolower(end($imageExtention4));

        $newImageName1 = uniqid() . '.' . $imageExtention1;
        $newImageName2 = uniqid() . '.' . $imageExtention2;
        $newImageName3 = uniqid() . '.' . $imageExtention3;
        $newImageName4 = uniqid() . '.' . $imageExtention4;

        $files = [$newImageName1, $newImageName2, $newImageName3, $newImageName4];
        $implodeFiles = implode(" ", $files);
        $query = "INSERT INTO collection (name, description, price, quantity, gender, image_path, user_id) VALUES ('$name','$description', '$price', '$quantity', '$gender', '$implodeFiles', '$user')";
        mysqli_query($conn, $query);
        $explodeFiles = explode(" ", $implodeFiles);
        move_uploaded_file($tmpName[0], 'imagescollected/' . $explodeFiles[0]);
        move_uploaded_file($tmpName[1], 'imagescollected/' . $explodeFiles[1]);
        move_uploaded_file($tmpName[2], 'imagescollected/' . $explodeFiles[2]);
        move_uploaded_file($tmpName[3], 'imagescollected/' . $explodeFiles[3]);
        echo "<script>alert('Item has been successfully added!');
        document.location.href = 'collection.php';</script>";
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
        max-width: 1200px;
    }

    .body-title {
        margin: 20px;
    }

    form {
        margin: auto;
        max-width: 600px;
        color: gray;
        font-size: 20px;
    }

    .form-content1,
    .form-content2,
    .form-content3,
    .form-content4,
    .form-content5 {
        margin: 20px;
    }

    .sell-submit {
        padding: 15px 25px;
        float: right;
        background-color: orange;
        color: white;
        border: none;
        border-radius: 10px;
        box-shadow: 1px 1px 1px #000000;
        margin: 20px;
    }

    .sell-submit:hover {
        cursor: pointer;
        transform: translateY(-5px);
        transition: .3s;
    }

    .form-titles {
        font-size: 20px;
        color: gray;
    }

    .name,
    .description {
        width: 100%;
        margin: 10px 0;
        font-size: 15px;
        padding: 10px;
    }

    .form-content3 {
        display: grid;
        grid-template-columns: 50% 50%;
    }

    .quantity,
    .price {
        width: 80%;
        height: 40px;
        padding: 10px;
        font-size: 15px;
        margin: 10px 0;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    #gender {
        width: 80%;
        height: 40px;
        font-size: 17px;
        margin: 10px 0;
    }

    @media screen and (max-width: 350px) {
        .form-titles {
            font-size: 18px;
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
                <li><a href="#">Contact</a></li>
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
    <!-- END OF NAVBAR -->
    <!-- HEAD CONTAINER -->
    <div class="container">
        <h2 class="body-title" style="color: gray; font-weight:100">Sell Items</h2>
        <form action="sell.php" method="post" enctype="multipart/form-data">
            <div class="form-content1">
                <span class="form-titles">Sneaker name</span><br>
                <textarea rows="1" type="text" class="name" name="name" maxlength="255" required></textarea>
            </div>
            <div class="form-content2">
                <span class="form-titles">Description</span><br>
                <textarea rows="3" class="description" name="description" maxlength="255" required></textarea>
            </div>
            <div class="form-content3">
                <div class="gendersec">
                    <span class="form-titles">Price</span><br>
                    <input type="number" class="price" name="price" placeholder="USD" required>
                </div>
                <div class="stocksec">
                    <span class="form-titles">Quantity</span><br>
                    <input type="number" class="quantity" name="quantity" required>
                </div>
            </div>
            <div class="form-content4">
                <span class="form-titles">Section of the shoe</span><br>
                <select id="gender" name="gender">
                    <option id="gender" value="Unisex" style="font-size: 17px;">Unisex</option>
                    <option id="gender" value="Men" style="font-size: 17px;">Men</option>
                    <option id="gender" value="Women" style="font-size: 17px;">Women</option>
                </select>
            </div>
            <div class="form-content5">
                <span class="form-titles" for="image_path">Upload images (max: 4 pictures)</span><br>
                <input type="file" class="image_path" name="image_path[]" accept=".jpg, .jpeg, .png" multiple required>
            </div>
            <button class="sell-submit" value="submit" name="submit">Submit</button>
        </form>
    </div>
    <!-- END OF HEAD CONTAINER  -->
    <!-- BODY CONTAINER -->



    <!-- END OF BODY CONTAINER -->
    <script src="main.js"></script>
</body>

</html>