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
        <div class="intro4">
            <h2>About this Gift Shop</h2>
            <p>
                Welcome to <b>Likhang Kultura!</b> 🌟 <br><br>

                Located in the heart of our community, <b>Likhang Kultura</b> is more than just a gift store—it's a celebration of Filipino craftsmanship and culture. Our shop proudly showcases a curated selection of handcrafted products, each piece telling its own unique story of artistry and heritage. <br><br>

                <b>Sa Likhang Kultura, bawat produkto ay may kwento.</b> We take pride in offering a diverse range of items. Each creation is a testament to the rich cultural heritage of the Philippines, lovingly crafted by talented local artisans. <br><br>

                Whether you're looking for the perfect gift, a unique piece to add to your home, or a special reminder of our beautiful culture, you'll find it here. We believe in the beauty of handmade products, the importance of supporting local artisans, and the joy of sharing our cultural heritage with the world. <br><br>

                <b>Halina't tuklasin ang ganda ng likhang Pilipino sa Likhang Kultura!</b> Your journey through our store is not just a shopping experience but a cultural exploration. Every item you purchase helps support our artisans and preserve our rich traditions for future generations. <br><br>

                Thank you for visiting <b>Likhang Kultura.</b> We hope you leave with a piece of the Philippines in your heart and home. <br><br>
            </p>
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