const hatefulWords = ['hate', 'violence', 'bigot',' cunt'];

function highlightHatefulWords(content) {
    if (!content) return ''; // Early return if content is undefined
    let pattern = new RegExp('\\b(?:' + hatefulWords.map(word => word.replace(/[-\/\\^$.*+?()[\]{}|]/g, '\\$&')).join('|') + ')\\b', 'gi');
    return content.replace(pattern, '<span style="background-color: yellow;">$&</span>');
}

function showCoverPhotoModal(event) {
    console.log("Modal trigger clicked");
    event.preventDefault();
    
    const title = event.currentTarget.getAttribute("data-title");
    const content = event.currentTarget.getAttribute("data-content");

    console.log('Title:', title);
    console.log('Content:', content);

    if (!content) {
        console.error('Content is undefined');
        return; 
    }

    const highlightedContent = highlightHatefulWords(content);
    console.log('Original content:', content);
    console.log('Highlighted content:', highlightedContent);

    document.body.innerHTML += `<div>${highlightedContent}</div>`;
}

// Attach event listener
document.querySelectorAll('.viewPost').forEach(item => {
    item.addEventListener('click', showCoverPhotoModal);
});
