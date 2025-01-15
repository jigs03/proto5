<?php
session_start();
if (!isset($_SESSION['role']) || ($_SESSION['role'] !== 'Staf PPAP' && $_SESSION['role'] !== 'Staf PAP')) {
    header("Location: index.php");
    exit;
}

$response = [
    'upu' => file_exists('../uploads/result.svg') ? file_get_contents('../uploads/result.svg') : null,
    'asasi' => file_exists('../uploads/result2.svg') ? file_get_contents('../uploads/result2.svg') : null
];

echo json_encode($response);
?>
