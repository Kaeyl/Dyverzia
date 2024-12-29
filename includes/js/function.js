
    // function toggleActiveClass() {
        // Get all elements with class 'container'
        var divs = document.getElementsByClassName('container');
        // Get the element with class 'containerSignUp'
        var divSignUp = document.getElementsByClassName('containerSignUp')[0];
    
        // Add click event listener to the signUp button
        document.getElementById('signUp').addEventListener('click', function(event) {
            // Prevent event bubbling
            event.stopPropagation();
    
            // Use forEach to loop through all 'container' elements
            Array.prototype.forEach.call(divs, function(div) {
                // Remove 'active' class and add 'inactive' class to all 'container' elements
                div.classList.remove('active');
                div.classList.add('inactive');
            });
            // Add 'active' class to 'containerSignUp' and remove 'inactive' class
            divSignUp.classList.remove('inactive');
            divSignUp.classList.add('active');
        });
    
        // Add click event listener to the signIn button
        document.getElementById('signIn').addEventListener('click', function(event) {
            // Prevent event bubbling
            event.stopPropagation();
    
            // Use forEach to loop through all 'container' elements
            Array.prototype.forEach.call(divs, function(div) {
                // Remove 'inactive' class and add 'active' class to all 'container' elements
                div.classList.remove('inactive');
                div.classList.add('active');
            });
            // Remove 'active' class from 'containerSignUp' and add 'inactive' class
            divSignUp.classList.remove('active');
            divSignUp.classList.add('inactive');
        });
    // }
    
    // Ensure the initial state is set correctly
    document.addEventListener('DOMContentLoaded', function() {
        var divs = document.getElementsByClassName('container');
        Array.prototype.forEach.call(divs, function(div) {
            div.classList.add('inactive');
        });
        var divSignUp = document.getElementsByClassName('containerSignUp')[0];
        divSignUp.classList.remove('active');
        divSignUp.classList.add('inactive');
    
        var divSignIn = document.getElementsByClassName('container')[0];
        divSignIn.classList.remove('inactive');
        divSignIn.classList.add('active');
    });