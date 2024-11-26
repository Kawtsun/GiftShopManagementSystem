<?php
session_start();

include 'db.php';

if (isset($_POST['update_cart'])) {
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $main_product_id = $_POST['main_product_id'];
        $quantity = $_POST['quantity'];

        $sql = "UPDATE cart SET quantity = ? WHERE user_id = ? AND main_product_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "iii", $quantity, $user_id, $main_product_id);
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
        $main_product_id = $_POST['main_product_id'];

        $sql = "DELETE FROM cart WHERE user_id = ? AND main_product_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ii", $user_id, $main_product_id);
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
