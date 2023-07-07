 {{--
  @author: RonTea
  Website: https://live-rontea.pantheonsite.io/
  Version: 0
  Date: July, 07, 2023
  File: resources\views\components\partials\auth\reset-passwordform.blade.php
 --}}
{{-- Reset Password --}}
@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-warning" role="alert">
            {{ $error }}
        </div>
    @endforeach
@endif



 <div class="container m-4">
        <form action="{{ route('password.update') }}" method="POST" class="g-3 needs-validation" id="resetForm">
            @csrf
            {{-- Need token Value --}}
            <input type="hidden" name='token' value="{{ request()->route('token') }}">
            <div class="p-2 row">
                <div class="col-sm-10">
                    <div class="input-group mb-3">
                        <input name="email" type="hidden" value="{{ request()->email }}">
                    </div>

                </div>

                <div class="col-md-6">
                    <label for="password" class="form-label">Password</label>

                    <input name="password" type="password" class="form-control" id="password" data-bs-toggle="tooltip"
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
                    <input name="password_confirmation" type="password" class="form-control" id="confirm_password"
                        data-bs-toggle="tooltip" data-bs-original-title="This should Match the Password" required>

                    <div id="confirm_passwordValidFeedback" class="valid-feedback">
                    </div>
                    <div id="confirm_passwordFeedback" class="invalid-feedback">
                    </div>
                </div>




            </div>

            <div class="d-flex flex-row-reverse">
                <div class="me-2">
                    <button type="submit" class="btn btn-primary mb-3">Update Password</button>
                </div>
            </div>
        </form>
    </div>


