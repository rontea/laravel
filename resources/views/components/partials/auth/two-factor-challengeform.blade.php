 {{--
  @author: RonTea
  Website: https://live-rontea.pantheonsite.io/
  Version: 0
  Date: July, 07, 2023
  File: resources\views\components\partials\auth\two-factor-challengeform.blade.php
 --}}



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

         <p> Please enter your authentication code </p>

         <form action="{{ url('/two-factor-challenge') }}" method="POST" class="g-3 needs-validation" id="two-factor-auth">
             @csrf

             <div class="p-2 row">

                 <div class="col-sm-10">
                     <div class="input-group mb-3">

                         <input name="code" type="text" class="form-control" id="code" required>
                     </div>
                 </div>
             </div>

             <div class="d-flex flex-row-reverse">
                 <div class="me-2">
                     <button type="submit" class="btn btn-primary mb-3">Confirm</button>
                 </div>
             </div>
         </form>

     </div>
