// JavaScript for Popup Notifications
document.addEventListener("DOMContentLoaded", () => {
    if (popupMessage) {
        const popup = document.getElementById("popup");
        popup.textContent = popupMessage;
        popup.classList.add(popupType === "success" ? "success" : "error");
        popup.style.display = "block";

        // Hide popup after 3 seconds
        setTimeout(() => {
            popup.style.display = "none";
        }, 3000);
    }
});
