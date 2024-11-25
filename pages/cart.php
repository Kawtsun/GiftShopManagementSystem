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
    SELECT mp.product_id, mp.product_code, mp.product_name, mp.product_price, mp.product_image, c.quantity 
    FROM cart c
    JOIN main_products mp ON c.main_product_id = mp.product_id
    WHERE c.user_id = ?
";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Initialize total price 
$total_price = 0;
$cart_is_empty = true; // Flag to check if cart is empty
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
    <script src="../script.js"></script>
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
                        <li><a href="catalog.php">Catalog</a></li>
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
            if (isset($_SESSION['success_message'])) { echo "<div id='success-message' class='alert success'>{$_SESSION['success_message']}</div>"; unset($_SESSION['success_message']); } 
        ?>
        <div class="intro2">
            <div class="intro_message">
                <h2>Your Cart</h2>
                <p>These are the items you've added to your cart.</p>
            </div>
            <div class="cart_button"> 
                <a href="recent-orders.php" class="btn">Recent Orders</a> 
            </div>
        </div>
        
        <div class="product_container">
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php $cart_is_empty = false; // Cart is not emptyz
                    while ($row = mysqli_fetch_assoc($result)): ?>
                    <?php $subtotal = $row['product_price'] * $row['quantity']; $total_price += $subtotal; ?>
                    <div class="card">
                        <div class="image">
                            <img src="../<?php echo $row['product_image']; ?>" alt="<?php echo $row['product_name']; ?>">
                        </div>
                        <div class="caption">
                            <p class="product_name"><?php echo $row['product_name']; ?></p>
                            <div class="price_subtotal">
                                <p class="product_price">₱<?php echo $row['product_price']; ?></p>
                                <p class="product_subtotal">Subtotal: ₱<?php echo number_format($subtotal, 2); ?></p>
                            </div>
     
                        </div>
                        <form action="../validate/updatecart-validate.php" method="POST">
                            <input type="hidden" name="main_product_id" value="<?php echo $row['product_id']; ?>">
                            <div class="card_buttons">
                                <div class="quantity_wrapper">
                                    <label for="quantity-<?php echo $row['product_code']; ?>">Qty:</label>
                                    <input type="number" id="quantity-<?php echo $row['product_code']; ?>" name="quantity" min="1" value="<?php echo $row['quantity']; ?>" required>
                                </div>
                                <button type="submit" class="update" name="update_cart">Update</button>
                                <button type="submit" class="remove" name="remove_item">Remove</button>
                            </div>
                        </form>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="empty">Your cart is empty.</p>
            <?php endif; ?>
        </div>
        <?php if (!$cart_is_empty): ?>
            <div class="total_billing">
                <div class="proceed_to_billing">
                    <a href="billing.php" class="btn">Proceed to Billing</a>
                </div>
                <div class="total_price">
                    <h3>Total: ₱<?php echo number_format($total_price, 2); ?></h3>
                </div>
            </div>
        <?php endif; ?>



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
