function highlightHatefulWords() {
    const badWords = JSON.parse(event.target.getAttribute('data-badWords'));
    console.log('Bad Words:', badWords);
    // Further processing to highlight these words in your content
}

function showCoverPhotoModal(event) {
    event.preventDefault(); // Prevent the default anchor click behavior
    const modal = document.getElementById("editCoverPhotoModal");

    // Get attributes from the clicked item
    const title = event.currentTarget.getAttribute("data-title");
    const content = event.currentTarget.getAttribute("data-content");
    const hatefulWordsJson = event.currentTarget.getAttribute("data-badWords");
    
    // Parse the JSON string to get the array of hateful words
    const hatefulWords = JSON.parse(hatefulWordsJson);

    // Set modal content
    modal.querySelector('.contentContainerModal h2').innerText = title; // Set title in modal
    modal.querySelector('#modalContent').innerText = content; // Set content in modal
    
    // Display the hateful words in a readable format
    modal.querySelector('#badWords').innerText = hatefulWords.length > 0 ? hatefulWords.join(', ') : 'No hateful words found';

    modal.style.display = "block"; // Show the modal
}

function hideCoverPhotoModal() {
    const modal = document.getElementById("editCoverPhotoModal");
    modal.style.display = "none"; // Hide the modal
}

// Close modal when clicking outside of the modal content
window.onclick = function(event) {
    const modal = document.getElementById("editCoverPhotoModal");
    if (event.target === modal) {
        hideCoverPhotoModal();
    }
}