document.addEventListener("DOMContentLoaded", function() {
    const successMessage = document.getElementById("success-message");
    if (successMessage) {
        setTimeout(() => {
            successMessage.style.display = "none";
        }, 3000);
    }
});
