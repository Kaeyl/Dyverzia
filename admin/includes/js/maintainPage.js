document.addEventListener('DOMContentLoaded', function() {
    const links = document.querySelectorAll('.nav-link');

    // Function to set the active link
    function setActiveLink(page) {
        links.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('data-page') === page) {
                link.classList.add('active');
            }
        });
    }

    links.forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            const page = this.getAttribute('data-page');

            // Save the page in localStorage
            localStorage.setItem('lastVisitedPage', page);

            // Set the active link
            setActiveLink(page);

            // Use fetch API to load new content
            fetch(`functions/${page}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.text();
                })
                .then(data => {
                    // Replace the content inside <main> with the fetched content
                    document.querySelector('.main-content').innerHTML = data;
                })
                .catch(error => {
                    // Handle error gracefully
                    document.querySelector('.main-content').innerHTML = `<p>Error loading page: ${error.message}</p>`;
                });
        });
    });

    // Load the last visited page or default content on initial load
    const lastVisitedPage = localStorage.getItem('lastVisitedPage') || 'mainDisplay.php';
    loadPage(lastVisitedPage);
    setActiveLink(lastVisitedPage); // Set active link based on last visited page

    function loadPage(page) {
        fetch(`functions/${page}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text();
            })
            .then(data => {
                document.querySelector('.main-content').innerHTML = data;
            })
            .catch(error => {
                document.querySelector('.main-content').innerHTML = `<p>Error loading default page: ${error.message}</p>`;
            });
    }
});
