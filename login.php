<?php
session_start();
if (isset($_SESSION["id"])) {
    header("Location: homepage.php");
}
?>
<?php
if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    require_once "database.php";
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if ($user) {
        if (password_verify($password, $user["password"])) {
            session_start();
            $_SESSION["id"] = $user["id"];
            header("Location: homepage.php");
            die();
        } else {
            echo "<script>alert('Incorrect Password!')</script>";
        }
    } else {
        echo "<script>alert('Email does not exist!')</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <!-- CSS -->
    <link rel="stylesheet" href="login.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans&family=Poppins:wght@500&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="sd">"SD</div>
            <div class="sneaker">Sneaker</div>
            <div class="shop">Shop"</div>
        </div>
        <div class="form">
            <form action="login.php" method="post">
                <div class="formgroup">
                    <label for="email">Email</label><br>
                    <input type="text" name="email" class="email" required>
                </div>

                <div class="formgroup">
                    <label for="password">Password</label><br>
                    <input type="password" name="password" class="password" required>
                </div>

                <span>No Account yet?<a href="registration.php"> Register Here</a></span>
                <div class="formgroup">
                    <input type="submit" value="Login" class="login" name="login">
                </div>
            </form>
        </div>
    </div>


    <script src="login.js"></script>
</body>

</html>