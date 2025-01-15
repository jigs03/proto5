<?php
session_start();

if (!isset($_GET['file'])) {
    header("Location: dashboard.php?download=error");
    exit;
}

$filePath = '../uploads/' . basename($_GET['file']);

if (file_exists($filePath)) {
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
    readfile($filePath);
    exit;
} else {
    header("Location: dashboard.php?download=error");
    exit;
}
?>
