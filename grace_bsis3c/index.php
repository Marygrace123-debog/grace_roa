<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// If already logged in, go to home
if (isset($_SESSION["EmployeeID"])) {
    header("Location: home.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Employee Login</title>

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect"
          href="https://fonts.gstatic.com"
          crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">

    <!-- Glowing dots -->
    <span></span>
    <span></span>
    <span></span>

    <div class="login-box">

        <form action="check.php" method="POST">

            <h2>Employee Login</h2>

            <p class="subtitle">
                Sign in to access your employee account
            </p>

            <!-- Username -->
            <div class="input-box">

                <input
                    type="text"
                    name="username"
                    autocomplete="username"
                    required
                >

                <label>Username</label>

            </div>

            <!-- Password -->
            <div class="input-box">

                <input
                    type="password"
                    name="password"
                    autocomplete="current-password"
                    required
                >

                <label>Password</label>

            </div>

            <!-- Forgot password -->
            <div class="forgot-pass">

                <a href="#">
                    Forgot Password?
                </a>

            </div>

            <!-- Login -->
            <button
                type="submit"
                class="btn"
            >
                Login
            </button>

        </form>

    </div>

</div>

</body>

</html>