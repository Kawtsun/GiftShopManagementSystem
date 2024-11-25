<?php
session_start();

include '../validate/db.php';

if (!isset($_SESSION['user_id'])) {
    $_SESSION['error_message'] = "You need to log in to view your recent orders.";
    header("Location: ../pages/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT order_id, order_date, name, email, address, payment_method 
        FROM orders 
        WHERE user_id = ? 
        ORDER BY order_date DESC";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$orders = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_stmt_close($stmt);

$order_items = [];
$order_totals = [];
foreach ($orders as $order) {
    $order_id = $order['order_id'];
    $sql = "SELECT mp.product_code, mp.product_name, oi.quantity, mp.product_price 
            FROM order_items oi 
            JOIN main_products mp ON oi.main_product_id = mp.product_id 
            WHERE oi.order_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $order_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $items = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $order_items[$order_id] = $items;
    mysqli_stmt_close($stmt);
    
    $total_price = 0;
    foreach ($items as $item) {
        $total_price += $item['product_price'] * $item['quantity'];
    }
    $order_totals[$order_id] = $total_price;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recent Orders - Likhang Kultura</title>
    <link href="https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,100..900;1,100..900&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Knewave&family=Rubik+Glitch&family=Shrikhand&family=Sriracha&display=swap" rel="stylesheet">
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
                } ?></p>
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
        <div class="intro2">
            <div class="cart_button_left">
                <a href="cart.php" class="btn">Go Back</a>
            </div>
            <div class="intro_message_right">
                <h2>Recent Orders</h2>
                <p>Here are your recent orders.</p>
            </div>
        </div>
        <div class="order_summary">
            <?php if (count($orders) > 0): ?>
                <?php foreach ($orders as $order): ?>
                    <div class="summary_intro">
                        <h3>Order ID: <?php echo $order['order_id']; ?></h3>
                        <p><strong>Date:</strong> <?php echo $order['order_date']; ?></p>
                        <p><strong>Name:</strong> <?php echo htmlspecialchars($order['name']); ?></p>
                        <p><strong>Email:</strong> <?php echo htmlspecialchars($order['email']); ?></p>
                        <p><strong>Address:</strong> <?php echo nl2br(htmlspecialchars($order['address'])); ?></p>
                        <p><strong>Payment Method:</strong> <?php echo htmlspecialchars(ucfirst(str_replace('_', ' ', $order['payment_method']))); ?></p>
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
                                <?php foreach ($order_items[$order['order_id']] as $item): ?>
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
                        <h4>Total Price: ₱<?php echo number_format($order_totals[$order['order_id']], 2); ?></h4>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>You have no recent orders.</p>
            <?php endif; ?>
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
