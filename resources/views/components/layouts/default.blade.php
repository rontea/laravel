 {{--
  @author: RonTea
  Website: https://live-rontea.pantheonsite.io/
  Version: 0
  Date: June, 30, 2023
  File: resources\views\components\default.blade.php
 --}}

<!doctype html>
<html lang="en">
    <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Offline -->
    <!-- Main CSS-->
    <link rel="stylesheet" href="{{ asset('css/styles.css')}}" >

    <!-- Bootstrap CSS Main -->
    <link rel="stylesheet" href="{{ asset('css/inc/bootstrap.css') }}" >


    <!-- Bootstrap Icon CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <script src="https://www.google.com/recaptcha/api.js?render=6LcjFRUnAAAAAFhszuR6gpe5gRbvoAt8FFOMrotn"></script>

    <title> {{ config('app.name') }}</title>
    <link rel="icon" type="image/x-icon" href="/img/favicon.ico">
    </head>
    <body>

        {{ $slot }}


        <!-- Offline Make user laest popper and bootsrap is installed use npm install bootstrap@latest -->
        <script src="js/inc/popper.min.js"></script>
        <script src="js/inc/bootstrap.min.js"></script>
        <script src="js/inc/main.js"> </script>

    </body>
 </html>
