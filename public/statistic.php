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
    <title>Statistic</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="navbar">
        <a href="dashboard.php">Dashboard</a>
        <a href="logout.php">Logout</a>
        <a href="statistic.php">Statistic</a>
    </div>
    <div class="container">
        <!-- First svg -->
        <h1>Results UPU</h1>
        <?php if ($role === 'admin'): ?>
            <input type="file" id="fileInput" accept=".svg" />
        <?php endif; ?>
        <div id="svgContainer"></div>

        <!-- Second Chart -->
        <h2>Results Asasi</h2>
        <?php if ($role === 'admin'): ?>
            <input type="file" id="fileInput2" accept=".svg" />
        <?php endif; ?>
        <div id="svgContainer2"></div>
    </div>

    <script>
        // First svg file
        document.getElementById('fileInput')?.addEventListener('change', function(event) {
            const file = event.target.files[0];
            
            // Check if the file is an SVG
            if (file && file.type === "image/svg+xml") {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    // Get the SVG content
                    const svgContent = e.target.result;

                    // Create a div to display the SVG
                    const svgContainer = document.getElementById('svgContainer');
                    svgContainer.innerHTML = svgContent;

                    // Create a download link
                    const downloadLink = document.createElement('a');
                    downloadLink.href = URL.createObjectURL(new Blob([svgContent], { type: 'image/svg+xml' }));
                    downloadLink.download = 'result.svg';  // Set the file name
                    downloadLink.textContent = 'Download SVG';
                    
                    // Append the download link to the container
                    svgContainer.appendChild(downloadLink);

                    // Save the SVG content to the server
                    fetch('save_svg.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ type: 'upu', content: svgContent })
                    });
                };
                
                reader.readAsText(file);
            } else {
                alert("Please upload a valid SVG file.");
            }
        });

        // Second svg file
        document.getElementById('fileInput2')?.addEventListener('change', function(event) {
            const file = event.target.files[0];
            
            // Check if the file is an SVG
            if (file && file.type === "image/svg+xml") {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    // Get the SVG content
                    const svgContent = e.target.result;

                    // Create a div to display the SVG
                    const svgContainer2 = document.getElementById('svgContainer2');
                    svgContainer2.innerHTML = svgContent;

                    // Create a download link
                    const downloadLink2 = document.createElement('a');
                    downloadLink2.href = URL.createObjectURL(new Blob([svgContent], { type: 'image/svg+xml' }));
                    downloadLink2.download = 'result2.svg';  // Set the file name
                    downloadLink2.textContent = 'Download SVG';
                    
                    // Append the download link to the container
                    svgContainer2.appendChild(downloadLink2);

                    // Save the SVG content to the server
                    fetch('save_svg.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ type: 'asasi', content: svgContent })
                    });
                };
                
                reader.readAsText(file);
            } else {
                alert("Please upload a valid SVG file.");
            }
        });

        // Load existing SVGs for staff
        window.addEventListener('load', function() {
            if ('<?php echo $role; ?>' !== 'admin') {
                fetch('get_svgs.php')
                    .then(response => response.json())
                    .then(data => {
                        if (data.upu) {
                            document.getElementById('svgContainer').innerHTML = data.upu;
                            const downloadLink = document.createElement('a');
                            downloadLink.href = 'uploads/result.svg';
                            downloadLink.download = 'result.svg';
                            downloadLink.textContent = 'Download SVG';
                            document.getElementById('svgContainer').appendChild(downloadLink);
                        } else {
                            document.getElementById('svgContainer').innerHTML = '<p>No SVG file uploaded.</p>';
                        }
                        if (data.asasi) {
                            document.getElementById('svgContainer2').innerHTML = data.asasi;
                            const downloadLink2 = document.createElement('a');
                            downloadLink2.href = 'uploads/result2.svg';
                            downloadLink2.download = 'result2.svg';
                            downloadLink2.textContent = 'Download SVG';
                            document.getElementById('svgContainer2').appendChild(downloadLink2);
                        } else {
                            document.getElementById('svgContainer2').innerHTML = '<p>No SVG file uploaded.</p>';
                        }
                    });
            }
        });
    </script>
</body>
</html>
