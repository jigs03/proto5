<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>SMART DEGREE UPNM</h1>
    </header>
    <form action="login.php" method="post">
        <h2>Login</h2>
        <button type="submit" name="role" value="admin">Login as Admin</button>
        <button type="submit" name="role" value="Staf PPAP">Login as Staf PPAP</button>
        <button type="submit" name="role" value="Staf PAP">Login as Staf PAP</button>
    </form>
    <footer>
        <p>&copy; 2025 SMART DEGREE UPNM</p>
    </footer>
</body>
</html>

