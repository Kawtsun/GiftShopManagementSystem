<?php

session_start();

include 'db.php';

if (isset($_POST['submit'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $confirm_pass = $_POST['confirm_password'];

    $password_hash = password_hash($pass, PASSWORD_DEFAULT);

    $errors = array();

    if (empty($fullname) || empty($email) || empty($user) || empty($pass) || empty($confirm_pass)) {
        array_push($errors, "All fields are required.");
    }

    if (!empty($email)) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Email is not valid.");
        }
    }

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        array_push($errors, "Email already exists.");
    }

    if (count($errors) > 0) {
        $_SESSION['message'] = $errors;
        header("Location: ../pages/register.php");
        exit();
    }

    if (!empty($pass)) {
        if (strlen($pass) < 8) {
            array_push($errors, "Password must be at least 8 characters long.");
        } elseif ($pass !== $confirm_pass) {
            array_push($errors, "Password do not match.");
        }
    }

    if (count($errors) > 0) {
        $_SESSION['message'] = $errors;
        header("Location: ../pages/register.php");
        exit();
    } else {
        $sql = "INSERT INTO users (fullname, email, username, password) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssss", $fullname, $email, $user, $password_hash);
        mysqli_stmt_execute($stmt);

        header("Location: ../pages/login.php");
        exit();
    }
}
?>
