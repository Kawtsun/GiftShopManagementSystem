<?php
session_start();

include '../validate/db.php';

if (!isset($_SESSION['user_id'])) {
    $_SESSION['error_message'] = "You need to log in to view your cart.";
    header("Location: ../pages/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "
    SELECT p.product_code, p.product_name, p.product_price, p.product_image, c.quantity 
    FROM cart c
    JOIN products p ON c.product_code = p.product_code
    WHERE c.user_id = ?
";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,100..900;1,100..900&family=Inter:ital,opsz,wght@0,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <header>
        <div class="navbar">
            <div class="logo">
                <img src="../images/logo.svg" alt="Likhang Kultura">
            </div>
            <div class="nav-center">
                <nav class="navlinks">
                    <ul>
                        <li><a href="../index.php">Home</a></li>
                        <li><a href="index.php">Catalog</a></li>
                        <li><a href="index.php">About</a></li>
                        <li><a href="cart.php">Cart</a></li>
                    </ul>
                </nav>
                <p><?php if (isset($_SESSION['user'])) {
                    echo "Welcome, " . $_SESSION['user'];
                }
                 ?></p>
                <div class="buttons">
                    <?php if (isset($_SESSION['user'])): ?>
                    <a href="../validate/logout-validate.php" class="signup">Logout</a>
                    <?php else: ?>
                    <a href="login.php" class="login">Log In</a>
                    <a href="register.php" class="signup">Sign Up</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>
    <main>
        <?php
            if (isset($_SESSION['success_message'])) {
                echo "<div class='alert success'>{$_SESSION['success_message']}</div>";
                unset($_SESSION['success_message']);
            }
        ?>
        <div class="intro">
            <h2>Your Cart</h2>
            <p>These are the items you've added to your cart.</p>
        </div>
        <div class="product_container">
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <div class="card">
                        <div class="image">
                            <img src="../<?php echo $row['product_image']; ?>" alt="<?php echo $row['product_name']; ?>">
                        </div>
                        <div class="caption">
                            <p class="product_name"><?php echo $row['product_name']; ?></p>
                            <p class="product_price">₱<?php echo $row['product_price']; ?></p>
                        </div>
                        <form action="../validate/updatecart-validate.php" method="POST">
                            <input type="hidden" name="product_code" value="<?php echo $row['product_code']; ?>">
                            <div class="card_buttons">
                                <div class="quantity_wrapper">
                                    <label for="quantity-<?php echo $row['product_code']; ?>">Qty:</label>
                                    <input type="number" id="quantity-<?php echo $row['product_code']; ?>" name="quantity" min="1" value="<?php echo $row['quantity']; ?>" required>
                                </div>
                                <button type="submit" class="update" name="update_cart">Update</button>
                            </div>
                            <button type="submit" class="remove" name="remove_item">Remove</button>
                        </form>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>Your cart is empty.</p>
            <?php endif; ?>
        </div>
    </main>
    <footer>
        <!-- Include your site's footer here -->
    </footer>
</body>
</html>

<?php
mysqli_stmt_close($stmt);
$conn->close();
?>
