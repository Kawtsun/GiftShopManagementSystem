<?php
if (isset($_SESSION['message']) && is_array($_SESSION['message'])) {
    foreach ($_SESSION['message'] as $error) {
        echo "<div class='alert error'>{$error}</div>";
    }

    unset($_SESSION['message']);
}

if (isset($_SESSION['success_message'])) {
    echo "<div class='alert success'>{$_SESSION['success_message']}</div>";
    unset($_SESSION['success_message']);
}

?>