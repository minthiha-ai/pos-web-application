<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg">
    <head>
        <meta charset="utf-8" />
        <title>D & S POS</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta name="csrf-token" content="{{csrf_token()}}">

        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- Layout config Js -->
        <script src="{{ asset('assets/js/layout.js') }}"></script>
        <!-- Bootstrap Css -->
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- custom Css-->
        <link href="{{ asset('assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

        {{-- Select 2 --}}
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        @yield('css')
    </head>

    <body>
        @yield('modal')
        <!-- Begin page -->
        <div id="layout-wrapper">
            <header id="page-topbar">
                <div class="layout-width">
                    <div class="navbar-header">
                        <div class="d-flex">
                            <!-- LOGO -->
                            <div class="navbar-brand-box horizontal-logo">
                                <a href="" class="logo logo-dark">
                                    <img src="{{ asset('assets/images/logo.png') }}" alt="" height="27">
                                </a>
                                <!-- Light Logo-->
                                <a href="" class="logo logo-light">
                                  
                                    <span class="logo-lg">
                                        <img src="{{ asset('assets/images/logo.png') }}" alt="" height="27">
                                    </span>
                                </a>
                            </div>
                            {{-- <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger"
                                id="topnav-hamburger-icon">
                                <span class="hamburger-icon">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </span>
                            </button> --}}

                            <!-- App Search-->
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="dropdown ms-sm-3 header-item topbar-user">
                                <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <span class="d-flex align-items-center">
                                        {{-- <img class="rounded-circle header-profile-user" src="{{ asset('assets/images/users/avatar-3.jpg') }}"
                                            alt="Header Avatar"> --}}
                                        <span class="text-start ms-xl-2">
                                            <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">D & S POS</span>
                                            <span class="d-none d-xl-block ms-1 fs-12 text-muted user-name-sub-text">Admin</span>
                                        </span>
                                    </span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <!-- item-->
                                    <h6 class="dropdown-header">Welcome Admin!</h6>
                                    
                                    <a class="dropdown-item" href="{{route('admin.logout')}}"><i
                                    class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span
                                    class="align-middle" data-key="t-logout">Logout</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- ========== App Menu ========== -->
            <div class="app-menu navbar-menu">
                <!-- LOGO -->
                <div class="navbar-brand-box">
                    <!-- Dark Logo-->
                    <a href="" class="logo logo-dark">
                        <span class="logo-sm">
                            {{-- <img src="{{ asset('assets/images/logo.png') }}" alt="" height="20"> --}}
                        </span>
                        <span class="logo-lg">
                            {{-- <img src="{{ asset('assets/images/logo-text.png') }}" alt="" height="27">  --}}
                        </span>
                        {{-- <span class="text-light">Flash Forward</span> --}}
                    </a>
                    <!-- Light Logo-->
                    <a href="" class="logo logo-light">
                        <span class="logo-sm">
                            {{-- <img src="{{ asset('assets/images/logo.png') }}" alt="" height="20"> --}}
                        </span>
                        <span class="logo-lg">
                            {{-- <img src="{{ asset('assets/images/logo-text.png') }}" alt="" height="27"> --}}
                        </span>
                        <span class="fw-bold text-light">D & S POS</span>
                    </a>
                    {{-- <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
                        id="vertical-hover">
                        <i class="ri-record-circle-line"></i>
                    </button> --}}
                </div>

                <div id="scrollbar">
                    <div class="container-fluid">

                        <div id="two-column-menu">
                        </div>
                       @include('layouts.sidebar')
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->
            <!-- Vertical Overlay-->
            <div class="vertical-overlay"></div>

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0">@yield('page_name')</h4>
                                    <div class="page-title-right">
                                        @yield('breadcrumb')
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        <div class="row mt-n2">
                            @yield('content')
                        </div>
                    </div>
                    <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
            </div>
            <!-- end main content-->
        </div>
        <!-- END layout-wrapper -->

        <!-- JAVASCRIPT -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
        <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
        <script src="{{ asset('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
        {{-- <script src="{{ asset('assets/js/plugins.js') }}"></script> --}}
        <script src="{{ asset('assets/js/pages/notifications.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ asset('assets/js/app.js') }}"></script>
        <script src="{{ asset('assets/js/index.js') }}"></script>
        <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
        
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        {{-- Sweet Alert --}}
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        {{-- Select 2 --}}
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        @yield('script')
        <script>
            $(document).ready(function() {
                let token = document.head.querySelector('meta[name="csrf-token"]')
                        
                if(token) {
                    $.ajaxSetup({
                        headers : {
                            'X-CSRF-TOKEN' : token.content
                        }
                    })
                };
            })

            function dropFunction($key) {
                document.getElementById(`myDropdown${$key}`).classList.toggle("show");
            }

            // Close the dropdown if the user clicks outside of it
            window.onclick = function (event) {
                if (!event.target.matches(".dropbtn_index")) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains("show")) {
                    openDropdown.classList.remove("show");
                    }
                }
                }
            };

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1500,
                width : '20em',
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            @if (session('success'))
                Toast.fire({
                    icon: 'success',
                    title: "success"
                });
                `{{Session::forget('success')}}`
            @endif

            @if (session('fail'))
                Toast.fire({
                    icon: 'error',
                    title: '{{session('fail')}}'
                });
                `{{Session::forget('fail')}}`
            @endif

            window.popupWindow = (url, w, h) => {
                const y = window.top.outerHeight / 2 + window.top.screenY - h / 2
                const x = window.top.outerWidth / 2 + window.top.screenX - w / 2
                return window.open(
                    url,
                    'pink-lady',
                    `toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=${w}, height=${h}, top=${y}, left=${x}`,
                )
            }
        </script>
    </body>

</html>


