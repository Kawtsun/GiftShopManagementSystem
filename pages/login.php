<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Likhang Kultura</title>
    <link href="https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,100..900;1,100..900&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Knewave&family=Rubik+Glitch&family=Shrikhand&family=Sriracha&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <header>
        <div class="navbar">
            <div class="nav-center">
                <div class="logo">
                    <img src="../images/logo.svg" alt="Likhang Kultura">
                </div>
                <nav class="navlinks">
                    <ul>
                        <li><a href="../index.php">Home</a></li>
                        <li><a href="catalog.php">Catalog</a></li>
                        <li><a href="about.php">About</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <main class="withbg_login">
        <div class="form_container">
            <div class="intro_login">
                <h1>Log in now</h1>
            </div>

            <?php
                include '../validate/alert-login.php';
            ?>

            <form action="../validate/login-validate.php" method="POST">
                <div class="form_data">
                    <input type="email" name="email" placeholder="Email">
                    <input type="password" name="password" placeholder="Password">
                    <input type="submit" value="Log In" name="login">
                </div>
            </form>
            <div class="message">
                <p>
                    Don't have an account? <a href="register.php">Sign up Here</a>
                </p>
            </div>
        </div>
        </main>
    
        <footer>
            Copyright &copy; 2024 Likhang Kultura All Rights Reserved.
        </footer>
</body>
</html>