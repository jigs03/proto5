<?php
include '../config/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fileId = $_POST['file_id'];

    $stmt = $conn->prepare("UPDATE files SET is_deleted = 0 WHERE id = ?");
    $stmt->bind_param("i", $fileId);

    if ($stmt->execute()) {
        header("Location: dashboard.php?restore=success");
    } else {
        header("Location: dashboard.php?restore=error");
    }
}
?>
