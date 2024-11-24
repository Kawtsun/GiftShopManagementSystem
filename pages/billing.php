<?php
session_start();

include '../validate/db.php';

if (!isset($_SESSION['user_id'])) {
    $_SESSION['error_message'] = "You need to log in to proceed to billing.";
    header("Location: ../pages/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user details
$sql = "SELECT fullname, email FROM users WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing - Likhang Kultura</title>
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
                        <li><a href="catalog.php">Catalog</a></li>
                        <li><a href="about.php">About</a></li>
                        <li><a href="cart.php">Cart</a></li>
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
        <div class="intro">
            <h2>Billing Information</h2>
            <p>Please fill in your details to complete your purchase.</p>
        </div>
        <form action="../validate/process-billing.php" method="POST">
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
                <textarea id="address" name="address" required></textarea>
            </div>
            <div class="form-group"> <label for="payment_method">Payment Method:</label>
                <select id="payment_method" name="payment_method" required> <option value="cod">Cash on Delivery (COD)</option> <option value="credit_card">Credit Card</option> </select> 
            </div>
            <button type="submit" name="submit_billing">Proceed to Payment</button>
        </form>
    </main>
    <footer>
        <!-- Include your site's footer here -->
    </footer>
</body>
</html>

<?php
$conn->close();
?>
