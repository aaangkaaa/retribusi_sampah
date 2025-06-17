<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>@yield('title', 'Dashboard') | Retribusi Kebersihan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- CSS Files -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet"><!-- Sweet Alert-->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/loading-animation.css') }}" rel="stylesheet" type="text/css" />
    
    <style>
        .top-right-button {
            position: absolute; /* Menggunakan positioning absolute */
            top: 20px; /* Jarak dari atas */
            right: 20px; /* Jarak dari kanan */
            padding: 10px 20px;
            /* background-color: #007BFF; */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .datepicker-dropdown{
            z-index: 1000000 !important;
        }
        .dropdown-menu {
            max-height: 250px;  /* Atur tinggi maksimal sesuai kebutuhan */
            overflow-y: auto;   /* Aktifkan scroll vertikal */
        }
        input[type="text"].form-control {
            height: auto;
            padding: 6px 12px;
            font-size: 14px;
        }
    </style>
        
    <!-- JavaScript Files -->
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script> <!-- jQuery harus di-load terlebih dahulu -->
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
</head>

<body data-topbar="light" data-layout="horizontal">

<!-- Loading Overlay -->
<div id="loading-overlay" class="loading-overlay visible">
    <div class="loader"></div>
    <div class="loading-text">Memuat Aplikasi...</div>
</div>

<div id="layout-wrapper">
    <!-- Header -->
    @include('layouts.header')

    <!-- Main Content -->
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                @yield('content')
            </div> <!-- container-fluid -->
        </div>
    </div>

    <!-- Footer -->
    @include('layouts.footer')
</div>

<!-- Right Sidebar -->
@include('layouts.sidebar')

<script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
<script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
<script src="{{ asset('assets/libs/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
<!-- Sweet Alerts js -->
<script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>

<!-- Sweet alert init js-->
<script src="{{ asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/sweet-alerts.init.js') }}"></script>
<script src="{{ asset('assets/libs/morris.js/morris.min.js') }}"></script>
<script src="{{ asset('assets/libs/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/dashboard.init.js') }}"></script>
<script src="{{ asset('assets/js/pages/autoCurrency.js') }}"></script>
<script src="{{ asset('assets/js/pages/numberFormat.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/js/app.js') }}"></script>
<script src="{{ asset('assets/js/pages/global.js') }}"></script>
<script src="{{ asset('js/loading.js') }}"></script>
</body>
</html>
