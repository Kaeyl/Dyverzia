document.getElementById('createPostBtn').onclick = function() {
    document.getElementById('overlay').style.display = 'block';
    document.getElementById('postPopup').style.display = 'block';
};

document.getElementById('closePopup').onclick = function() {
    document.getElementById('overlay').style.display = 'none';
    document.getElementById('postPopup').style.display = 'none';
};

// Prevent closing the popup when clicking inside it
document.getElementById('postPopup').onclick = function(event) {
    event.stopPropagation(); // Prevent the event from bubbling up to the overlay
};