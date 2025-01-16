document.addEventListener('DOMContentLoaded', () => {
    // Display Popup Notification
    function showNotification(message) {
        const notification = document.getElementById('notification');
        if (notification) {
            notification.textContent = message;
            notification.style.display = 'block'; // Make the notification visible
            setTimeout(() => {
                notification.style.display = 'none'; // Hide it after 3 seconds
            }, 6000); // 3 seconds timeout
        } else {
            console.error('Notification element not found');
        }
    }

    // Check for upload or download status in the URL
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('upload')) {
        const uploadStatus = urlParams.get('upload');
        if (uploadStatus === 'success') {
            showNotification('File uploaded successfully!');
        } else if (uploadStatus === 'error') {
            showNotification('Failed to upload file.');
        }
    }

    if (urlParams.has('download')) {
        const downloadStatus = urlParams.get('download');
        if (downloadStatus === 'success') {
            showNotification('File downloaded successfully!');
        } else if (downloadStatus === 'error') {
            showNotification('Failed to download file.');
        }
    }
});
