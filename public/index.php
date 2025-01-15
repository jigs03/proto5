<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['role'] = $_POST['role'];
    header("Location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="navbar">
        <a href="#">SMART DEGREE UPNM</a>
    </div>
    <div class="container">
        <h1>Login</h1>
        <h2><img src="upnm.jpg" alt="upnm Icon" style="width:300px ; height:150px;"></h2>
        <form method="post">
            <select name="role" required>
                <option value="admin">Admin</option>
                <option value="Staf PPAP">Staf PPAP</option>
                <option value="Staf PAP">Staf PAP</option>
            </select>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
