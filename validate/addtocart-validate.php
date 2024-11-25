<?php
session_start();

include 'db.php';

if (isset($_POST['add_to_cart'])) {
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $main_product_id = $_POST['main_product_id'];
        $quantity = $_POST['quantity'];

        $sql = "SELECT * FROM cart WHERE user_id = ? AND main_product_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ii", $user_id, $main_product_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $sql = "UPDATE cart SET quantity = quantity + ? WHERE user_id = ? AND main_product_id = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "iii", $quantity, $user_id, $main_product_id);
            mysqli_stmt_execute($stmt);
        } else {
            $sql = "INSERT INTO cart (user_id, main_product_id, quantity) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "iii", $user_id, $main_product_id, $quantity);
            mysqli_stmt_execute($stmt);
        }

        mysqli_stmt_close($stmt);

        $referrer = $_SERVER['HTTP_REFERER'];
        $_SESSION['success_message'] = "Product added to cart successfully!";
        header("Location: " . $referrer);
        exit();
    } else {
        $_SESSION['error_message'] = "You need to log in to add items to your cart.";
        header("Location: ../pages/login.php");
        exit();
    }
}
?>
