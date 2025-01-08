<?php
include '../config/db_connect.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $filePath = '../uploads/' . $fileName;
    $uploaderRole = $_SESSION['role'];
    $targetRole = $_POST['target_role'];

    if (move_uploaded_file($fileTmpName, $filePath)) {
        $stmt = $conn->prepare("INSERT INTO files (uploader_role, name, path, target_role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $uploaderRole, $fileName, $filePath, $targetRole);

        if ($stmt->execute()) {
            header("Location: dashboard.php?upload=success");
        } else {
            header("Location: dashboard.php?upload=error");
        }
    } else {
        header("Location: dashboard.php?upload=error");
    }
}
?>
