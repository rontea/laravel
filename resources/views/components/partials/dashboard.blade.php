@auth

<p> Welcome: {{ auth()->user()->first_name}} </p>
<p> Your information with id: {{auth()->user()->id}}<br> </p>

<p>
    First Name: {{auth()->user()->first_name}}<br>
    Middle Name: {{auth()->user()->middle_name}}<br>
    Last Name: {{auth()->user()->last_name}}<br>
    Username: {{auth()->user()->username}}<br>
    Email: {{auth()->user()->email}}<br>
    Password:  {{auth()->user()->password}}<br>
    Verified Date and Time:  {{auth()->user()->email_verified_at}}<br>

    <p> 2FA</p>

    two_factor_secret : {{auth()->user()->two_factor_secret}}<br>
    two_factor_recovery_codes : {{auth()->user()->two_factor_recovery_codes}}<br>
    two_factor_confirmed_at : {{auth()->user()->two_factor_confirmed_at}}<br>
    remember_token : {{auth()->user()->remember_token}}<br>

    <p> Update Information </p>

    created_at: {{ auth()->user()->created_at }} <br>
    updated_at: {{ auth()->user()->updated_at  }} <br>

</p>


@else


@endauth
