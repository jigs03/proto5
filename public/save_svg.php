<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uploadDir = '../uploadsvg/';

    // Ensure the upload directory exists
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Handle UPU file upload
    if (isset($_FILES['file'])) {
        $file = $_FILES['file'];
        $fileType = pathinfo($file['name'], PATHINFO_EXTENSION);

        if ($fileType === 'svg') {
            $uploadFile = $uploadDir . 'result.svg';
            if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
                header("Location: statistic.php?success=1");
                exit;
            } else {
                header("Location: statistic.php?error=1");
                exit;
            }
        } else {
            header("Location: statistic.php?error=2");
            exit;
        }
    }

    // Handle Asasi file upload
    if (isset($_FILES['file2'])) {
        $file = $_FILES['file2'];
        $fileType = pathinfo($file['name'], PATHINFO_EXTENSION);

        if ($fileType === 'svg') {
            $uploadFile = $uploadDir . 'result2.svg';
            if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
                header("Location: statistic.php?success=2");
                exit;
            } else {
                header("Location: statistic.php?error=3");
                exit;
            }
        } else {
            header("Location: statistic.php?error=4");
            exit;
        }
    }
}
?>
