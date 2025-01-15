<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
if ($data && isset($data['type']) && isset($data['content'])) {
    $filename = $data['type'] === 'upu' ? 'result.svg' : 'result2.svg';
    file_put_contents("../uploads/$filename", $data['content']);
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error']);
}
?>
