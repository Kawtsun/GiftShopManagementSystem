<?php
session_start();

include '../validate/db.php';

if (!isset($_SESSION['user_id'])) {
    $_SESSION['error_message'] = "You need to log in to proceed to billing.";
    header("Location: ../pages/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT COUNT(*) AS item_count FROM cart WHERE user_id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);
$cart_is_empty = ($row['item_count'] == 0);

mysqli_stmt_close($stmt);

if ($cart_is_empty) {
    $_SESSION['error_message'] = "Your cart is empty. Please add items to your cart before proceeding to billing.";
    header("Location: cart.php");
    exit();
}

$sql = "SELECT fullname, email FROM users WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

$sql = "SELECT shipping_address FROM profile WHERE user_id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$profile = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

if ($profile === null) {
    $profile = [
        'shipping_address' => ''
    ];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Likhang Kultura</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
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
                    <img src="../images/user.svg" alt="Profile" width="30px" class="profile">
                </a>
                <a href="cart.php">
                    <img src="../images/shopping-cart.svg" alt="Cart" width="30px" class="cart">
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
        <div class="intro2">
            <div class="cart_button_left">
                <a href="cart.php" class="btn">Go Back</a>
            </div>
            <div class="intro_message_right">
                <h2>Checkout Information</h2>
                <p>Please fill in your details to complete your purchase.</p>
            </div>
        </div>
        <div class="billing_container">
            <form action="../validate/process-checkout.php" method="POST">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['fullname']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="address">Shipping Address:</label>
                    <textarea id="address" name="address" required><?php echo htmlspecialchars($profile['shipping_address']); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="payment_method">Payment Method:</label>
                    <select id="payment_method" name="payment_method" required>
                        <option value="Cash on Delivery (COD)">Cash on Delivery (COD)</option>
                        <option value="Credit Card">Credit Card</option>
                    </select>
                </div>
                <button type="submit" name="submit_checkout">Proceed to Payment</button>
            </form>
        </div>
    </main>
    <footer>
        <!-- Include your site's footer here -->
    </footer>
</body>
</html>

<?php
$conn->close();
?>
