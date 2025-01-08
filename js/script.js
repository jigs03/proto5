// Display Popup Notification
function showNotification(message) {
    const notification = document.getElementById('notification');
    notification.textContent = message;
    notification.style.display = 'block';
    setTimeout(() => {
        notification.style.display = 'none';
    }, 3000);
}

// Check for upload or download status in the URL
const urlParams = new URLSearchParams(window.location.search);
if (urlParams.has('upload')) {
    if (urlParams.get('upload') === 'success') {
        showNotification('File uploaded successfully!');
    } else if (urlParams.get('upload') === 'error') {
        showNotification('Failed to upload file.');
    }
}

if (urlParams.has('download')) {
    if (urlParams.get('download') === 'success') {
        showNotification('File downloaded successfully!');
    } else if (urlParams.get('download') === 'error') {
        showNotification('Failed to download file.');
    }
}
