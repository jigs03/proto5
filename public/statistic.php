<?php
session_start();
if (!isset($_SESSION['role'])) {
    header("Location: index.php");
    exit;
}
$role = $_SESSION['role'];

// File paths
$uploadDir = '../uploadsvg/';
$fileUpu = $uploadDir . 'result.svg';
$fileAsasi = $uploadDir . 'result2.svg';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistic</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="navbar">
        <a href="dashboard.php">Dashboard</a>
        <a href="logout.php">Logout</a>
        <a href="statistic.php">Statistic</a>
    </div>
    <div class="container">
        <?php
        // Display success or error messages
        if (isset($_GET['success'])) {
            echo "<p style='color: green;'>File uploaded successfully.</p>";
        }
        if (isset($_GET['error'])) {
            $errorMessages = [
                1 => "Failed to upload UPU file.",
                2 => "Invalid file type for UPU.",
                3 => "Failed to upload Asasi file.",
                4 => "Invalid file type for Asasi.",
            ];
            $errorCode = (int)$_GET['error'];
            if (isset($errorMessages[$errorCode])) {
                echo "<p style='color: red;'>{$errorMessages[$errorCode]}</p>";
            }
        }
        ?>
        <!-- First SVG -->
        <h1>Results UPU</h1>
        <?php if ($role === 'admin'): ?>
            <form action="save_svg.php" method="POST" enctype="multipart/form-data">
                <input type="file" name="file" accept=".svg" />
                <button type="submit">Upload</button>
            </form>
        <?php endif; ?>

        <div>
            <?php if (file_exists($fileUpu)): ?>
                <div><?php echo file_get_contents($fileUpu); ?></div>
                <?php if ($role !== 'admin'): ?>
                    <a href="<?php echo $fileUpu; ?>" download="result.svg">Download SVG</a>
                <?php endif; ?>
            <?php else: ?>
                <p>No UPU SVG file found.</p>
            <?php endif; ?>
        </div>

        <!-- Second SVG -->
        <h2>Results Asasi</h2>
        <?php if ($role === 'admin'): ?>
            <form action="save_svg.php" method="POST" enctype="multipart/form-data">
                <input type="file" name="file2" accept=".svg" />
                <button type="submit">Upload</button>
            </form>
        <?php endif; ?>

        <div>
            <?php if (file_exists($fileAsasi)): ?>
                <div><?php echo file_get_contents($fileAsasi); ?></div>
                <?php if ($role !== 'admin'): ?>
                    <a href="<?php echo $fileAsasi; ?>" download="result2.svg">Download SVG</a>
                <?php endif; ?>
            <?php else: ?>
                <p>No Asasi SVG file found.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
