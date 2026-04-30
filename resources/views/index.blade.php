<!DOCTYPE html>
<html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="{{ url('assets') }}/" data-template="vertical-menu-template" data-style="light">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="author" content="Suraj Vishwakarma ~ surajvishwakarma319@gmail.com" />
    <title>Login</title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ url('favicon.ico') }}" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&amp;ampdisplay=swap" type="text/css" rel="stylesheet" as="style" onload="this.onload=null;this.rel='stylesheet'">
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
    <link type="text/css" rel="stylesheet" as="style" onload="this.onload=null;this.rel='stylesheet'" href="{{ url('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
    <!-- Vendor -->
    <link type="text/css" rel="stylesheet" as="style" onload="this.onload=null;this.rel='stylesheet'" href="{{ url('assets/vendor/libs/%40form-validation/form-validation.css') }}" />
    <!-- Page CSS -->
    <!-- Page -->
    <link type="text/css" rel="stylesheet" as="style" onload="this.onload=null;this.rel='stylesheet'" href="{{ url('assets/vendor/css/pages/page-auth.css') }}">
    <!-- Helpers -->
    <script src="{{ url('assets/vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{ url('assets/vendor/js/template-customizer.js') }}"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ url('assets/js/config.js') }}"></script>
</head>
<body>
    <!-- Content -->
    <div class="authentication-wrapper authentication-cover">
        <!-- Logo -->
        <a href="{{ url('') }}" class="auth-cover-brand d-flex align-items-center gap-2">
            <span class="app-brand-logo-login demo">
                <img src="{{ url('assets/img/logo/logo.png') }}" alt="" class="clientLogo" style="width: 100px !important;" />
            </span>
        </a>
        <!-- /Logo -->
        <div class="authentication-inner row m-0">
            <!-- /Left Section -->
            <div class="d-none d-lg-flex col-lg-7 col-xl-8 align-items-center justify-content-center p-12 pb-2">
                <img src="{{ url('assets/img/illustrations/auth-login-illustration-light.png') }}" class="auth-cover-illustration w-100" />
                <img src="{{ url('assets/img/illustrations/auth-cover-register-mask-light.png') }}" class="authentication-image" alt="mask" />
            </div>
            <!-- /Left Section -->
            <!-- Login -->
            <div class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg position-relative py-sm-12 px-12 py-6">
                <div class="w-px-410 mx-auto pt-5 pt-lg-0">
                    <h4 class="mb-1">Welcome to Login Page!👋</h4>
                    <form id="loginAuthentication" method="post" class="mb-5" action="{{ url('authenticate') }}">
                        @csrf
                        <div class="form-floating form-floating-outline mb-5">
                            <input type="text" class="form-control" id="email" name="email" placeholder="Enter your login email" autofocus />
                            <label for="email">Email</label>
                        </div>
                        <div class="mb-5">
                            <div class="form-password-toggle">
                                <div class="input-group input-group-merge">
                                    <div class="form-floating form-floating-outline">
                                        <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                                        <label for="password">Password</label>
                                    </div>
                                    <span class="input-group-text cursor-pointer"><i class="ri-eye-off-line"></i></span>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary d-grid w-100">Sign in</button>
                    </form>
                    <p class="text-center">
                        <span>New on our platform?</span>
                        <a href="{{ url('register') }}">
                            <span>Create an account</span>
                        </a>
                    </p>
                </div>
            </div>
            <!-- /Login -->
        </div>
    </div>
    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ url('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ url('assets/vendor/libs/popper/popper.js') }}"></script>
    <script defer src="{{ url('assets/vendor/js/bootstrap.js') }}"></script>
    <script defer src="{{ url('assets/vendor/libs/node-waves/node-waves.js') }}"></script>
    <script defer src="{{ url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script defer src="{{ url('assets/vendor/libs/hammer/hammer.js') }}"></script>
    <script defer src="{{ url('assets/vendor/libs/i18n/i18n.js') }}"></script>
    <script defer src="{{ url('assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>
    <script defer src="{{ url('assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script defer src="{{ url('assets/vendor/libs/%40form-validation/popular.js') }}"></script>
    <script defer src="{{ url('assets/vendor/libs/%40form-validation/bootstrap5.js') }}"></script>
    <script defer src="{{ url('assets/vendor/libs/%40form-validation/auto-focus.js') }}"></script>
    <script defer src="{{ url('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    <script defer src="{{ url('assets/vendor/libs/block-ui/block-ui.js') }}"></script>

    <!-- Main JS -->
    <script defer src="{{ url('assets/js/main.js') }}"></script>
    <!-- Page JS -->
    <script defer src="{{ url('assets/js/app.js') }}"></script>
</body>
</html>