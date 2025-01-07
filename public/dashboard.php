<?php
session_start();

if (!isset($_SESSION['role'])) {
    header("Location: index.php");
    exit;
}

$role = $_SESSION['role'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css"> <!-- Link to external CSS -->
</head>
<body>
    <header>
        <h1>Welcome, <?php echo $role; ?></h1>
        <div style="display: flex; justify-content: center; gap: 1rem; margin-top: 0.5rem;">
            <button class="back-btn" onclick="history.back()">← Back</button>
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>
    </header>

    <div class="container">
        <?php
        include '../config/db_connect.php';

        // Check if upload was successful and pass a flag to JavaScript
        $popupMessage = "";
        $popupType = ""; // Can be 'success' or 'error'
        if (isset($_GET['upload'])) {
            if ($_GET['upload'] === 'success') {
                $popupMessage = "File uploaded successfully!";
                $popupType = "success";
            } elseif ($_GET['upload'] === 'error') {
                $popupMessage = "Failed to upload file.";
                $popupType = "error";
            }
        }
        ?>

        <!-- Popup Notification -->
        <div class="popup" id="popup"></div>

        <?php if ($role === 'admin'): ?>
            <!-- Admin Dashboard -->
            <h2>Admin Dashboard</h2>

            <!-- Files Uploaded by Users -->
            <h3>Files Uploaded by Users</h3>
            <ul>
                <?php
                $result = $conn->query("SELECT * FROM files");
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<li><a href='download.php?file={$row['name']}'>{$row['name']}</a></li>";
                    }
                } else {
                    echo "<li>No files uploaded yet.</li>";
                }
                ?>
            </ul>

            <!-- Upload Form -->
            <h3>Upload a File for Users</h3>
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <input type="file" name="file" required>
                <select name="role_access">
                    <option value="Staf PPAP">Staf PPAP</option>
                    <option value="Staf PAP">Staf PAP</option>
                    <option value="all">All</option> <!-- For both roles -->
                </select>
                <button type="submit">Upload</button>
            </form>
        <?php else: ?>
            <!-- Staf PPAP or Staf PAP Dashboard -->
            <h2><?php echo $role; ?> Dashboard</h2>

            <!-- Files Available for the Role -->
            <h3>Files Available for You</h3>
            <ul>
                <?php
                $stmt = $conn->prepare("SELECT * FROM files WHERE role_access = ? OR role_access = 'all'");
                $stmt->bind_param("s", $role);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<li><a href='../uploads/{$row['name']}' download>{$row['name']}</a></li>";
                    }
                } else {
                    echo "<li>No files available for you yet.</li>";
                }
                ?>
            </ul>

            <!-- Upload Form -->
            <h3>Upload a File</h3>
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <input type="file" name="file" required>
                <input type="hidden" name="role_access" value="admin">
                <button type="submit">Upload</button>
            </form>
        <?php endif; ?>
    </div>

    <footer>
        <p>&copy; 2025 SMART DEGREE UPNM</p>
    </footer>

    <!-- Pass PHP variables to JavaScript -->
    <script>
        const popupMessage = "<?php echo $popupMessage; ?>";
        const popupType = "<?php echo $popupType; ?>";
    </script>
    <script src="script.js"></script> <!-- Link to external JavaScript -->
</body>
</html>
