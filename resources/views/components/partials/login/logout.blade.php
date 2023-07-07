 {{--
  @author: RonTea
  Website: https://live-rontea.pantheonsite.io/
  Version: 0
  Date: June, 30, 2023
  File: resources\views\components\layout\login\logout.blade.php
 --}}
@auth
<form action="{{ route('logout') }}" method="POST" class="g-3" id="logout">
    @csrf
    <div class="d-flex flex-row-reverse">
        <div class="me-2">
            <button type="submit" id="logout" name="logout" class="btn btn-primary mb-3">Logout</button>
        </div>
    </div>
</form>
@endauth
