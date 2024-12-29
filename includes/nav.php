<?php include "./includes/db.php"; ?>
<!-- <?php session_start(); ?> -->

<nav>
    <div class="nvaElements">
        <!-- Burger Menu Icon -->
        <div class="burger-menu" onclick="toggleNav()">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
        <ul class="nav_links" id="navLinks">
            <div class="leftContent">
                <li class="logo">
                    <a href="index.php">
                        <img id="logoImage" src="includes/images/Dyverzia.jpg" alt="Dyverzia logo">
                    </a>
                </li>
                <input id="searchBar" type="text" placeholder="Search..">
            </div>
            <li><a href="index.php"><img src="includes/images/icons/home.png" alt="home"></a></li>
            <li><a href="resources.php"><img src="includes/images/icons/search.png" alt="resources"></a></li>
            <li><a href="findFriends.php"><img src="includes/images/icons/add-group.png" alt="add group"></a></li>
            <li><a href="findCommunities.php"><img src="includes/images/icons/community.png" alt="menu"></a></li>

            <?php
            // Fetch notifications count
            $notification_count = 0;
            $notifications = [];
            if (isset($_SESSION['user_id'])) {
                $user_id = $_SESSION['user_id'];
                
                // Fetch unread notifications count
                $query = "SELECT COUNT(*) AS count FROM user_notifications WHERE user_id = '" . mysqli_real_escape_string($connection, $user_id) . "' AND is_read = 0";
                $result = mysqli_query($connection, $query);
                if ($result) {
                    $row = mysqli_fetch_assoc($result);
                    $notification_count = $row['count'];
                }

                // Fetch all notifications
                $query_notifications = "SELECT * FROM user_notifications WHERE user_id = '" . mysqli_real_escape_string($connection, $user_id) . "' ORDER BY created_at DESC";
                $result_notifications = mysqli_query($connection, $query_notifications);
                if ($result_notifications) {
                    while ($row = mysqli_fetch_assoc($result_notifications)) {
                        $notifications[] = $row;
                    }
                }
            }
            ?>

            <li>
                <a href="#" id="notificationDropdownBtn" onclick="toggleDropdown()">
                    <img src="includes/images/icons/bell.png" alt="notifications" class="<?php echo $notification_count > 0 ? 'highlight' : ''; ?>">
                    <?php if ($notification_count > 0): ?>
                        <span class="notification-count"><?php echo $notification_count; ?></span>
                    <?php endif; ?>
                </a>
                <div id="notificationDropdown" class="notification-dropdown-content" style="display: none;">
                    <?php if (empty($notifications)): ?>
                        <p>No notifications.</p>
                    <?php else: ?>
                        <?php foreach ($notifications as $notification): ?>
                            <div class="notification-item">
                                <p><?php echo htmlspecialchars($notification['message']); ?></p>
                                <small><?php echo date('Y-m-d H:i:s', strtotime($notification['created_at'])); ?></small>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </li>

            <?php if (!isset($_SESSION['given_name'])): ?>
                <li><a href='login_page.php'>Log in</a></li>
            <?php else: ?>
                <div class="dropdown">
                <button onclick="toggleDropdownSettings()" class="dropbtn" id="dropDownButton" style="background:white;">
                    <?php
                    $username = $_SESSION['given_name'];
                    $query = "SELECT * FROM user_profile WHERE user_id = '" . mysqli_real_escape_string($connection, $_SESSION['user_id']) . "'";
                    $select_user_query = mysqli_query($connection, $query);
                    if ($row = mysqli_fetch_assoc($select_user_query)) {
                        $user_profile_image = $row['profile_picture'];
                        $user_uniq_surname = $row['uniq_username'];
                    ?>
                        <img class="dropbtn" src="./includes/images/<?php echo htmlspecialchars($user_profile_image); ?>" alt="more options">
                    <?php } ?>
                </button>
                <div id="myDropdown" class="dropdown-content">
    <a href="./profile.php?profile-page=<?php echo urlencode($user_uniq_surname); ?>">Profile</a>
    
    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'verified'): ?>
        <a href="">Publish resources</a>
    <?php endif; ?>
    
    <a href="#">Settings</a>
    <a href="#">Feedback</a>
    <hr id="dropDownHr">
    <a href="./includes/logout.php">Log Out</a>
</div>
            </div>
            <?php endif; ?>
        </ul>
    </div>
</nav>

<label class="labelHide" for="searchBar" style="display: table-column;">Search</label>
<script type="text/javascript" src="includes/js/toggleDrop.js"></script>
<script type="text/javascript" src="includes/js/burger.js"></script>


<script>
function toggleDropdownSettings() {
    const dropdownContent = document.getElementById("myDropdown");
    dropdownContent.classList.toggle("show");
}</script>