<div class="profileContentPanel">
            <?php if ($user_id == $_SESSION['user_id']) : ?>
                <!-- Check if the current user is viewing their own profile -->
                <div id="editProfileModal" class="modal">
                    <div class="modal-content">
                        <button class="close-button" onclick="hideModal()">&times;</button>
                        <!-- Button to close the edit profile modal -->
                        <div class="splitViewProfileUpdate">

                            <div class="contentContainerModal">
                                <h2>Edit Profile</h2>
                                <div class="updateProfileFormContainer">
                                    <form id="editProfileForm">
                                        <div class="fname">
                                            <label for="userfname">Name:</label>
                                            <input type="text" id="userfname" name="userfname" value="<?php echo htmlspecialchars($full_name); ?>" readonly>
                                            <!-- Display the user's full name as read-only -->
                                        </div>
                                        <div class="email">
                                            <label for="emailUpdate">Email:</label>
                                            <input type="text" id="emailUpdate" name="emailUpdate" value="<?php echo htmlspecialchars($user_profile_email); ?>" readonly>
                                            <!-- Display the user's email as read-only -->
                                        </div>
                                        <div class="userAdditionalInfromation">
                                            <label for="nuerodivergence">Nuerodivergence:</label>
                                            <input type="text" id="nuerodivergenceUpdate" name="nuerodivergence" value="<?php echo htmlspecialchars($nuerodivergence); ?>" readonly>

                                            <label for="pronouns">Pronouns:</label>
                                            <input type="text" id="pronounsUpdate" name="pronouns" value="<?php echo htmlspecialchars($pronouns); ?>" readonly>

                                            <label for="personalityTraits">Personality Traits:</label>
                                            <input type="text" id="personalityTraits" name="personalityTraits">

                                        </div>
                                    </div>
                                </div>
                                <div class="contentContainerModal">
                                    <h2>User hobbies and interests</h2>
                                    <div class="updateProfileFormContainer">

                                        <br>

                                        <div class="hobbiesList">
                                            <div class="hobbiesHeading">
                                            <h3>Your hobbies:</h3><br>
                                            </div>
                                            <div class="hobbiesListing">
                                            <ul>
                                                <?php foreach ($user_hobbies as $hobby) : ?>
                                                    <li><?php echo htmlspecialchars($hobby['hobby_name']); ?></li>
                                                    <!-- Loop through each hobby and display its name -->
                                                <?php endforeach; ?>
                                            </ul>

                                            </div>
                                        </div>
                                        <div class="extraAreaOfInterest">
                                            <h3>Your interests</h3>
                                                    <label for="hobbiesUpdate">Hobbies:</label>
                                                    <input type="text" id="hobbiesUpdate" name="hobbiesUpdate">
                                                    <!-- Input for adding or updating hobbies -->
                                                    <label for="areaofinterest">Area of interest:</label>
                                                    <input type="text" id="areaofinterest" name="areaofinterest">
                                                </div>
                                    </div>

                                    <input type="color">
                                </div>
                            </div>



                            <div class="profileEditButton">
                                <input id="profileUpdateSubmit" type="submit" value="Save Changes">
                                <!-- Button to save changes to the profile -->
                            </div>
                                    </form>
                                </div>
                            </div>
                        <?php endif; ?> <!-- End of checking if the user is viewing their own profile -->
