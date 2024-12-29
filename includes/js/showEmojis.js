document.addEventListener("DOMContentLoaded", function() {
    const modal = document.getElementById("emojiModal");
    const chooseMoodButton = document.getElementById("chooseMoodButton");
    const closeModalButton = document.getElementById("closeModal");

    chooseMoodButton.addEventListener("click", function() {
        modal.style.display = "block";
    });

    closeModalButton.addEventListener("click", function() {
        modal.style.display = "none";
    });

    window.addEventListener("click", function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    });

    document.querySelectorAll('.emoji-button').forEach(button => {
        button.addEventListener('click', function() {
            const selectedMood = this.value;
            document.getElementById('moodSelector').value = selectedMood;
            modal.style.display = "none";
            console.log(`Selected mood: ${selectedMood}`);
        });
    });
});