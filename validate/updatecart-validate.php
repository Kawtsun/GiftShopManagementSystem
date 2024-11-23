<?php
session_start();

include 'db.php';

if (isset($_POST['update_cart'])) {
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $product_code = $_POST['product_code'];
        $quantity = $_POST['quantity'];

        // Update the quantity for the product in the cart
        $sql = "UPDATE cart SET quantity = ? WHERE user_id = ? AND product_code = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "iis", $quantity, $user_id, $product_code);
        mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);
        $_SESSION['success_message'] = "Cart updated successfully!";
        header("Location: ../pages/cart.php");
        exit();
    } else {
        $_SESSION['error_message'] = "You need to log in to update your cart.";
        header("Location: ../pages/login.php");
        exit();
    }
} elseif (isset($_POST['remove_item'])) {
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $product_code = $_POST['product_code'];

        // Remove the item from the cart
        $sql = "DELETE FROM cart WHERE user_id = ? AND product_code = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "is", $user_id, $product_code);
        mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);
        $_SESSION['success_message'] = "Item removed from cart successfully!";
        header("Location: ../pages/cart.php");
        exit();
    } else {
        $_SESSION['error_message'] = "You need to log in to remove items from your cart.";
        header("Location: ../pages/login.php");
        exit();
    }
}
?>
