<form class="g-3 needs-validation" id="testForm">
    <div class="p-2 row">
        <div class="col-sm-10">
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-person"></i></span>
                    <input type="text" class="form-control" id="username1"
                        placeholder="username"
                        aria-describedby="inputGroupPrepend"
                    required>
                <span class="input-group-text"><i class="bi bi-arrow-repeat" id="eventChecking"></i></span>
                <span class="input-group-text"><i class="bi bi-exclamation-square" id="respondExist"></i></span>
                <span class="input-group-text"><i class="bi bi-check-square" id="respondValid"></i></span>
            </div>
        </div>
    </div>

    <div class="d-flex flex-row-reverse">
        <div class="me-2">
            <button type="submit" class="btn btn-primary mb-3">Sign in</button>
        </div>
    </div>
</form>
<script src="/js/func/liveusercheck.js"> </script>
