<?php
include '../config/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fileId = $_POST['file_id'];

    $stmt = $conn->prepare("DELETE FROM files WHERE id = ?");
    $stmt->bind_param("i", $fileId);

    if ($stmt->execute()) {
        header("Location: dashboard.php?delete=success");
    } else {
        header("Location: dashboard.php?delete=error");
    }
}
?>


