<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Likhang Kultura - Login now</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,100..900;1,100..900&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="..\style.css">
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
                        <li><a href="index.php">Catalog</a></li>
                        <li><a href="index.php">About</a></li>
                        <li><a href="index.php">Cart</a></li>
                    </ul>
                </nav>
            </div>
        </div>
        
    </header>
    <div class="form_container">
        <div class="intro">
            <h1>Log in now</h1>
        </div>

        <form action="../validate/register-validate.php" method="POST">
            <div class="form_data">
                <input type="email" name="email" placeholder="Email">
                <input type="password" name="password" placeholder="Password">
                <input type="submit" value="Log In" name="submit">
            </div>
        </form>
        <div class="message">
            <p>
                Already Registered? <a href="register.php">Sign up Here</a>
            </p>
        </div>
    </div>
</body>
</html>