<?php
session_start();

include '../validate/db.php';

if (!isset($_SESSION['user_id'])) {
    $_SESSION['error_message'] = "You need to log in to view your profile.";
    header("Location: ../pages/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user profile information
$sql = "SELECT p.fullname, p.shipping_address, u.email FROM profile p JOIN users u ON p.user_id = u.id WHERE p.user_id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$profile = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);

// If profile doesn't exist, fetch email from users table and initialize profile fields
if ($profile === null) {
    $sql = "SELECT fullname, email FROM users WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    $profile = [
        'fullname' => $user['fullname'],
        'shipping_address' => '',
        'email' => $user['email']
    ];

    mysqli_stmt_close($stmt);
}

// Update profile information
$errors = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $shipping_address = $_POST['shipping_address'];
    $email = $_POST['email'];
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Validate password
    if (!empty($password)) {
        if (strlen($password) < 8) {
            $errors[] = "Password must be at least 8 characters long.";
        } elseif ($password !== $confirm_password) {
            $errors[] = "Passwords do not match.";
        }
    }

    if (empty($errors)) {
        // Update profile table
        $sql = "SELECT * FROM profile WHERE user_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $sql = "UPDATE profile SET fullname = ?, shipping_address = ?, email = ? WHERE user_id = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "sssi", $fullname, $shipping_address, $email, $user_id);
        } else {
            $sql = "INSERT INTO profile (user_id, fullname, shipping_address, email) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "isss", $user_id, $fullname, $shipping_address, $email);
        }
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        // Update users table
        $sql = "UPDATE users SET fullname = ?, email = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssi", $fullname, $email, $user_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        // Update password if provided
        if (!empty($password)) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE users SET password = ? WHERE id = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "si", $hashed_password, $user_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }

        $_SESSION['success_message'] = "Profile updated successfully!";
        header("Location: profile.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Likhang Kultura</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,100..900;1,100..900&family=Inter:ital,opsz,wght@0,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
    <script src="../script.js"></script>
</head>
<body>
    <header>
        <div class="navbar">
            <div class="logo">
                <img src="../images/logo.svg" alt="Likhang Kultura">
            </div>
            <div class="nav-center">
                <nav class="navlinks">
                    <ul>
                        <li><a href="../index.php">Home</a></li>
                        <li><a href="catalog.php">Catalog</a></li>
                        <li><a href="index.php">About</a></li>
                    </ul>
                </nav>
                <div class="profile_cart">
                    <a href="../pages/profile.php"> <img src="../images/user.svg" alt="" width="30px" class="profile active"> </a>
                    <a href="../pages/cart.php"> <img src="../images/shopping-cart.svg" alt="" width="30px" class="cart"> </a>
                </div>
                <p><?php if (isset($_SESSION['user'])) {
                    echo "Welcome, " . $_SESSION['user'];
                } ?></p>
                <div class="buttons">
                    <?php if (isset($_SESSION['user'])): ?>
                    <a href="../validate/logout-validate.php" class="signup">Logout</a>
                    <?php else: ?>
                    <a href="login.php" class="login">Log In</a>
                    <a href="register.php" class="signup">Sign Up</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div class="intro3">
            <h2>Profile</h2>
            <p>Update your profile information below.</p>
        </div>
        <div class="profile_container">
            <?php 
                if (isset($_SESSION['success_message'])) { 
                    echo "<div id='success-message' class='alert success'>{$_SESSION['success_message']}</div>"; 
                    unset($_SESSION['success_message']); 
                }
            ?>
            <div class="billing_container">
                <?php
                if (!empty($errors)) {
                    echo "<div class='alert error'>";
                    foreach ($errors as $error) {
                        echo "<p>$error</p>";
                    }
                    echo "</div>";
                }
                ?>
                <form action="profile.php" method="POST">
                    <div class="form-group">
                        <label for="fullname">Name:</label>
                        <input type="text" id="fullname" name="fullname" value="<?php echo htmlspecialchars($profile['fullname']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($profile['email']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="shipping_address">Shipping Address:</label>
                        <textarea id="shipping_address" name="shipping_address" required><?php echo htmlspecialchars($profile['shipping_address']); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="password">Password (leave blank to keep current password):</label>
                        <input type="password" id="password" name="password">
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password:</label>
                        <input type="password" id="confirm_password" name="confirm_password">
                    </div>
                    <button type="submit">Update Profile</button>
                </form>
            </div>
            
        </div>
    </main>
    <footer>
        <!-- Include your site's footer here -->
    </footer>
</body>
</html>

<?php
$conn->close();
?>
