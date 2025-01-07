<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Degree UPNM</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <header>
        <h1>File Management System</h1>
        <?php if (isset($_SESSION['user_id'])): ?>
            <nav>
                <a href="dashboard.php">Dashboard</a>
                <a href="logout.php">Logout</a>
            </nav>
        <?php endif; ?>
    </header>
