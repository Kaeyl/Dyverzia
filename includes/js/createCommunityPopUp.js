document.getElementById('createCommunityBtn').onclick = function() {
    document.getElementById('overlay').style.display = 'block';
    document.getElementById('createCommunityPopup').style.display = 'block'; // Corrected to match the popup ID
};

document.getElementById('closePopup').onclick = function() {
    document.getElementById('overlay').style.display = 'none';
    document.getElementById('createCommunityPopup').style.display = 'none'; // Ensure the correct popup ID
};

// Prevent closing the popup when clicking inside it
document.getElementById('createCommunityPopup').onclick = function(event) {
    event.stopPropagation(); // Prevent the event from bubbling up to the overlay
};

// Close the popup when clicking outside of it
document.getElementById('overlay').onclick = function() {
    document.getElementById('overlay').style.display = 'none';
    document.getElementById('createCommunityPopup').style.display = 'none'; // Ensure the correct popup ID
};
