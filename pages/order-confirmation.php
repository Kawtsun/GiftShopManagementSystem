<?php
session_start();

if (!isset($_SESSION['order_summary'])) {
    header("Location: ../index.php");
    exit();
}

$order_summary = $_SESSION['order_summary'];
$success_message = isset($_SESSION['success_message']) ? $_SESSION['success_message'] : null;
$user_id = $_SESSION['user_id'];

unset($_SESSION['order_summary']);
unset($_SESSION['success_message']);

include '../validate/db.php';

$sql = "SELECT fullname, shipping_address FROM profile WHERE user_id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$profile = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

if ($profile === null) {
    $profile = [
        'fullname' => $order_summary['name'],
        'shipping_address' => $order_summary['address'],
    ];
}
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
        <div class="intro3">
            <h2><?php echo $success_message; ?></h2>
            <p>Order ID: <?php echo $order_summary['order_id']; ?></p>
        </div>
        <div class="order_summary">
            <div class="summary_intro">
                <p><strong>Name:</strong> <?php echo htmlspecialchars($profile['fullname']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($order_summary['email']); ?></p>
                <p><strong>Shipping Address:</strong> <?php echo nl2br(htmlspecialchars($profile['shipping_address'])); ?></p>
                <p><strong>Payment Method:</strong> <?php echo htmlspecialchars(ucfirst(str_replace('_', ' ', $order_summary['payment_method']))); ?></p>
                <h4>Items Purchased:</h4>
                <table class="cart_table2">
                    <thead>
                        <tr>
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($order_summary['order_items'] as $item): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($item['product_code']); ?></td>
                                <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                                <td><?php echo $item['quantity']; ?></td>
                                <td>₱<?php echo number_format($item['product_price'], 2); ?></td>
                                <td>₱<?php echo number_format($item['product_price'] * $item['quantity'], 2); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <h4>Total Price: ₱<?php echo number_format($order_summary['total_price'], 2); ?></h4>
            </div>
        </div>
    </main>
    <footer>
        <!-- Include your site's footer here -->
    </footer>
</body>
</html>
