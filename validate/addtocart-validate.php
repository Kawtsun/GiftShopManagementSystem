<?php
session_start();

include 'db.php';

if (isset($_POST['add_to_cart'])) {
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $product_code = $_POST['product_code'];
        $quantity = $_POST['quantity'];

        // Check if the product is already in the cart
        $sql = "SELECT * FROM cart WHERE user_id = ? AND product_code = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "is", $user_id, $product_code);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            // Update the quantity if the product is already in the cart
            $sql = "UPDATE cart SET quantity = quantity + ? WHERE user_id = ? AND product_code = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "iis", $quantity, $user_id, $product_code);
            mysqli_stmt_execute($stmt);
        } else {
            // Insert a new row if the product is not in the cart
            $sql = "INSERT INTO cart (user_id, product_code, quantity) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "isi", $user_id, $product_code, $quantity);
            mysqli_stmt_execute($stmt);
        }

        mysqli_stmt_close($stmt);
        $_SESSION['success_message'] = "Product added to cart successfully!";
        header("Location: ../index.php");
        exit();
    } else {
        $_SESSION['error_message'] = "You need to log in to add items to your cart.";
        header("Location: ../pages/login.php");
        exit();
    }
}
?>
