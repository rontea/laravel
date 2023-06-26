'use strict'

class UserForm {
    constructor(formId, usernameId, reloadIconId, exclamationIconId, checkIconId) {
        // variable class
        this.form;
        this.username;
        this.reloadIcon;
        this.exclamationIcon;
        this.checkIcon;
        this.typingTimer;

        // variable setting

        this.formId = formId;
        this.usernameId = usernameId;
        this.reloadIconId = reloadIconId;
        this.exclamationIconId = exclamationIconId;
        this.checkIconId = checkIconId;

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

        // hide the icons
        this.hideIcons();

        // start the process key up with delay
        this.username.addEventListener('keyup', this.delayedCheckUsernameAvailability.bind(this));
        // just show loading
        this.username.addEventListener('input', this.showLoading.bind(this));
    }

    /**
     * Methoad loading flip
     */
    showLoading() {
      if (this.username.value === '') {
        this.reloadIcon.style.display = 'none';
      } else {
        this.reloadIcon.style.display = 'block';
        this.exclamationIcon.style.display = 'none';
        this.checkIcon.style.display = 'none';
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
      if (username.length >= 5) {
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
            console.log(data.available + '  ' + username + ' is available');
            reloadIcon.style.display = 'none';
            exclamationIcon.style.display = 'none';
            checkIcon.style.display = 'block';
          } else {
            // available is equal to false
            console.log(username + ' is not available');
            exclamationIcon.style.display = 'block';
            reloadIcon.style.display = 'none';
            checkIcon.style.display = 'none';
          }
        })
        .catch(function(error) {
          console.error(error);
        });
      }
    }
  }

  // Usage
  const userForm = new UserForm('testForm', 'username1', 'eventChecking', 'respondExist', 'respondValid');
