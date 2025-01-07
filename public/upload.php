<?php
session_start();
include '../config/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $uploadDir = '../uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $fileName = basename($_FILES['file']['name']);
    $targetFile = $uploadDir . $fileName;
    $fileType = $_FILES['file']['type'];
    $fileSize = $_FILES['file']['size'];
    $roleAccess = $_POST['role_access']; // Role selection from the form
    $uploaderId = $_SESSION['user_id'];

    if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)) {
        // Save file information in the database
        $stmt = $conn->prepare("INSERT INTO files (uploader_id, name, type, size, role_access) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issis", $uploaderId, $fileName, $fileType, $fileSize, $roleAccess);
        $stmt->execute();

        // Redirect back to the dashboard with success flag
        header("Location: dashboard.php?upload=success");
        exit;
    } else {
        echo "Error uploading file.";
    }
}
?>
