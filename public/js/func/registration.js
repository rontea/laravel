(() => {

    'use strict'

    // Get the form element
    const form = document.getElementById("validateForm");

    /**
     *  Event listener on page load
     */

    window.addEventListener('load', function() {

     // Event listener on form submit
      form.addEventListener("submit", function(event) {

        event.preventDefault(); // Prevent default form submission

        // Get the values from the form inputs
        const password = document.getElementById('password').value;
        const confirm_password = document.getElementById('confirm_password').value;
        const username = document.getElementById('username').value;

        // Perform password, confirm password, and username checks
        let isValidPassword = validatePassword(password,confirm_password); // Check password validity
        let isValidConfirmPassword = validateConfirmPassword(password,confirm_password); // Check confirm password validity
        let isValidUsername = validateUsername(username); // Check username validity

        // If all checks pass, submit the form
        if(isValidPassword && isValidConfirmPassword && isValidUsername){
          form.submit();
        }else {
          console.log('Message check issue here');
        }
      });

      // Input event listener for password input
      form.password.addEventListener('input', function(event){

        const password = document.getElementById('password').value;
        const confirm_password = document.getElementById('confirm_password').value;
        // Check the password validity
        validatePassword(password,confirm_password);

      });
      // Input event listener for confirm password input
      form.confirm_password.addEventListener('input' , function (event){

        const password = document.getElementById('password').value;
        const confirm_password = document.getElementById('confirm_password').value;

        // Check the confirm password validity
        validateConfirmPassword(password,confirm_password);

      });

      // Input event listener for username input
      form.username.addEventListener('input', function(event){

        const username = document.getElementById('username').value;

         // Check the username validity
        validateUsername(username);

      });

      /**
       * Helper function to check the validity of the password
       * @param {*} password
       * @param {*} confirm_password
       * @returns boolean
       * Return true or false indicating validity
       */

      function validatePassword(password,confirm_password){
        //Password validation criteria...
        const specialCharPattern = /[!@#$%^&*()_+\-=[\]{};':"\\|,.<>/?]/;
        const whitespace = /\s/;
        const uppercase = /[A-Z]/;
        const lowercase = /[a-z]/;
        const number = /[0-9]/;

        //check if we can proceed
        let bol = false;

        if(confirm_password != "" && !bol ){
          bol = false;
          // checking password
          validateConfirmPassword(password,confirm_password);
        }

        // check combination
        if ( password.length < 8 || !uppercase.test(password) || !lowercase.test(password)
        || !number.test(password) || !specialCharPattern.test(password)
        || whitespace.test(password)) {

            if(password.length < 8){

              passwordFeedback.textContent = "Password should be at least 8 characters long.";
              passwordFeedback.style.display = 'block';
              passwordValidFeedback.style.display = 'none';

            }else{
              passwordFeedback.textContent = 'Password must contain at least one uppercase letter, one special character, one lowercase letter, one number and no whitespace.';
              passwordFeedback.style.display = 'block';
              passwordValidFeedback.style.display = 'none';
            }

            bol = false;
        }else{
          bol = true;
        }

        if(bol){
          passwordFeedback.style.display = 'none';
          passwordValidFeedback.textContent = 'Confirm Password'
          passwordValidFeedback.style.display = 'block';
        }

        return bol;

      }
     /**
      * Helper function to check the validity of the confirm password
      * @param {*} password
      * @param {*} confirm_password
      * @returns bolean
      * Return true or false indicating validity
      */

      function validateConfirmPassword(password,confirm_password){

        let bol = false;

        if (confirm_password == password){

          confirm_passwordFeedback.style.display = 'none';
          confirm_passwordValidFeedback.textContent = "Password Match";
          confirm_passwordValidFeedback.style.display = 'block';
          bol = true;

        }else {
          confirm_passwordValidFeedback.style.display = 'none';
          confirm_passwordFeedback.textContent = "Password did not match";
          confirm_passwordFeedback.style.display = 'block';
          bol = false;
        }

        return bol;

      }

      /**
       * Helper function to check the validity of the username
       * @param {*} username
       * @returns bolean
       * Return true or false indicating validity
       */

      function validateUsername(username){

        let bol = false;

        const whitespace = /\s/;

        if(username.length < 5 || whitespace.test(username)){

          if(username.length < 5){
            usernameValidFeedback.style.display = 'none';
            usernameFeedback.textContent = "Username should be at least 5 characters long.";
            usernameFeedback.style.display = 'block';
          }else {
            usernameValidFeedback.style.display = 'none';
            usernameFeedback.textContent = "Username should not have whitespace";
            usernameFeedback.style.display = 'block';
          }
          bol = false;
        }else {
          usernameFeedback.style.display = 'none';
          usernameValidFeedback.textContent = "Confirm Username";
          usernameValidFeedback.style.display = 'block';
          bol = true;
        }

        return bol;

      }

      // Initialize tooltips
      let tooltips = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
      let tooltipInstances = tooltips.map(function (tooltip) {
        return new bootstrap.Tooltip(tooltip);
      });

    });

  })();
