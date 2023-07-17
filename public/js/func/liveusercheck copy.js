/**
 * @author: RonTea
 * Website: https://live-rontea.pantheonsite.io/
 * Version: 0
 * Date: June, 30, 2023
 * File: public\js\func\liveusercheck.js
 */

'use strict'


class PasswordForm {
    constructor(formId,passwordId,passwordConfirmationId) {

        this.validation;
        this.min;
        this.max;

        this.specialCharPattern;
        this.whitespace;
        this.uppercase;
        this.lowercase;
        this.number;

        this.form;
        this.password;
        this.passwordConfirmation;

        this.passwordId = passwordId;
        this.passwordConfirmationId = passwordConfirmationId;
        this.formId = formId;

        this.validationSuccessFeedback;
        this.validationErrorFeedback;

        this.valid;

        this.message;

    }

    init(){

        this.valid = false;

        this.form = document.getElementById(this.formId);
        this.password = document.getElementById(this.passwordId);
        this.passwordConfirmation = document.getElementById(this.passwordConfirmationId);


        this.min = 8;
        this.max = 255;

        this.specialCharPattern = /[!@#$%^&*()_+\-=[\]{};':"\\|,.<>/?]/;
        this.whitespace = /\s/;
        this.uppercase = /[A-Z]/;
        this.lowercase = /[a-z]/;
        this.number = /[0-9]/;

        this.validation = {
            'min' : this.min,
            'max' : this.max,
            'required' : {
                'specialCharacter' : true,
                'whitespace' : true,
                'uppercase': true,
                'lowercase': true,
                'number': true,

            },
            'feedback' : {
                'min': 'Password should be at least ' + this.min + ' characters',
                'max': 'Maximum allowed Characted limit has been reached ' + this.max,
                'specialCharacter' : 'Must Contain one special character',
                'whitespace' : 'Whitespace is not allowed',
                'uppercase': 'Must Contain one uppercase',
                'lowercase': 'Must Contain one lowercase',
                'number': 'Must Contain one number',
            }
        }
        this._privateEnforceMax();
        this.password.addEventListener('input', this._privateValidatePassword.bind(this));
        this.passwordConfirmation.addEventListener('input', this._privateValidateConfirmPassword.bind(this));
    }
    _privateValidateConfirmPassword(){

        const password = this.password.value;
        const passwordConfirmation = this.passwordConfirmation.value;

        if(password === passwordConfirmation){
            this.valid = true;
        }else{
            this.valid = false;
        }

    }

    _privateValidatePassword (){

        const password = this.password.value;
        const passwordConfirmation = this.passwordConfirmation.value;
        const confirmPasswordState = true;

        if(passwordConfirmation != "" && confirmPasswordState ){

            this.valid = false;
            this._privateValidateConfirmPassword();
        }


        switch (true) {
            case (password.length < this.validation.min || password.length > this.validation.max):
              this.valid = false;
              break;
            case this.validation.required.specialCharPattern && !this.specialCharPattern(password):
              this.valid = false;
              break;
            case this.validation.required.whitespace && !this.whitespace.test(password):
              this.valid = false;
              break;
            case this.validation.required.uppercase && !this.uppercase.test(password):
              this.valid = false;
              break;
            case this.validation.required.lowercase && !this.lowercase.test(password):
              this.valid = false;
              break;
            case this.validation.required.number && !this.number.test(password):
              this.valid = false;
              break;
            default:
              this.valid = true;
          }

    }

    _privateEnforceMax(){
        this.password.maxLength = this.max;
    }

    setRule(validation = {}){
        this.validation = validation;
        this.validation = {...this.validation, ...validation};
    }

    setValidationFeedbackId(validationSuccessFeedbackId,validationErrorFeedbackId) {
        this.validationErrorFeedback = document.getElementById(validationErrorFeedbackId);
        this.validationSuccessFeedback = document.getElementById(validationSuccessFeedbackId);
    }

    setPasswordLegth(min,max){
        this.min = min;
        this.max = max;
    }

    setPasswordMin(min) {
        this.min = min;
    }

    setPasswordMax(max){
        this.max = max;
    }

    // methods
    getErrorMessage(messasge){

    }

    setSuccessMessage(message){

    }

    isPasswordValid(){
        return this.valid;
    }

}



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
        // the form
        this.form;
        // the input
        this.username;
        // icons
        this.reloadIcon;
        this.exclamationIcon;
        this.checkIcon;
        // use in timer expand to set delay to prevent error on server
        this.typingTimer;
        this.timer = 1000;
        // set by coder if they want to use bootstrap valid message
        this.validFeedbackId;
        this.invalidFeedbackId;
        // message
        this.message;


        // variable setting mapping of each id
        this.formId = formId;
        this.usernameId = usernameId;
        this.reloadIconId = reloadIconId;
        this.exclamationIconId = exclamationIconId;
        this.checkIconId = checkIconId;

        // validation creteria if validation pass
        this.proceed = false;

        // input length setting
        this.minInputLength = 5;
        this.maxInputLength = 60;


