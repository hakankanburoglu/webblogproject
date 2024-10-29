<?php

session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = new mysqli("localhost", "root", "", "webblogdb");
    mysqli_set_charset($conn, "UTF8");
    $user = $_POST["username"];
    $pass = $_POST["password"];
    $sql = "SELECT * FROM user WHERE user_name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();
    $errcode = 0;
    if ($result->num_rows > 0) {
        $userdata = $result->fetch_assoc();
        if ($userdata['user_active'] == "1") {
            //if (password_verify($pass, $userdata['user_pass'])) {
            if ($userdata['user_pass'] == $pass) {
                $_SESSION['user_id'] = $userdata['user_id'];
                $_SESSION['user_name'] = $userdata['user_name'];
                $_SESSION['user_pass'] = $userdata['user_pass'];
                $errcode = -1;
                header("Location: home.php");
                exit();
            } else {
                $errcode = 3;
            }
        } else {
            $errcode = 2;
        }
    } else {
        $errcode = 1;
    }
    $stmt->close();
    $conn->close();
    if ($errcode != -1) {
        echo "<script type='text/javascript'>errorLogin($errcode)</script>";
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <title>WebBlog - Login</title>
        <link rel="icon" type="image/x-icon" href="src/img/favicon.png">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="src/css/font.css">
        <link rel="stylesheet" href="src/css/style.css">
        <link rel="stylesheet" href="src/css/login.css">
        <script src="src/js/script.js"></script>
    </head>
    <body>
        <div class="login-logo">
            <img src="src/img/logo1.png" width="170" alt="WebBlog">
        </div>
        <div class="login-container">
            <form method="POST" action="login.php">
                <div class="login-container-row">
                    <img class="login-icon" src="src/img/user-icon.png" width="30">
                    <input id="username" name="username" type="text" placeholder="User Name">
                </div>
                <div class="login-container-row">
                    <img class="login-icon" src="src/img/password-icon.png" width="30">
                    <input id="password" name="password" type="password" placeholder="Password">
                </div>
                <div class="login-button-container">
                    <button name="login-buton" type="submit">Login</button>
                </div>
                <div class="sign-up-text">Not a member? <a>Sign up</a> now.</div>
                <div class="login-error-container" id="login-error" onclick="errorLoginHide()"></div>
            </form>
        </div>
    </body>
</html>