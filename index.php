<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Likhang Kultura - Welcome to our gift store!</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,100..900;1,100..900&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="navbar">
            <div class="logo">
                <img src="images/logo.svg" alt="Likhang Kultura">
            </div>
            <div class="nav-center">
                <nav class="navlinks">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="index.php">Catalog</a></li>
                        <li><a href="index.php">About</a></li>
                        <li><a href="index.php">Cart</a></li>
                    </ul>
                </nav>
                <p><?php if (isset($_SESSION['user'])) {
                    echo "Welcome, " . $_SESSION['user'];
                }
                 ?></p>
                <div class="buttons">
                    <?php if (isset($_SESSION['user'])): ?>
                    <a href="validate/logout-validate.php" class="signup">Logout</a>
                    <?php else: ?>
                    <a href="pages/login.php" class="login">Log In</a>
                    <a href="pages/register.php" class="signup">Sign Up</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>
</body>
</html>