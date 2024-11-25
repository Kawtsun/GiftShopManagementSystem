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
    <link rel="stylesheet" href="../style.css"> <!-- Ensure path is correct -->
</head>
<body>
    <header>
        <!-- Include your site's header here -->
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
            <h3>Total Price: ₱<?php echo number_format($order_summary['total_price'], 2); ?></h3>
        </div>
    </main>
    <footer>
        <!-- Include your site's footer here -->
    </footer>
</body>
</html>
