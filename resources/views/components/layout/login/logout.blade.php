@auth
<form action="/logout" method="POST" class="g-3" id="logout">
    @csrf
    <div class="d-flex flex-row-reverse">
        <div class="me-2">
            <button type="submit" id="logout" name="logout" class="btn btn-primary mb-3">Logout</button>
        </div>
    </div>
</form>
@endauth
