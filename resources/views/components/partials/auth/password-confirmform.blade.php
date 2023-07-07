{{--
  @author: RonTea
  Website: https://live-rontea.pantheonsite.io/
  Version: 0
  Date: July, 07, 2023
  File: resources\views\components\partials\auth\password-confirmform.blade.php
 --}}
@auth
<div class="container m-4">
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-warning" role="alert">
                {{ $error }}
            </div>
        @endforeach
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif


        <form action="{{ url('user/confirm-password') }}" method="POST" class="g-3 needs-validation" id="loginForm">
            @csrf

            <div class="p-2 row">

                <div class="col-sm-10">
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                        <input name="password" type="password" class="form-control" id="password" required>

                        <span class="input-group-text">
                            <i class="bi bi-eye-slash" id="hideEye"></i>
                            <i class="bi bi-eye" id="showEye"></i>
                        </span>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-row-reverse">
                <div class="me-2">
                    <button type="submit" class="btn btn-primary mb-3">Confirm Change</button>
                </div>
            </div>
        </form>



    </div>


    <script src="/js/func/login.js"></script>
@endauth
