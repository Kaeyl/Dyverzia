<!-- Conditionally render the edit cover photo modal -->
<?php if ($permission_type == 1) : ?>
    <div id="editCoverPhotoModal" class="modal">
        <div class="modal-content">
            <button class="close-button" onclick="hideCoverPhotoModal()">&times;</button>
            <div class="contentContainerModal">
                <h2>Edit Photo</h2>
                <div class="updateCoverPhotoFormContainer">
                    <form id="editcoverPhotoForm" method="post" enctype="multipart/form-data">
                        <div class="uploadCoverPhoto">
                            <label for="community_cover_photo_update">Upload Image:</label>
                            <input type="file" id="user_upload_pic" name="community_cover_photo_update" accept=".jpg, .jpeg, .png" size="60" />
                        </div>
                        <button type="submit" value="Save Changes" class="submitCoverPhotoChange" id="submitCoverPhotoChange" name="updateCover">Submit</button>
                        <label for="user_upload_pic" class="labelHide">Select the image you want to upload</label><br>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php
// Check if a file was uploaded
if (isset($_FILES['community_cover_photo_update']) && $_FILES['community_cover_photo_update']['error'] === UPLOAD_ERR_OK) {
    // Define the target path for the upload
    $target_dir = "./includes/images/";
    
    // Generate a unique file name
    $target_file = $target_dir . uniqid() . '_' . basename($_FILES['community_cover_photo_update']['name']);
    
    // Ensure the target directory is writable
    if (!is_writable($target_dir)) {
        die("Upload directory is not writable. Please check permissions.");
    }

    // Move the uploaded file to the target directory
    if (move_uploaded_file($_FILES['community_cover_photo_update']['tmp_name'], $target_file)) {
        // Update the cover photo in the user profile
        $cleanedPath = basename($target_file); // Use the unique file name
        $query = "UPDATE communities SET cover_picture = '{$cleanedPath}' WHERE community_id = {$community_id}";
        $update_query = mysqli_query($connection, $query);
        if (!$update_query) {
            die("QUERY FAILED: " . mysqli_error($connection));
        }
        
        // Fetch the updated user's uniq_username
        $profile_query = "SELECT uniq_username FROM user_profile WHERE user_id = {$user_id}";
        $profile_result = mysqli_query($connection, $profile_query);
        
        if ($profile_row = mysqli_fetch_assoc($profile_result)) {
            $uniq_username = $profile_row['uniq_username'];
            // Redirect to the community page or the appropriate location



        } else {
            die("User not found.");
        }
    } else {
        die("File upload failed.");
    }
}
?>
