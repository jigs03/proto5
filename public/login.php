<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['role'])) {
    $role = $_POST['role'];

    // Save the role in session and redirect to the dashboard
    $_SESSION['role'] = $role;
    $_SESSION['username'] = $role; // Set username as role (optional)
    header("Location: dashboard.php");
    exit;
}
?>
