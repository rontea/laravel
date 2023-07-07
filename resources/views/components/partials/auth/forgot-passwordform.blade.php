
 {{--
  @author: RonTea
  Website: https://live-rontea.pantheonsite.io/
  Version: 0
  Date: July, 07, 2023
  File: resources\views\components\partials\auth\forgot-passwordform.blade.php
 --}}
    {{-- Forgot Password --}}

    @if ($errors->any())
        @foreach ($errors->all() as $error)
        <div class="alert alert-warning" role="alert">
            {{ $error }}
        </div>
        @endforeach
    @endif


    @guest
    <div class="container m-4">
        <form action="{{ route('password.request') }}" method="POST" class="g-3 needs-validation" id="loginForm">
            @csrf
            <div class="p-2 row">
                <div class="col-sm-10">
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input name="email" type="email" class="form-control" id="email"
                                placeholder="email"
                                aria-describedby="inputGroupPrepend"
                            required>
                    </div>
                    @if(session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status')}}
                    </div>
                    @endif
                </div>
            </div>

            <div class="d-flex flex-row-reverse">
                <div class="me-2">
                    <button type="submit" class="btn btn-primary mb-3">Reset Password</button>
                </div>
            </div>
        </form>

    {{-- Quick links --}}
        <div class="row p-2">
            <div class="col-3">
                <a href="/register"> Dont have an account Register? </a>
            </div>


            <div class="col-3">
                <a href="/liveusernamechecking"> Test JSON </a>
            </div>
        </div>

    </div>

    @endguest

