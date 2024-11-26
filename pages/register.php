<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Likhang Kultura</title>
    <link href="https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,100..900;1,100..900&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Knewave&family=Rubik+Glitch&family=Shrikhand&family=Sriracha&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <header>
        <div class="navbar">
            <div class="nav-center">
                <div class="logo">
                    <img src="../images/logo.svg" alt="Likhang Kultura">
                </div>
                <nav class="navlinks">
                    <ul>
                        <li><a href="../index.php">Home</a></li>
                        <li><a href="catalog.php">Catalog</a></li>
                        <li><a href="about.php">About</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <main>
        <div class="form_container">
            <div class="intro_register">
                <h1>Sign up now</h1>
            </div>

            <?php
                include '../validate/alert-register.php';
            ?>

            <form action="../validate/register-validate.php" method="POST">
                <div class="form_data">
                    <input type="text" name="fullname" placeholder="Full Name">
                    <input type="email" name="email" placeholder="Email">
                    <input type="text" name="username" placeholder="Username">
                    <input type="password" name="password" placeholder="Password">
                    <input type="password" name="confirm_password" placeholder="Confirm Password">
                    <input type="submit" value="Sign Up" name="submit">
                </div>
            </form>
            <div class="message">
                <p>
                    Already have an account? <a href="login.php">Login Here</a>
                </p>
            </div>
        </div>
    </main>
    <footer>
        Copyright &copy; 2024 Likhang Kultura All Rights Reserved.
    </footer>
</body>
</html>