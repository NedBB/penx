<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
  class="light-style layout-navbar-fixed layout-menu-fixed layout-compact"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../../assets/"
  data-template="vertical-menu-template">
    <head>
        <meta charset="utf-8" />
        <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

        <title>Academy - Dashboard - App | Vuexy - Bootstrap Admin Template</title>

        <meta name="description" content="" />

        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="../../assets/img/favicon/favicon.ico" />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
        rel="stylesheet" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Nigerian Union of Pensioners') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link rel="icon" type="image/x-icon" href="../../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
      rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('css/fonts/fontawesome.css')}}" />
    <link rel="stylesheet" href="{{ asset('css/fonts/tabler-icons.css')}}" />
    <link rel="stylesheet" href="{{ asset('css/fonts/flag-icons.css')}}" />

    <!-- Core CSS -->
   <link rel="stylesheet" href="{{asset('css/demo.css')}}" />

    <link rel="stylesheet" href="{{asset('libs/node-waves/node-waves.css')}}" />
    <link rel="stylesheet" href="{{asset('libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
    <link rel="stylesheet" href="{{asset('libs/typeahead-js/typeahead.css')}}" />
    <link rel="stylesheet" href="{{asset('libs/datatables-bs5/datatables.bootstrap5.css')}}" />
    <link rel="stylesheet" href="{{asset('libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}" />
    <link rel="stylesheet" href="{{asset('libs/datatables-checkboxes-jquery/datatables.checkboxes.css')}}" />
    <link rel="stylesheet" href="{{asset('libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}" />    
    <link rel="stylesheet" href="{{asset('libs/apex-charts/apex-charts.css')}}" />
    <link rel="stylesheet" href="{{asset('libs/swiper/swiper.css')}}" />

    <link rel="stylesheet" href="{{asset('libs/flatpickr/flatpickr.css')}}" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="{{asset('css/pages/cards-advance.css')}}" />
    <script src="{{asset('js/helpers.js')}}"></script>

    <script src="{{asset('js/template-customizer.js')}}"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{asset('js/config.js')}}"></script>

    <link rel="stylesheet" href="{{asset('css/rtl/core.css')}}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{asset('css/rtl/theme-default.css')}}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{asset('libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css')}}" />
    <link rel="stylesheet" href="{{asset('css/main.css')}}" />

        <!-- Scripts -->
        <!-- @vite(['resources/css/app.css', 'resources/js/app.js']) -->
    </head>
    <body>
        <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            
                
                @include('layouts.side-menu')

                <div class="layout-page">
                    <!-- Page Heading -->
                    @include('layouts.header-menu')
                    <!-- @if (isset($header))
                        <header class="bg-white shadow">
                            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                                {{ $header }}
                            </div>
                        </header>
                    @endif -->

                    <div class="content-wrapper">
                    
                        {{ $slot }}
                    
                    </div>
                </div>
            </div>
            <div class="layout-overlay layout-menu-toggle"></div>

      <!-- Drag Target Area To SlideIn Menu On Small Screens -->
            <div class="drag-target"></div>
        </div>
        <script src="{{asset('libs/jquery/jquery.js')}}"></script>
        <script src="{{asset('libs/popper/popper.js')}}"></script>
        <script src="{{asset('js/bootstrap.js')}}"></script>
        <script src="{{asset('libs/node-waves/node-waves.js')}}"></script>
        <script src="{{asset('libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
        <script src="{{asset('libs/hammer/hammer.js')}}"></script>
        <script src="{{asset('libs/i18n/i18n.js')}}"></script>
        <script src="{{asset('libs/typeahead-js/typeahead.js')}}"></script>
        <script src="{{asset('js/menu.js')}}"></script>

        <!-- endbuild -->

        <!-- Vendors JS -->
        <script src="{{asset('libs/moment/moment.js')}}"></script>
        <script src="{{asset('libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
        <script src="{{asset('libs/apex-charts/apexcharts.js')}}"></script>
        <script src="{{asset('libs/flatpickr/flatpickr.js')}}"></script>
        <!-- Form Validation -->
        <script src="{{asset('libs/@form-validation/umd/bundle/popular.min.js')}}"></script>
        <script src="{{asset('libs/@form-validation/umd/plugin-bootstrap5/index.min.js')}}"></script>
        <script src="{{asset('libs/@form-validation/umd/plugin-auto-focus/index.min.js')}}"></script>
        <!-- Page JS -->
        <script src="{{asset('js/app-academy-dashboard.js')}}"></script>
        <!-- Main JS -->
        <script src="{{asset('js/main.js')}}"></script>

        
        <script src="{{asset('js/tables-datatables-basic.js')}}"></script>
    </body>
</html>
