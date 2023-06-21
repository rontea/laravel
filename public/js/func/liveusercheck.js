(function () {

    'use strict'

    const UserForm = {
        init: function() {
            this.form = document.getElementById('testForm');
            this.username = document.getElementById('username1');

            this.username.addEventListener(
            'keyup',
            this.delayedCheckUsernameAvailability.bind(this)
            );
        },

        delayedCheckUsernameAvailability: function () {
            clearTimeout(this.typingTimer);
            this.typingTimer = setTimeout(this.checkUsernameAvailability.bind(this), 1000);
        },

        checkUsernameAvailability: function() {

            let username = this.username.value;
            let url = '/liveusernamechecking';

            if(username.length >= 5){
                console.log(username);

                fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector(
                            'meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        username: username
                    })
                }).then(function(response){

                    return response.json();

                }).then(function(data){

                    if(data.available){
                        console.log(username + ' this is available');
                    }else {
                        console.log(username + ' this is not available');
                    }

                }).catch(function(error){

                    console.error(error);

                });

            }

        },

    }

    UserForm.init();

    })();
