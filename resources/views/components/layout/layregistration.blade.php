 {{--
  @author: RonTea
  Website: https://live-rontea.pantheonsite.io/
  Version: 0
  Date: June, 30, 2023
  File: resources\views\components\layout\layregistration.blade.php
 --}}

@guest

@if ($errors->any())
    @foreach ($errors->all() as $error)
    <div class="alert alert-warning" role="alert">
        {{ $error }}
    </div>
    @endforeach
@endif

{{-- Setting individual errors --}}

@error('username')
    <div class="alert alert-warning" role="alert">
        {{ $message }}
    </div>
@enderror

<form class="row g-3 m-2" id="validateForm"
    action="{{ route('registration.submit') }}" method="POST">
    @csrf
    <div class="col-md-4">
      <label for="first_name" class="form-label">First name</label>
      <input name="first_name" value="{{ old('first_name') }}" type="text"
        class="form-control" id="first_name" required>

    </div>
    <div class="col-md-4">
        <label for="middle_name" class="form-label">Middle name</label>
        <input name="middle_name" value="{{ old('middle_name') }}" type="text"
            class="form-control" id="middle_name">
    </div>

    <div class="col-md-4">
      <label for="last_name" class="form-label">Last name</label>
      <input name="last_name" value="{{ old('last_name') }}" type="text"
        class="form-control" id="last_name"  required>

    </div>

    <div class="col-md-4">
      <label for="username" class="form-label">Username</label>
      <div class="input-group has-validation">
        <input  name="username" value="{{ old('username')}}" type="text" class="form-control" id="username"
          data-bs-toggle="tooltip"
          data-bs-original-title="Username should be atleast 5 Character long no whitespace"
        required>

        <div id="usernameValidFeedback" class="valid-feedback">

        </div>
        <div id="usernameFeedback" class="invalid-feedback">

        </div>

      </div>
    </div>

    <div class="col-md-4">
        <label for="email_address" class="form-label">Email</label>
          <input name="email" type="email" class="form-control"
             id="email_address"  placeholder="john@sample.com" required>

    </div>

    <div class="col-md-6">
        <label for="password" class="form-label" >Password</label>

        <input name="password" type="password" class="form-control" id="password"
          data-bs-toggle="tooltip"
          data-bs-original-title="Password must have mimimum of 8
          character and must contain at least one uppercase letter,
          one special character, one lowercase letter, one number and no whitespace"
        required>

        <div id="passwordValidFeedback" class="valid-feedback">

        </div>
        <div id="passwordFeedback" class="invalid-feedback">

        </div>
    </div>

    <div class="col-md-6">
        <label for="confirm_password" class="form-label">Confirm Password</label>
          <input name="confirmPassword" type="password" class="form-control"
            id="confirm_password"
            data-bs-toggle="tooltip"
            data-bs-original-title="This should Match the Password"
            required>

          <div id="confirm_passwordValidFeedback" class="valid-feedback">
          </div>
          <div id="confirm_passwordFeedback" class="invalid-feedback">
          </div>
    </div>

    <div class="col-12 mb-2">
      <button class="btn btn-primary" type="submit">Submit form</button>
    </div>

  </form>

  <div class="col-12 mt-2">
    <a href="#"> Next </a>
  </div>





  <script src="/js/func/registration.js"></script>

@endguest
