/**
 * @author RonTea
 * @website
 * @version 0
 */

'use strict'
/**
 *
 * username checking live
 *
 * @param formid
 * @param inputid
 * @param reloadIcon
 * @param exclamationIcon
 * @param checkIcon
 */

class UserForm {
    constructor(formId, usernameId, reloadIconId, exclamationIconId,
        checkIconId) {
        // variable class
        this.form;
        this.username;
        this.reloadIcon;
        this.exclamationIcon;
        this.checkIcon;
        this.typingTimer;
        this.validFeedbackId;
        this.invalidFeedbackId;




        // variable setting

        this.formId = formId;
        this.usernameId = usernameId;
        this.reloadIconId = reloadIconId;
        this.exclamationIconId = exclamationIconId;
        this.checkIconId = checkIconId;

        this.proceed = false;
        this.minInputLength = 5;
        this.maxInputLength = 60;


        // envoke init
        this.init();
    }
    // start when load
    init() {



        // get all the ids
        this.form = document.getElementById(this.formId);
        this.username = document.getElementById(this.usernameId);
        this.reloadIcon = document.getElementById(this.reloadIconId);
        this.exclamationIcon = document.getElementById(this.exclamationIconId);
        this.checkIcon = document.getElementById(this.checkIconId);


        this.setLength(this.minInputLength,this.maxInputLength);
        // hide the icons
        this.hideIcons();

        // start the process key up with delay
        this.username.addEventListener('keyup', this.delayedCheckUsernameAvailability.bind(this));
        // check username for feedback visibility
        this.username.addEventListener('input', this.showLoading.bind(this));

    }

    /**
     * Methoad loading flip
     */
    showLoading() {

    let username = this.username.value;
    const whitespace = /\s/;
    console.log("Checking: " + this.username.value + " " + this.proceed);

      if (username.value === '') {
        this.hideIcons();
        this.proceed = false;
      } else {

        this.showReload();

        if(username.length < this.minInputLength ||
            whitespace.test(username) ||
            username.length >= this.maxInputLength){

            if(username.length < 5){
                this.showExclamationIcon();

                if(this.invalidFeedbackId){
                    this.showInvalidFeedback();
                }


            }else if (whitespace.test(username)) {
                this.showExclamationIcon();
                usernameValidFeedback.style.display = 'none';
                usernameFeedback.textContent = "Username should not have whitespace.";
                usernameFeedback.style.display = 'block';

            }else{
                this.showExclamationIcon();

            }
            this.proceed = false;
        }else{
            this.proceed = true;
        }
      }
    }
    /**
     * Method hide icon
     */
    hideIcons() {
      this.reloadIcon.style.display = 'none';
      this.exclamationIcon.style.display = 'none';
      this.checkIcon.style.display = 'none';
    }

    /**
     * Icons
     */

    showReload(){
        this.reloadIcon.style.display = 'block';
        this.exclamationIcon.style.display = 'none';
        this.checkIcon.style.display = 'none';
    }

    showExclamationIcon(){
        this.reloadIcon.style.display = 'none';
        this.exclamationIcon.style.display = 'block';
        this.checkIcon.style.display = 'none';
    }

    showCheckIcon(){
        this.reloadIcon.style.display = 'none';
        this.exclamationIcon.style.display = 'none';
        this.checkIcon.style.display = 'block';
    }

    /**
     * Messages
     *
     */
    setFeedback(validFeedbackId,invalidFeedbackId){
        this.validFeedbackId = document.getElementById(validFeedbackId);
        this.invalidFeedbackId = document.getElementById(invalidFeedbackId);
    }

    showValidFeedback(message) {

        usernameFeedback.style.display = 'none';
        usernameValidFeedback.textContent = "Confirm Username";
        usernameValidFeedback.style.display = 'block';

    }
    showInvalidFeedback(message) {

        this.validFeedbackId.style.display = 'none';
        this.invalidFeedbackId.textContent = "Username should be at least 5 characters long.";
        this.invalidFeedbackId.style.display = 'block';

    }

    /**
     * Set the max and min legth
     */

    setLength(minInputLength,maxInputLength){
        // set the data for max and min input link
        this.minInputLength = minInputLength;
        this.maxInputLength = maxInputLength;
        // force set of maxLength on code
        this.username.maxLength = maxInputLength;

    }

    isUsernameValid(){
        return this.proceed;
    }


    /**
     * Method delay and invoke checkUsernameAvailability
     */
    delayedCheckUsernameAvailability() {
      clearTimeout(this.typingTimer);
      this.typingTimer = setTimeout(this.checkUsernameAvailability.bind(this), 1000);
    }

    /**
     * Method to connect to controller to check
     */
    checkUsernameAvailability() {
      // get the information
      let username = this.username.value;
      // set the url
      let url = '/liveusernamechecking';

      let reloadIcon = this.reloadIcon;
      let exclamationIcon = this.exclamationIcon;
      let checkIcon = this.checkIcon;

      reloadIcon.style.display = 'none';

      // valide username
      if (this.proceed) {
        // fetch
        fetch(url, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: JSON.stringify({
            username: username
          })
        })
        .then(function(response) {
          return response.json();
        })
        .then(function(data) {
            // controller pass variable 'available'
          if (data.available) {
            console.log(data.available + ' == ' + username + ' is available');
            this.showCheckIcon();
            usernameFeedback.style.display = 'none';
            usernameValidFeedback.textContent = "Username is available";
            usernameValidFeedback.style.display = 'block';
            this.proceed = true;
          } else {
            // available is equal to false
            console.log(data.available + ' == ' + username + ' is not available');
            this.showExclamationIcon();
            usernameValidFeedback.style.display = 'none';
            usernameFeedback.textContent = "Username is not available.";
            usernameFeedback.style.display = 'block';
            this.proceed = false;
          }
        }.bind(this))
        .catch(function(error) {
          console.error(error);
        });
      }
    }
  }

  (() => {
    const form = document.getElementById("testForm");

    // Usage
    const userForm = new UserForm('testForm', 'username1', 'eventChecking', 'respondExist', 'respondValid');
    userForm.setLength(5,60);
    userForm.setFeedback('usernameValidFeedback','usernameFeedback');
    const isUsernameValid = userForm.isUsernameValid();

    window.addEventListener('load', function() {
        form.addEventListener("submit", function(event) {

            event.preventDefault();

            const isUsernameValid = userForm.isUsernameValid();


            if(isUsernameValid){
                form.submit();
            }else{
                console.log('final cannot go ' + isUsernameValid );
            }
        });
    });

  })();

