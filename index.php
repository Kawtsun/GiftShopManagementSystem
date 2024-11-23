<?php
session_start();

include 'validate/db.php';

$sql = "SELECT * FROM products";
$all_products = $conn->query($sql);
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
    <main>
        <h2>Featured Products</h2>
        <p>Explore our range of gifts!</p>
        <div class="product_container">
            <?php
            while($row = mysqli_fetch_assoc($all_products)) {
                echo '
                <div class="card">
                    <div class="image">
                        <img src="' . $row["product_image"] . '" alt="">
                    </div>
                    <div class="caption">
                        <p class="product_name">' . $row["product_name"] . '</p>
                        <p class="product_price">Price: ₱' . $row["product_price"] . '</p>
                    </div>
                    <div class="card_buttons">
                        <input type="number" name="quantity" min="0" value="0" required>
                        <button type="submit">Add to Cart</button>
                    </div>
                </div>
                ';
            }
            ?>
        </div>
    </main>
</body>
</html>
