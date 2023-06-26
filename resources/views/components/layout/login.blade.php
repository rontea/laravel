
<div class="container m-4">

    <form class="g-3 needs-validation" id="loginForm">
        <div class="p-2 row">
            <div class="col-sm-10">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input type="text" class="form-control" id="username"
                            placeholder="username"
                            aria-describedby="inputGroupPrepend"
                        required>
                </div>
            </div>
        </div>

        <div class="p-2 row">

            <div class="col-sm-10">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                <input type="password" class="form-control" id="password" required>

                    <span class="input-group-text">
                        <i class="bi bi-eye-slash" id="hideEye"></i>
                        <i class="bi bi-eye" id="showEye"></i>
                    </span>
                  </div>
            </div>
        </div>
        <div class="d-flex flex-row-reverse">
            <div class="me-2">
                <button type="submit" class="btn btn-primary mb-3">Sign in</button>
            </div>
        </div>
    </form>
    <div class="row p-2">
        <div class="col-3">
            <a href="/registration"> Register </a>
        </div>
        <div class="col-3">
            <a href="#"> Forgot Password </a>
        </div>

        <div class="col-3">
            <a href="/liveusernamechecking"> Test JSON </a>
        </div>
    </div>

</div>

<script src="/js/func/login.js"></script>
