<!DOCTYPE html>

<html class="light-style layout-menu-fixed" data-theme="theme-default" data-assets-path="{{ asset('/assets') . '/' }}"
    data-base-url="{{ url('/') }}" data-framework="laravel" data-template="vertical-menu-laravel-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>@yield('title')</title>
    <meta name="description"
        content="{{ config('variables.templateDescription') ? config('variables.templateDescription') : '' }}" />
    <meta name="keywords"
        content="{{ config('variables.templateKeyword') ? config('variables.templateKeyword') : '' }}">
    <!-- laravel CRUD token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Canonical SEO -->
    <link rel="canonical" href="{{ config('variables.productPage') ? config('variables.productPage') : '' }}">
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/logo/logo.png') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Charm:wght@400;700&display=swap" rel="stylesheet">
    
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" />
	<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    
	<script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"></script>
	<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
    
    <!-- Include Styles -->
    @include('layouts/sections/styles')

    <!-- Include Scripts for customizer, helper, analytics, config -->
    @include('layouts/sections/scriptsIncludes')
    @yield('cssStyles')
    @livewireStyles
</head>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="{{ asset('assets/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
<script src="{{ asset('assets/lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('assets/lib/owlcarousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/lib/tempusdominus/js/moment.min.js') }}"></script>
<script src="{{ asset('assets/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
<script src="{{ asset('assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
    .alert-container {
    z-index: 8888;
    }
    .alert-popup {
    font-size: 1rem;
    padding-left: 2rem;
    padding-right: 2rem;
    background-color: #fff;
    z-index: 9999 !important; /* Set the z-index to a very high value */
    }

    .alert-confirmButton, .alert-cancelButton{
    padding: 0.3rem 1.5rem;
    font-size: 1rem;
    border-radius: 0.5rem;
    outline: none;
    border: none;
    }

    .alert-confirmButton:focus {
    outline: none;
    border: none;
    }

    .alert-title {
    padding: 0;
    font-size: 1.5rem;
    }
    .alert-icon {
    font-size: 0.7rem;
    }
    .alert-input {
    min-height: calc(1.5em + (0.5rem + 2px));
    padding: 0.25rem 0.25rem;
    font-size: 0.75rem;
    border-radius: 0.2rem;
    }
</style>

<body>

    <!-- Include Scripts -->
    @include('layouts/sections/scripts')


    {{-- Custom Scripts --}}
    @yield('jsScripts')


    <!-- Layout Content -->
    @yield('layoutContent')
    <!--/ Layout Content -->
</body>

</html>
