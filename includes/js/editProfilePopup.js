
function showModal() {
    document.getElementById("editProfileModal").style.display = "block";
}

function hideModal() {
    document.getElementById("editProfileModal").style.display = "none";
}

// Close modal when clicking outside of the modal content
window.onclick = function(event) {
    const modal = document.getElementById("editProfileModal");
    if (event.target === modal) {
        hideModal();
    }
}



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