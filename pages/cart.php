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
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <header>
        <!-- Include your site's header here -->
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
                                <button type="submit" name="update_cart">Update</button>
                            </div>
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
