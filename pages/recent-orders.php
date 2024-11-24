<?php
session_start();

include '../validate/db.php';

if (!isset($_SESSION['user_id'])) {
    $_SESSION['error_message'] = "You need to log in to view your recent orders.";
    header("Location: ../pages/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch recent orders
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

// Fetch order items and calculate total price for each order
$order_items = [];
$order_totals = [];
foreach ($orders as $order) {
    $order_id = $order['order_id'];
    $sql = "SELECT mp.product_name, oi.quantity, mp.product_price 
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
    
    // Calculate total price for the order
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
    <link rel="stylesheet" href="../style.css"> <!-- Ensure path is correct -->
</head>
<body>
    <header>
        <!-- Include your site's header here -->
    </header>
    <main>
        <div class="intro">
            <h2>Recent Orders</h2>
            <p>Here are your recent orders.</p>
        </div>
        <div class="order_list">
            <?php if (count($orders) > 0): ?>
                <?php foreach ($orders as $order): ?>
                    <div class="order">
                        <h3>Order ID: <?php echo $order['order_id']; ?></h3>
                        <p><strong>Date:</strong> <?php echo $order['order_date']; ?></p>
                        <p><strong>Name:</strong> <?php echo htmlspecialchars($order['name']); ?></p>
                        <p><strong>Email:</strong> <?php echo htmlspecialchars($order['email']); ?></p>
                        <p><strong>Address:</strong> <?php echo nl2br(htmlspecialchars($order['address'])); ?></p>
                        <p><strong>Payment Method:</strong> <?php echo htmlspecialchars(ucfirst(str_replace('_', ' ', $order['payment_method']))); ?></p>
                        <h4>Items Purchased:</h4>
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
                                <?php foreach ($order_items[$order['order_id']] as $item): ?>
                                    <tr>
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
