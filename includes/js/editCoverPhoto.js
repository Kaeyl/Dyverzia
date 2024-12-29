
function showCoverPhotoModal() {
    document.getElementById("editCoverPhotoModal").style.display = "block";
}

function hideCoverPhotoModal() {
    document.getElementById("editCoverPhotoModal").style.display = "none";
}

// Close modal when clicking outside of the modal content
window.onclick = function(event) {
    const modal = document.getElementById("editCoverPhotoModal");
    if (event.target === modal) {
        hideModal();
    }
}