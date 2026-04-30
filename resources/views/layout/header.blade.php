<!DOCTYPE html>
<html lang="en" class="light-style layout-compact layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="{{ url('assets') }}/" data-template="vertical-menu-template" data-style="light">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="author" content="Suraj Vishwakarma ~ surajvishwakarma319@gmail.com" />
    <title>{{ $title }}</title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ url('favicon.ico') }}" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&amp;ampdisplay=swap">
    <!-- Icons -->
    <link type="text/css" rel="stylesheet" as="style" onload="this.onload=null;this.rel='stylesheet'" href="{{ url('assets/vendor/fonts/remixicon/remixicon.css') }}" />
    <link type="text/css" rel="stylesheet" as="style" onload="this.onload=null;this.rel='stylesheet'" href="{{ url('assets/vendor/fonts/flag-icons.css') }}" />
    <!-- Menu waves for no-customizer fix -->
    <link type="text/css" rel="stylesheet" as="style" onload="this.onload=null;this.rel='stylesheet'" href="{{ url('assets/vendor/libs/node-waves/node-waves.css') }}" />
    <!-- Core CSS -->
    <link type="text/css" rel="stylesheet" as="style" onload="this.onload=null;this.rel='stylesheet'" href="{{ url('assets/vendor/css/rtl/core.css') }}" class="template-customizer-core-css" />
    <link type="text/css" rel="stylesheet" as="style" onload="this.onload=null;this.rel='stylesheet'" href="{{ url('assets/vendor/css/rtl/theme-default.css') }}" class="template-customizer-theme-css" />
    <link type="text/css" rel="stylesheet" as="style" onload="this.onload=null;this.rel='stylesheet'" href="{{ url('assets/css/demo.css') }}" />
    <!-- Vendors CSS -->
    <link type="text/css" rel="stylesheet" as="style" onload="this.onload=null;this.rel='stylesheet'" href="{{ url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link type="text/css" rel="stylesheet" as="style" onload="this.onload=null;this.rel='stylesheet'" href="{{ url('assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link type="text/css" rel="stylesheet" as="style" onload="this.onload=null;this.rel='stylesheet'" href="{{ url('assets/vendor/libs/animate-css/animate.css') }}" />
    <link type="text/css" rel="stylesheet" as="style" onload="this.onload=null;this.rel='stylesheet'" href="{{ url('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
    <link type="text/css" rel="stylesheet" as="style" onload="this.onload=null;this.rel='stylesheet'" href="{{ url('assets/vendor/libs/bs-stepper/bs-stepper.css') }}" />
    <link type="text/css" rel="stylesheet" as="style" onload="this.onload=null;this.rel='stylesheet'" href="{{ url('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
    <link type="text/css" rel="stylesheet" as="style" onload="this.onload=null;this.rel='stylesheet'" href="{{ url('assets/vendor/libs/select2/select2.css') }}" />
    <link type="text/css" rel="stylesheet" as="style" onload="this.onload=null;this.rel='stylesheet'" href="{{ url('assets/vendor/libs/tagify/tagify.css') }}" />
    <link type="text/css" rel="stylesheet" as="style" onload="this.onload=null;this.rel='stylesheet'" href="{{ url('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link type="text/css" rel="stylesheet" as="style" onload="this.onload=null;this.rel='stylesheet'" href="{{ url('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link type="text/css" rel="stylesheet" as="style" onload="this.onload=null;this.rel='stylesheet'" href="{{ url('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}" />
    <link type="text/css" rel="stylesheet" as="style" onload="this.onload=null;this.rel='stylesheet'" href="{{ url('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}" />
    <link type="text/css" rel="stylesheet" as="style" onload="this.onload=null;this.rel='stylesheet'" href="{{ url('assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css') }}" />
    <link type="text/css" rel="stylesheet" as="style" onload="this.onload=null;this.rel='stylesheet'" href="{{ url('assets/vendor/libs/datatables-fixedcolumns-bs5/fixedcolumns.bootstrap5.css') }}" />
    <link type="text/css" rel="stylesheet" as="style" onload="this.onload=null;this.rel='stylesheet'" href="{{ url('assets/vendor/libs/datatables-fixedheader-bs5/fixedheader.bootstrap5.css') }}" />
    <link type="text/css" rel="stylesheet" as="style" onload="this.onload=null;this.rel='stylesheet'" href="{{ url('assets/vendor/libs/%40form-validation/form-validation.css') }}" />
    <link type="text/css" rel="stylesheet" as="style" onload="this.onload=null;this.rel='stylesheet'" href="{{ url('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
    <link type="text/css" rel="stylesheet" as="style" onload="this.onload=null;this.rel='stylesheet'" href="{{ url('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css') }}" />
    <link type="text/css" rel="stylesheet" as="style" onload="this.onload=null;this.rel='stylesheet'" href="{{ url('assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    <!-- Helpers -->
    <script src="{{ url('assets/vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{ url('assets/vendor/js/template-customizer.js') }}"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ url('assets/js/config.js') }}"></script>
    <script type="text/javascript">
        const _token  = '{{ csrf_token() }}'; 
    </script>
</head>
<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @include('layout.left-menu')
            <!-- Content wrapper -->
            <div class="content-wrapper">