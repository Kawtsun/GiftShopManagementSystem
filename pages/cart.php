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
    SELECT mp.product_id, mp.product_name, mp.product_price, mp.product_image, c.quantity 
    FROM cart c
    JOIN main_products mp ON c.main_product_id = mp.product_id
    WHERE c.user_id = ?
";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$total_price = 0;
$cart_is_empty = mysqli_num_rows($result) === 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart - Likhang Kultura</title>
    <link href="https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,100..900;1,100..900&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Knewave&family=Rubik+Glitch&family=Shrikhand&family=Sriracha&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
    <script src="../script.js"></script>
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
            <div class="profile_cart">
                <a href="profile.php">
                    <img src="../images/user.svg" alt="Profile" width="25px" class="profile">
                </a>
                <a href="cart.php">
                    <img src="../images/shopping-cart.svg" alt="Cart" width="25px" class="cart active">
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
    <main>
        <?php 
            if (isset($_SESSION['success_message'])) { echo "<div id='success-message' class='alert success'>{$_SESSION['success_message']}</div>"; unset($_SESSION['success_message']); } 
        ?>
        <div class="intro2">
            <div class="intro_message_left">
                <h2>Your Cart</h2>
                <p>These are the items you've added to your cart.</p>
            </div>
            <div class="cart_button_right">
                <a href="recent-orders.php" class="btn">Recent Orders</a>
            </div>
        </div>
        <div class="product_container">
            <?php if ($cart_is_empty): ?>
                <div class="empty_cart_message">
                    <p>Your cart is currently empty.</p>
                </div>
            <?php else: ?>
                <table class="cart_table">
                    <thead>
                        <tr>
                            <th>Product Image</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <?php
                            $subtotal = $row['product_price'] * $row['quantity'];
                            $total_price += $subtotal;
                            ?>
                            <tr>
                                <td><img src="../<?php echo $row['product_image']; ?>" alt="<?php echo $row['product_name']; ?>"></td>
                                <td><?php echo $row['product_name']; ?></td>
                                <td>₱<?php echo number_format($row['product_price'], 2); ?></td>
                                <td>
                                    <form action="../validate/updatecart-validate.php" method="POST" style="display: inline-block;">
                                        <input type="hidden" name="main_product_id" value="<?php echo $row['product_id']; ?>">
                                        <input type="number" name="quantity" min="1" value="<?php echo $row['quantity']; ?>" required>
                                        <button type="submit" name="update_cart" class="update">Update</button>
                                    </form>
                                </td>
                                <td class="subtotal">₱<?php echo number_format($subtotal, 2); ?></td>
                                <td>
                                    <form action="../validate/updatecart-validate.php" method="POST" style="display: inline-block;">
                                        <input type="hidden" name="main_product_id" value="<?php echo $row['product_id']; ?>">
                                        <button type="submit" name="remove_item" class="remove">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <div class="total_billing">
                    <div class="total_price">
                        <h3>Total Price: ₱<?php echo number_format($total_price, 2); ?></h3>
                    </div>
                    <div class="proceed_to_billing">
                        <a href="checkout.php" class="btn">Proceed to Checkout</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </main>    
    <footer>
        Copyright &copy; 2024 Likhang Kultura All Rights Reserved.
    </footer>
</body>
</html>

<?php
mysqli_stmt_close($stmt);
$conn->close();
?>
