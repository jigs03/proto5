<?php
session_start();
if (!isset($_SESSION['role'])) {
    header("Location: index.php");
    exit;
}
$role = $_SESSION['role'];
include '../config/db_connect.php';

// Pagination settings
$filesPerPage = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $filesPerPage;

// Fetch files for admin or staff
if ($role === 'admin') {
    $result = $conn->query("SELECT * FROM files WHERE target_role = 'admin' AND is_deleted = 0 LIMIT $filesPerPage OFFSET $offset");
    $totalFiles = $conn->query("SELECT COUNT(*) as total FROM files WHERE target_role = 'admin' AND is_deleted = 0")->fetch_assoc()['total'];
} else {
    $stmt = $conn->prepare("SELECT * FROM files WHERE (target_role = ? OR target_role = 'all') AND is_deleted = 0 LIMIT ? OFFSET ?");
    $stmt->bind_param("sii", $role, $filesPerPage, $offset);
    $stmt->execute();
    $result = $stmt->get_result();
    $totalFiles = $conn->query("SELECT COUNT(*) as total FROM files WHERE (target_role = '$role' OR target_role = 'all') AND is_deleted = 0")->fetch_assoc()['total'];
}
$totalPages = ceil($totalFiles / $filesPerPage);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="navbar">
        <a href="dashboard.php">Dashboard</a>
        <a href="logout.php">Logout</a>
        <a href="statistic.php">Statistic</a>
    </div>
    <div class="container">
        <h1>Welcome, <?php echo $role; ?></h1>

        <?php if (isset($_GET['upload']) && $_GET['upload'] === 'success'): ?>
            <div class="notification success">File uploaded successfully!</div>
        <?php elseif (isset($_GET['upload']) && $_GET['upload'] === 'error'): ?>
            <div class="notification error">Failed to upload file.</div>
        <?php endif; ?>

        <?php if (isset($_GET['download']) && $_GET['download'] === 'success'): ?>
            <div class="notification success">File downloaded successfully!</div>
        <?php elseif (isset($_GET['download']) && $_GET['download'] === 'error'): ?>
            <div class="notification error">Failed to download file.</div>
        <?php endif; ?>

        <?php if ($role === 'admin'): ?>
            <h2>Files Uploaded by Staff</h2>
            <ul>
                <?php
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<li>
                                <a href='download.php?file={$row['path']}'>Download {$row['name']}</a>
                                <form action='delete_file.php' method='post' style='display:inline;'>
                                    <input type='hidden' name='file_id' value='{$row['id']}'>
                                    <button type='submit'>Delete</button>
                                </form>
                              </li>";
                    }
                } else {
                    echo "<li>No files available.</li>";
                }
                ?>
            </ul>

            <h2>Upload Files for Staff</h2>
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <input type="file" name="file" required>
                <select name="target_role">
                    <option value="Staf PPAP">Staf PPAP</option>
                    <option value="Staf PAP">Staf PAP</option>
                    <option value="all">All Staff</option>
                </select>
                <button type="submit" class="upload-btn">Upload</button>
            </form>
        <?php else: ?>
            <h2>Files Uploaded by Admin</h2>
            <ul>
                <?php
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<li><a href='download.php?file={$row['path']}'>Download {$row['name']}</a>
                                <form action='delete_file.php' method='post' style='display:inline;'>
                                    <input type='hidden' name='file_id' value='{$row['id']}'>
                                    <button type='submit'>Delete</button>
                                </form>
                              </li>";
                    }
                } else {
                    echo "<li>No files available.</li>";
                }
                ?>
            </ul>

            <h2>Upload Files for Admin</h2>
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <input type="file" name="file" required>
                <input type="hidden" name="target_role" value="admin">
                <button type="submit" class="upload-btn">Upload</button>
            </form>
        <?php endif; ?>

        <!-- Pagination Controls -->
        <div class="pagination">
            <?php
            for ($i = 1; $i <= $totalPages; $i++) {
                echo "<a href='dashboard.php?page=$i'>" . ($i === $page ? "<strong>$i</strong>" : $i) . "</a> ";
            }
            ?>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 SMART DEGREE UPNM</p>
    </footer>

    <script>
        // Hide notifications after 3 seconds
        setTimeout(() => {
            const notifications = document.querySelectorAll('.notification');
            notifications.forEach(notification => notification.style.display = 'none');
        }, 3000);
    </script>
</body>
</html>
