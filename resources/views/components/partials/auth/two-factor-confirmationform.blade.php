

@if (session('status') == 'two-factor-authentication-confirmed')


@if (session('status') == 'two-factor-authentication-confirmed')
    <div class="alert alert-success">
        Two-factor authentication confirmed successfully.
    </div>
@else
    <div class="alert alert-danger">
        Two-factor authentication confirmation failed.
    </div>
@endif

    <p>You will need to verify 2FA before you can proceed using it. Confirm two-factor authentication</p>
    <form action="{{ url('user/confirmed-two-factor-authentication') }}" method="POST" class="g-3 needs-validation" id="two-factor-auth-confirmation">
        @csrf


        <div class="p-2 row">
            <div class="col-sm-10">
                <div class="input-group mb-3">
                    <p>Enter token</p>
                    <input name="code" type="text" class="form-control" id="code" required>
                </div>
            </div>
        </div>



        <div class="d-flex flex-row-reverse">
            <div class="me-2">
                <button type="submit" class="btn btn-primary mb-3">Confirm 2FA</button>
            </div>
        </div>
    </form>
@else
    <p>Confirmed at: {{ auth()->user()->two_factor_confirmed_at }}</p>
@endif
