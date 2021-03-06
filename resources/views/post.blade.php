<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" width="100" href="img/bogi_head.png" type="image/png">
        <title>Laravel</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
          <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,400italic|Material+Icons">
        <link rel="stylesheet" href="https://unpkg.com/vue-material@beta/dist/theme/default.css">
        <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

        <!-- imports new -->
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="vendors/linericon/style.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
        <link rel="stylesheet" href="css/magnific-popup.css">
        <link rel="stylesheet" href="vendors/nice-select/css/nice-select.css">
        <!-- main css -->
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
       



        <!-- <meta name="csrf-token" value="{{ csrf_token() }}" /> -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body>
   <style type="text/css">
       input.sinbordefondo {
            border: 0;
        }
        input.sinbordefondo::placeholder{
            font-size: 17px;
        }
        /*.spinner-loader.spinner-circular circle{
            stroke:blue;
        }*/

   </style>
   

        <div id="app">
        
        </div>


        <!--================Footer Area =================-->

   <footer>
       <center>
                <img src="img/bogi2.png" alt=""><br>
Copyright &copy;<script>document.write(new Date().getFullYear());</script> Todos los derechos reservados | Plantilla hecha  <i class="fa fa-heart" aria-hidden="true"></i> por <a href="https://colorlib.com" target="_blank">Applicodigo</a>
       </center>
   </footer>
  
    <!--================End Footer Area =================-->

        <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>


        <!-- <script src="js/jquery-3.2.1.min.js"></script> -->
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/stellar.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="vendors/nice-select/js/jquery.nice-select.min.js"></script>
    <script src="vendors/isotope/imagesloaded.pkgd.min.js"></script>
    <script src="vendors/isotope/isotope-min.js"></script>
    <script src="vendors/owl-carousel/owl.carousel.min.js"></script>
    <script src="js/jquery.ajaxchimp.min.js"></script>
    <script src="js/mail-script.js"></script>
    <!--gmaps Js-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
    <script src="js/gmaps.min.js"></script>
    <script src="js/theme.js"></script>
    </body>

</html>