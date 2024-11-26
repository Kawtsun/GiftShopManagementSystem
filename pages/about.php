<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - Likhang Kultura</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,100..900;1,100..900&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Knewave&family=Rubik+Glitch&family=Shrikhand&family=Sriracha&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
    <script src="script.js"></script>
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
                        <li><a href="about.php" class="active">About</a></li>
                    </ul>
                </nav>
            </div>
            <div class="profile_cart">
                <a href="profile.php">
                    <img src="../images/user.svg" alt="Profile" width="25px" class="profile">
                </a>
                <a href="cart.php">
                    <img src="../images/shopping-cart.svg" alt="Cart" width="25px" class="cart">
                </a>
            </div>
            <div class="buttons">
                <?php if (isset($_SESSION['user'])) {
                    echo "<p>Welcome, " . $_SESSION['user'] . "</p>";
                } ?>
                <?php if (isset($_SESSION['user'])): ?>
                    <a href="../validate/logout-validate.php" class="signup">Logout</a>
                <?php else: ?>
                    <a href="login.php" class="login">Log In</a>
                    <a href="register.php" class="signup">Sign Up</a>
                <?php endif; ?>
            </div>
        </div>
    </header>
<body>
    <main>
        <div class="intro3">
            <h2>About this Project</h2>
            <p>
                This project was created for our <b>Advance Web Development (CS 6)</b> subject, for which we were tasked with creating a <i><b>Gift Shop Management System</b></i> that allows customers to browse products, make purchases/orders, and access customer information.
            </p>
            <div class="programmers">
                <h3>Programmers</h3>
                
                <div class="prog">
                    <h4>Carlos Joseph Dizon</h4>
                    <img src="../images/programmer.jpg" alt="" width="150px">
                </div>
                <div class="prog">
                    <h4>Morpheus Joshua Francisco</h4>
                    <img src="../images/programmer2.png" alt="" width="150px">
                </div>
                
                <div class="projectsource">
                    <h5>Project Source Code</h5>
                    <a href="https://github.com/Kawtsun/GiftShopManagementSystem">
                        <img src="../images/github.svg" alt="" width="40px">
                    </a>
                </div>
            </div>
        </div>
    </main>
    <footer>
        Copyright &copy; 2024 Likhang Kultura All Rights Reserved.
    </footer>
</body>
</html>