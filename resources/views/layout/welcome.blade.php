<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <meta name="robots" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="wifi maps babel : wifi hotspot maps provinsi kepulauan bangka belitung" />
    <meta property="og:title" content="wifi maps babel : wifi hotspot maps provinsi kepulauan bangka belitung" />
    <meta property="og:description" content="wifi maps babel : wifi hotspot maps provinsi kepulauan bangka belitung" />
    <meta name="format-detection" content="telephone=no">

    <!-- PAGE TITLE HERE -->
    <title>DASHBOARD - GIS</title>

    <link href="{{ asset('v1/icons/laravel_icon.png') }}" rel="icon">
    <link href="{{ asset('v1/icons/laravel_icon.png') }}" rel="apple-touch-icon">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('v1/icons/laravel_icon.png') }}">

    <link href="{{ asset('v1/vendor/jquery-nice-select/css/nice-select.css') }}" rel="stylesheet">
    @stack('before-style')
    <link href="{{ asset('v1/css/style.css') }}" rel="stylesheet">
    @stack('after-style')

</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="lds-ripple">
            <div></div>
            <div></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="javascript:void(0);" class="brand-logo">

                <div class="brand-title">
                    <h2 class="">DesignCub3</h2>
                    <span class="brand-sub-title">Tugas DesignCub3</span>
                </div>
            </a>
            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->



        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="dashboard_bar">
                                Dashboard
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>

        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="dlabnav">
            <div class="dlabnav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="mb-3"><a href="{{ route('dashboard') }}" aria-expanded="false">
                            <i class="fas fa-home"></i>
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="mb-3"><a href="{{ route('find_location') }}" aria-expanded="false">
                            <i class="fas fa-desktop"></i>
                            <span class="nav-text">Find Location</span>
                        </a>
                    </li>
                    <li class="mb-3"><a href="{{ route('email') }}" aria-expanded="false">
                            <i class="fas fa-folder"></i>
                            <span class="nav-text">Email Subscription</span>
                        </a>
                    </li>
                </li>
                </ul>
            </div>
        </div>

        <div class="content-body">
            <!-- row -->
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>



    </div>

    <!-- Required vendors -->
    <script src="{{ asset('v1/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('v1/vendor/jquery-nice-select/js/jquery.nice-select.min.js') }}"></script>
    @stack('before-scripts')
    <script src="{{ asset('v1/js/custom.min.js') }}"></script>
    <script src="{{ asset('v1/js/dlabnav-init.js') }}"></script>
    @stack('after-scripts')

    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            })
        }, 6000)
    </script>

</body>

</html>
