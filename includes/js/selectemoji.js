
// // JavaScript to toggle emoji selector visibility
// document.getElementById('chooseMoodButton').addEventListener('click', function() {
//     const emojiSelector = document.getElementById('emojiSelector');
//     if (emojiSelector.style.display === "none") {
//         emojiSelector.style.display = "block"; // Show emojis
//     } else {
//         emojiSelector.style.display = "none"; // Hide emojis
//     }
// });

// // Event listener for emoji buttons
// document.querySelectorAll('.emoji-button').forEach(button => {
//     button.addEventListener('click', function() {
//         const selectedMood = this.value; // Get the value of the clicked emoji
//         console.log(`Selected mood: ${selectedMood}`);
        
//         // Update the hidden input with the selected mood
//         document.getElementById('moodSelector').value = selectedMood;

//         // Optional: Highlight the selected emoji
//         document.querySelectorAll('.emoji-button').forEach(btn => {
//             btn.classList.remove('selected'); // Remove selection from all buttons
//         });
//         this.classList.add('selected'); // Highlight the selected emoji button
//     });
// });

