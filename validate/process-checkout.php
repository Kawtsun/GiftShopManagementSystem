<?php
session_start();

include 'db.php';

if (isset($_POST['submit_checkout'])) {
    if (!isset($_SESSION['user_id'])) {
        $_SESSION['error_message'] = "You need to log in to proceed.";
        header("Location: ../pages/login.php");
        exit();
    }

    $user_id = $_SESSION['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $payment_method = $_POST['payment_method'];

    $sql = "INSERT INTO orders (user_id, name, email, address, payment_method) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "issss", $user_id, $name, $email, $address, $payment_method);
    mysqli_stmt_execute($stmt);
    $order_id = mysqli_insert_id($conn);
    mysqli_stmt_close($stmt);

    $sql = "SELECT c.main_product_id, c.quantity, mp.product_code, mp.product_name, mp.product_price 
            FROM cart c 
            JOIN main_products mp ON c.main_product_id = mp.product_id 
            WHERE c.user_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $cart_items = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);

    $sql = "INSERT INTO order_items (order_id, main_product_id, quantity) 
            VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    foreach ($cart_items as $item) {
        mysqli_stmt_bind_param($stmt, "iii", $order_id, $item['main_product_id'], $item['quantity']);
        mysqli_stmt_execute($stmt);
    }
    mysqli_stmt_close($stmt);

    $total_price = 0;
    foreach ($cart_items as $item) {
        $subtotal = $item['product_price'] * $item['quantity'];
        $total_price += $subtotal;
    }

    $sql = "DELETE FROM cart WHERE user_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $_SESSION['order_summary'] = [
        'order_id' => $order_id,
        'name' => $name,
        'email' => $email,
        'address' => $address,
        'payment_method' => $payment_method,
        'order_items' => $cart_items,
        'total_price' => $total_price
    ];
    
    $_SESSION['success_message'] = ($payment_method == 'Credit Card') 
        ? "Order Confirmation! Thank you for shopping with us! Your purchase has been successfully processed."
        : "Order Confirmation! Thank you for shopping with us! Please pay once you receive your order.";

    $sql = "SELECT * FROM profile WHERE user_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $sql = "UPDATE profile SET shipping_address = ? WHERE user_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "si", $address, $user_id);
    } else {
        $sql = "INSERT INTO profile (user_id, fullname, shipping_address, email) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "isss", $user_id, $name, $address, $email);
    }
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    
    header("Location: ../pages/order-confirmation.php");
    exit();
}
?>
