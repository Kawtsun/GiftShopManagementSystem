<?php
session_start();

include 'db.php';

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $email = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if ($email) {
        if (password_verify($pass, $email["password"])) {
            header("Location: ../index.php");
            exit();
        } else {
            $_SESSION['error_message'] = "Password does not match.";
            header("Location: ../pages/login.php");
            exit();
        }
    } else {
        $_SESSION['error_message'] = "Email does not exist.";
        header("Location: ../pages/login.php");
    }
}


?>