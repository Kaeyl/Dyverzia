<?php include "adminHeadTags.php"; ?>


<script type="text/javascript" src="includes/js/highlightBadWords.js"></script>


<body>

<nav>
    <div class="header-content">
        <h1>Admin Dashboard</h1>
        <input type="text" class="search-bar" placeholder="Search...">
        <div class="user-profile">
            <img src="user-icon.png" alt="User" class="profile-img">
        </div>
    </div>
</nav>

<div class="container">
    <div class="sidebar">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link active" href="#" data-page="mainDisplay.php">
                    <img src="./includes/images/dashboard.png" alt="Dashboard">
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-page="userManagement.php">
                    <img src="./includes/images/management.png" alt="User Management">
                    <span>User Management</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-page="contentModeration.php">
                    <img src="./includes/images/content.png" alt="Content Moderation">
                    <span>Content Moderation</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-page="analytics.php">
                    <img src="./includes/images/analytics.png" alt="Analytics">
                    <span>Analytics</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-page="settings.php">
                    <img src="./includes/images/settings.png" alt="Settings">
                    <span>Settings</span>
                </a>
            </li>
        </ul>
        <button class="collapse-button">
    <img src="./includes/images/arrow.png" alt="Toggle Navigation">
</button>
    </div>

    <main class="main-content">
        <div class="cards">
            <!-- Default loaded content -->
        </div>
        <div class="analytics-section">
            <h2>Analytics Overview</h2>

        </div>
        <div class="requests-section">
            <h2>New Requests</h2>
            <!-- Insert requests list here -->
        </div>

        <div id="postModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2 id="modalPostTitle"></h2>
        <p id="modalPostContent"></p>
    </div>
</div>

    </main>

    <footer>
        <small>&copy; 2024 Uniq. All rights reserved.</small>
    </footer>
</div>

<script>
// Select the collapse button and sidebar
const collapseButton = document.querySelector('.collapse-button');
const sidebar = document.querySelector('.sidebar');
const navLinks = document.querySelectorAll('.nav-link');

// Variable to track the expanding state
let isExpanding = false;

// Click event to collapse/expand the sidebar
collapseButton.addEventListener('click', () => {
    // If the sidebar is currently expanding, do not trigger again
    if (isExpanding) return;

    // Set expanding state to true
    isExpanding = true;

    // Toggle the collapsed class
    sidebar.classList.toggle('collapsed');

    // Reset the expanding state after a delay to allow transition to finish
    setTimeout(() => {
        isExpanding = false;
    }, 1000); // This should match your CSS transition duration
});

// Add click event to each nav link to highlight the active link
navLinks.forEach(link => {
    link.addEventListener('click', function() {
        navLinks.forEach(nav => nav.classList.remove('active')); // Remove active class from all links
        this.classList.add('active'); // Add active class to the clicked link
    });
});

</script>
<script type="text/javascript" src="includes/js/contentModal.js"></script>
<script type="text/javascript" src="includes/js/maintainPage.js"></script>
<script type="text/javascript" src="includes/js/navLinks.js"></script>


</body>






</html>
