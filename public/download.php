<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['role'])) {
    header("Location: index.php");
    exit;
}

// Check if the file parameter exists
if (!isset($_GET['file']) || empty($_GET['file'])) {
    die("No file specified.");
}

// Set the upload directory
$uploadDir = '../uploads/';
$requestedFile = basename($_GET['file']); // Prevent directory traversal
$filePath = $uploadDir . $requestedFile;

// Verify if the file exists in the directory
if (!file_exists($filePath)) {
    die("The requested file does not exist.");
}

// Force download
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . $requestedFile . '"');
header('Content-Length: ' . filesize($filePath));
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Expires: 0');

// Clear the output buffer and read the file
flush();
readfile($filePath);
exit;
?>
