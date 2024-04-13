<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Pensioners') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <meta name="description" content="" />

<!-- Favicon -->
<link rel="icon" type="image/x-icon" href="../../assets/img/favicon/favicon.ico" />

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link
  href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
  rel="stylesheet" />

<!-- Icons -->
<!-- <link rel="stylesheet" href="../../assets/vendor/fonts/fontawesome.css" />
<link rel="stylesheet" href="../../assets/vendor/fonts/tabler-icons.css" />
<link rel="stylesheet" href="../../assets/vendor/fonts/flag-icons.css" /> -->

<!-- Core CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap5.css" />
<link rel="stylesheet" href="{{asset('css/rtl/core.css')}}" class="template-customizer-core-css" />
<link rel="stylesheet" href="{{asset('css/rtl/theme-default.css')}}" class="template-customizer-theme-css" />
<!-- <link rel="stylesheet" href="../../assets/css/demo.css" /> -->
<!-- Page CSS -->
<!-- Page -->
<link rel="stylesheet" href="{{asset('css/pages/page-auth.css')}}" />

<!-- Helpers -->
<script src="{{asset('js/helpers.js')}}"></script>
<!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
<!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
<script src="{{asset('js/template-customizer.js')}}"></script>
<!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
<!-- <script src="../../assets/js/config.js"></script> -->
        <!-- Scripts -->
        @vite(['resources/js/app.js'])
    </head>
    <body>
        <div class="container-xxl">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="print-header" style="background-color:#009688 !important">
                            <div class="text-uppercase text-center m">Nigerian Union Of Pensioners</div><div class="font-18 text-uppercase  s">National HeadQuarter</div></div></div>'+
                                <div class="col-lg-12">
                                    <h2 class="text-center clearfix">$newH1</h2>
                                    <br>
                                    <div class="pull-left">Date: {{date('d-m-Y')}}</div>
                                        <div class="pull-right">Cheque No: ............</div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="col-lg-12"> 
                                            {{ $slot }}
                                            <br>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <em>We Certify that the above statement is correct that the amount involved is in the interest of Nigeria Union of Pensioners and that the amount can be paid</em>
                                                </div>
                                            </div>
                                            <br><br>
                                            <div class="row">
                                                <div class="col-sm-3">Prepared by:......................</div><div class="col-sm-3">Collected by:.................<br>National Treasurer</div><div class="col-sm-3">........................<br>General Secretary</div>
                                                <div class="col-sm-3">.........................<br>National President</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
        </div>
    </body>
</html>
