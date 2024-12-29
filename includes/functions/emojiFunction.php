<div id="emojiModal" class="modal">
    <div class="modal-content">
        <span class="close-button" id="closeModal">&times;</span>
        <h4>Select your mood:</h4>

        <?php 
        // Query the database to retrieve all moods with their details
        $query = "SELECT mood_name, emoji FROM mood_options ORDER BY mood_name ASC";
        $result = $connection->query($query);

        // Check if there are results
        if ($result->num_rows > 0) {
            // Loop through each mood and create a button
            while ($row = $result->fetch_assoc()) {
                $moodName = htmlspecialchars($row['mood_name'], ENT_QUOTES, 'UTF-8');
                $emoji = htmlspecialchars($row['emoji'], ENT_QUOTES, 'UTF-8');
                echo "<button type='button' class='emoji-button' value='$moodName'>$emoji $moodName</button>";
            }
        } else {
            echo "<p>No moods available. Please add moods to the database.</p>";
        }
        ?>

        <input type="hidden" id="moodSelector" name="mood" value="">
    </div>
</div>