        // envoke init
        this.init();
    }
    // start when load
    init() {

        // getElementById from supplied data
        this.form = document.getElementById(this.formId);
        this.username = document.getElementById(this.usernameId);
        this.reloadIcon = document.getElementById(this.reloadIconId);
        this.exclamationIcon = document.getElementById(this.exclamationIconId);
        this.checkIcon = document.getElementById(this.checkIconId);

        // set the initial default if not supplied
        this.setLength(this.minInputLength,this.maxInputLength);
        // hide the icons
        this.hideIcons();

        this.message = {
            min : 'Username should be atleast 5 characters long',
            max : 'Username exceeded the max allowed characters.',
            whitespace: 'Username should not have whitespace.',
            available: 'Username is available',
		    notavailable: 'Username is not available.'
        };

        // start the process key up with delay
        this.username.addEventListener('keyup', this.delayedCheckUsernameAvailability.bind(this));
        // check username for feedback visibility
        this.username.addEventListener('input', this.showLoading.bind(this));

    }

    /**
     * Methoad loading flip
     */
    showLoading() {

    const username = this.username.value;
    const whitespace = /\s/;
    console.log("Checking: " + this.username.value + " " + this.proceed);

      if (username.value === '') {
        this.hideIcons();
        this.proceed = false;
      } else {

        this.showReload();

        if(username.length < this.minInputLength ||
            whitespace.test(username) ||
            username.length > this.maxInputLength){

            if(username.length < 5){
                this.showExclamationIcon();

                if(this.invalidFeedbackId){

                    this.showInvalidFeedback(this.message.min);
                }


            }else if (whitespace.test(username)) {
                this.showExclamationIcon();

                if(this.invalidFeedbackId){

                    this.showInvalidFeedback(this.message.whitespace);
                }
            }else{
                this.showExclamationIcon();
                if(this.invalidFeedbackId){

                    this.showInvalidFeedback(this.message.max);

                }

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
     *
     * @param {id} validFeedbackId
     * @param {id} invalidFeedbackId
     * @param {object} message
     */

    setFeedback(validFeedbackId,invalidFeedbackId,message = {}){
        this.validFeedbackId = document.getElementById(validFeedbackId);
        this.invalidFeedbackId = document.getElementById(invalidFeedbackId);

        // default and merge
        this.message = {...this.message, ...message};

    }
    /**
     *  Set the message that will be return
     * @param {object} message
     */

    setValidateMessage(message = {}){
        this.message = message;
        // default and merge
        this.message = {...this.message, ...message};
    }

    /**
     * Return the message for valid
     * @param {string} message
     */

    showValidFeedback(message) {

        usernameFeedback.style.display = 'none';
        usernameValidFeedback.textContent = message;
        usernameValidFeedback.style.display = 'block';

    }

    /**
     * Return the message for invalid
     * @param {string} message
     */

    showInvalidFeedback(message) {

        this.validFeedbackId.style.display = 'none';
        this.invalidFeedbackId.textContent = message;
        this.invalidFeedbackId.style.display = 'block';

    }

    /**
     * Set the min and max of the characters
     * @param {int} minInputLength
     * @param {int} maxInputLength
     */

    setLength(minInputLength,maxInputLength){
        // set the data for max and min input link
        this.minInputLength = minInputLength;
        this.maxInputLength = maxInputLength;
        // force set of maxLength on code
        this.username.maxLength = maxInputLength;
    }

    /**
     * return the state of the username
     * @returns boolean
     */

    isUsernameValid(){
        return this.proceed;
    }


    /**
     * Method delay and invoke checkUsernameAvailability
     */

    delayedCheckUsernameAvailability() {
      clearTimeout(this.typingTimer);
      this.typingTimer = setTimeout(
        this.checkUsernameAvailability.bind(this), this.timer);
    }

    /**
     * Method to connect to controller to check
     */

    checkUsernameAvailability() {
      // get the information
      const username = this.username.value;
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
            if(this.validFeedbackId){
                this.showValidFeedback(this.message.available);
            }
            this.proceed = true;
          } else {
            // available is equal to false
            console.log(data.available + ' == ' + username + ' is not available');
            this.showExclamationIcon();
            if(this.invalidFeedbackId){
                this.showInvalidFeedback(this.message.notavailable);
            }
            this.proceed = false;
          }
        }.bind(this))
        .catch(function(error) {
          console.error(error);
        });
      }
    }
  }

// usage class expand to password and password confirmation

  (() => {
    const form = document.getElementById("testForm");

    // Usage
    const userForm = new UserForm('testForm', 'username1',
        'eventChecking', 'respondExist', 'respondValid');
    // default 5 and 60
    userForm.setLength(5,60);

    const message = {
        min : 'sample did it work min',
        available : 'yes available'
    };

    userForm.setFeedback('usernameValidFeedback','usernameFeedback',message);

    const isUsernameValid = userForm.isUsernameValid();

    window.addEventListener('load', function() {
        form.addEventListener("submit", function(event) {

            event.preventDefault();
            // check and proceed
            const isUsernameValid = userForm.isUsernameValid();

            if(isUsernameValid){
                form.submit();
            }else{
                console.log('final cannot go ' + isUsernameValid );
            }
        });
    });

  })();

