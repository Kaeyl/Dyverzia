window.onload = function() {
    const loginOverlay = document.querySelector('.overlay');
    const signupOverlay = document.querySelector('.signup-overlay');
    const mainContent = document.querySelector('.main-content');

    // Set initial visibility and z-index
    loginOverlay.style.opacity = '1'; // Show login overlay initially
    signupOverlay.style.opacity = '0'; // Hide signup overlay initially
    loginOverlay.style.zIndex = '2'; // Bring login overlay to the front
    signupOverlay.style.zIndex = '1'; // Push signup overlay back

    // Function to handle visibility changes
    const handleIntersect = (entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // Trigger animations when mainContent comes into view
                loginOverlay.style.transition = 'opacity 0.5s ease';
                signupOverlay.style.transition = 'opacity 0.5s ease';
                
                // Optionally, you can add more animations here

                // Unobserve after the first animation to prevent repeated triggers
                observer.unobserve(mainContent);
            }
        });
    };

    // Create an Intersection Observer
    const observer = new IntersectionObserver(handleIntersect);

    // Observe the mainContent
    observer.observe(mainContent);

    document.getElementById('switchToSignup').addEventListener('click', function(e) {
        e.preventDefault();
        const leftContainer = document.getElementById('login-container');
        const rightContainer = document.getElementById('signup-container');

        // Transition containers
        leftContainer.classList.remove('active');
        leftContainer.classList.add('inactive', 'left-inactive');
        rightContainer.classList.remove('inactive', 'right-inactive');
        rightContainer.classList.add('active', 'right-active');

        // Manage overlay visibility
        loginOverlay.style.opacity = '0'; // Hide login overlay
        signupOverlay.style.opacity = '1'; // Show sign-up overlay

        // Update z-index for overlays
        loginOverlay.style.zIndex = '1'; // Push login overlay back
        signupOverlay.style.zIndex = '2'; // Bring signup overlay front
    });

    document.getElementById('switchToLogin').addEventListener('click', function(e) {
        e.preventDefault();
        const leftContainer = document.getElementById('signup-container');
        const rightContainer = document.getElementById('login-container');

        // Transition containers
        leftContainer.classList.remove('active');
        leftContainer.classList.add('inactive', 'right-inactive');
        rightContainer.classList.remove('inactive', 'left-inactive');
        rightContainer.classList.add('active', 'left-active');

        // Manage overlay visibility
        loginOverlay.style.opacity = '1'; // Show login overlay
        signupOverlay.style.opacity = '0'; // Hide sign-up overlay

        // Update z-index for overlays
        loginOverlay.style.zIndex = '2'; // Bring login overlay front
        signupOverlay.style.zIndex = '1'; // Push signup overlay back
    });
};
