/**
 *  Login 
 */
(() => {

    'use strict'

        // Get the login form element
        const formPassword = document.getElementById("loginForm");

        // Add event listener on page load
        window.addEventListener('load', function() { 
            
            // Get the password input element
            const passwordInput = formPassword.querySelector("#password");
            
            // Get the show and hide eye icons
            const showEye = formPassword.querySelector("#showEye");
            const hideEye = formPassword.querySelector("#hideEye");
            
            // Set initial display states
            showEye.style.display = 'none';
            hideEye.style.display = 'block';
            
            // Event listener for the hide eye icon click
            hideEye.addEventListener('click', function(){
                
                // Hide the hide eye icon and show and show eye icon
                hideEye.style.display = 'none';
                showEye.style.display = 'block';
                
                // Change the password input type to text
                passwordInput.type = 'text';
                
                // Revert back to password type after 2 seconds
                if (passwordInput.type === 'text'){
                    setTimeout(function() {         
                    hideEye.style.display = 'block';
                    showEye.style.display = 'none';
                    passwordInput.type = 'password';
                    }, 2000);
                }
            
            });
            
            // Event listener for the show eye icon click
            showEye.addEventListener('click', function(){
                // Show the hide eye icon and hide the show eye icon
                hideEye.style.display = 'block';
                showEye.style.display = 'none';
                passwordInput.type = 'password';
            });
    
        });
    
    })();
    