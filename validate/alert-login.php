<?php
session_start();

if (isset($_SESSION['error_message'])) {
    echo "<div class='alert error'>" . $_SESSION['error_message'] . "</div>";
    unset($_SESSION['error_message']);
}

?>