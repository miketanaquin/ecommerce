<?php
session_start();
if (isset($_SESSION["id"])) {
    header("Location: homepage.php");
}
require_once "database.php";
if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $passwordRepeat = $_POST["repeat_password"];
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $email = $_POST["email"];
    $address = $_POST["address"];
    $profilePic = 'default-pic.png';
    $errors = array();
    if ($password !== $passwordRepeat) {
        array_push($errors, "<script>alert('Password does not match')</script>");
    }
    $sqlEmail = "SELECT * FROM users WHERE email = '$email'";
    $resultEmail = mysqli_query($conn, $sqlEmail);
    $rowCountEmail = mysqli_num_rows($resultEmail);
    $sqlUsername = "SELECT * FROM users WHERE username = '$username'";
    $resultUsername = mysqli_query($conn, $sqlUsername);
    $rowCountUsername = mysqli_num_rows($resultUsername);
    if ($rowCountEmail > 0) {
        array_push($errors, "<script>alert('Email already exists!')</script>");
    }
    if ($rowCountUsername > 0) {
        array_push($errors, "<script>alert('Username has already been taken')</script>");
    }

    if (count($errors) > 0) {
        foreach ($errors as $errors) {
            echo "<div>$errors</div>";
        }
    } else {

        $sql = "INSERT INTO users (username, password, email, address, image_path) VALUES ( ?, ?, ?, ?,'$profilePic')";
        $stmt = mysqli_stmt_init($conn);
        $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
        if ($prepareStmt) {
            mysqli_stmt_bind_param($stmt, "ssss", $username, $passwordHash, $email, $address);
            mysqli_stmt_execute($stmt);
            echo "<script>alert('You are registered successful');
                    document.location.href = 'login.php'</script>";
        } else {
            die("Something went wrong");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registration</title>
        <!-- CSS -->
        <link rel="stylesheet" href="registration.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- google font -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans&family=Poppins:wght@500&display=swap" rel="stylesheet">
    </head>
</head>

<body>
    <div class="container">
        <div class="form">
            <form action="registration.php" method="post">

                <div class="formgroup">
                <label for="email">Email</label><br>
                    <input type="email" name="email" class="email" required>
                </div>

                <div class="formgroup">
                <label for="email">Password</label><br>
                    <input type="password" name="password" class="password" minlength="5" required>
                </div>

                <div class="formgroup">
                <label for="email">Re-enter Password</label><br>
                    <input type="password" name="repeat_password" class="password" minlength="5" required>
                </div>

                <div class="formgroup">
                <label for="email">Username</label><br>
                    <input type="text" name="username" class="username" minlength="5" required>
                </div>

                <div class="formgroup">
                <label for="email">Address</label><br>
                    <input type="text" name="address" class="address" required>
                </div>
                <span>Already have an account?<a href="login.php"> Login here</a></span>
                <div class="formgroup"><br>
                    <input type="submit" value="submit" class="submit" name="submit">
                </div>
            </form>
        </div>
    </div>
</body>

</html>