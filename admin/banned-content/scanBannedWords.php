<?php
// $filename = "hateful_words.txt";
// Function to load hateful words from a text file
function load_hateful_words($filename) {
    if (!file_exists($filename)) {
        return []; // Return an empty array if the file doesn't exist
    }
    // Read the file and create an array of words
    return array_map('trim', file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES));
}

// Load hateful words from the text file
$hateful_words = load_hateful_words('hateful_words.txt');

// Create a regex pattern from the hateful words
$pattern = '/\b(?:' . implode('|', array_map('preg_quote', $hateful_words)) . ')\b/i';

function scan_post($post) {
    global $pattern;
    return preg_match($pattern, $post);
}

// Example usage
$user_post = "This is an example post containing "; // Sample user input

if (scan_post($user_post)) {
    echo "Your post contains hateful content and cannot be submitted.";
} else {
    echo "Your post is acceptable.";
}
?>