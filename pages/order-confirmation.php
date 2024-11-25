<?php
session_start();

if (!isset($_SESSION['order_summary'])) {
    header("Location: ../index.php");
    exit();
}

$order_summary = $_SESSION['order_summary'];
$success_message = $_SESSION['success_message'];

// Clear the session data to avoid displaying the same message on refresh
unset($_SESSION['order_summary']);
unset($_SESSION['success_message']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation - Likhang Kultura</title>
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
        <div class="intro">
            <h2><?php echo $success_message; ?></h2>
            <p>Order ID: <?php echo $order_summary['order_id']; ?></p>
        </div>
        <div class="order_summary">
            <h3>Order Summary</h3>
            <p><strong>Name:</strong> <?php echo htmlspecialchars($order_summary['name']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($order_summary['email']); ?></p>
            <p><strong>Shipping Address:</strong> <?php echo nl2br(htmlspecialchars($order_summary['address'])); ?></p>
            <p><strong>Payment Method:</strong> <?php echo htmlspecialchars(ucfirst(str_replace('_', ' ', $order_summary['payment_method']))); ?></p>
            <table>
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($order_summary['order_items'] as $item): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                            <td><?php echo $item['quantity']; ?></td>
                            <td>₱<?php echo number_format($item['product_price'], 2); ?></td>
                            <td>₱<?php echo number_format($item['product_price'] * $item['quantity'], 2); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <h3>Total Price: ₱<?php echo number_format($order_summary['total_price'], 2); ?></h3>
        </div>
    </main>
    <footer>
        <!-- Include your site's footer here -->
    </footer>
</body>
</html>
