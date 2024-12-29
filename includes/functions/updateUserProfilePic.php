<?php if ($user_id == $_SESSION['user_id']) : ?>
    <div id="editProfileImageModal" class="modal">
        <div class="modal-content">
            <button class="close-button" onclick="hideProfileImageModal()">&times;</button>
            <div class="contentContainerModal">
                <h2>Edit Profile Picture</h2>
                <div class="updateProfileImageFormContainer">
                    <form id="editProfileImageForm" method="post" enctype="multipart/form-data">
                        <div class="uploadProfileImage">
                            <label for="user_profile_image">Upload Image:</label>
                            <input type="file" id="user_profile_image" name="profile_picture" accept=".jpg, .jpeg, .png" size="60" />
                        </div>
                        <button type="submit" value="Save Changes" class="submitProfileImageChange" id="submitProfileImageChange" name="updateProfileImage">Submit</button>
                        <label for="user_profile_image" class="labelHide">Select the image you want to upload</label><br>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>




<?php
// Check if a file was uploaded for the profile image
if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
    // Define the target path for the upload
    $target_dir = "./includes/images/";

    // Generate a unique file name
    $target_file = $target_dir . uniqid() . '_' . basename($_FILES['profile_picture']['name']);

    // Ensure the target directory is writable
    if (!is_writable($target_dir)) {
        die("Upload directory is not writable. Please check permissions.");
    }

    // Move the uploaded file to the target directory
    if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_file)) {
        // Update the profile image in the user profile
        $cleanedPath = basename($target_file); // Use the unique file name
        $query = "UPDATE user_profile SET profile_picture = '{$cleanedPath}' WHERE user_id = {$user_id}";
        $update_query = mysqli_query($connection, $query);

        if (!$update_query) {
            die("QUERY FAILED: " . mysqli_error($connection));
        } else {
            // Optionally, you can provide feedback to the user
            echo "Profile picture updated successfully!";
        }
    } else {
        die("File upload failed.");
    }
}
?>
