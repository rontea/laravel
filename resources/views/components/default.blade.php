<!doctype html>
<html lang="en">
    <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Offline -->
    <!-- Main CSS-->
    <link rel="stylesheet" href="css/styles.css" >

    <!-- Bootstrap CSS Main -->
    <link rel="stylesheet" href="css/inc/bootstrap.css" >


    <!-- Bootstrap Icon CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">


    <title> RonTea</title>
    <link rel="icon" type="image/x-icon" href="/img/favicon.ico">
    </head>
    <body>

        {{ $slot }}


        <!-- Offline Make user laest popper and bootsrap is installed use npm install bootstrap@latest -->
        <script src="js/inc/popper.min.js"></script>
        <script src="js/inc/bootstrap.min.js"></script>
        <script src="js/main.js"> </script>

    </body>
 </html>
