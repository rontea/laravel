
 {{--
  @author: RonTea
  Website: https://live-rontea.pantheonsite.io/
  Version: 0
  Date: July, 06, 2023
  File: resources\views\components\partials\auth\loginform.blade.php
 --}}
    {{-- verify --}}

    @if ($errors->any())
        @foreach ($errors->all() as $error)
        <div class="alert alert-warning" role="alert">
            {{ $error }}
        </div>
        @endforeach
    @endif

    @if(session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status')}}
        </div>
    @endif

    <div>
        Check your email to verify your email address.
    </div>

    <div class="container m-4">
        <form action="{{ route('verification.send') }}" method="POST" class="g-3 needs-validation" id="loginForm">
            @csrf

            <div class="d-flex flex-row-reverse">
                <div class="me-2">
                    <button type="submit" class="btn btn-primary mb-3">Resend Email</button>
                </div>
            </div>
        </form>

    {{-- Quick links --}}
        <div class="row p-2">
            <div class="col-3">
                <a href="/register"> Register </a>
            </div>
            <div class="col-3">
                <a href="/forgot-password"> Forgot Password </a>
            </div>

            <div class="col-3">
                <a href="/liveusernamechecking"> Test JSON </a>
            </div>
        </div>

    </div>




