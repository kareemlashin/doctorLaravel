<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from azim.commonsupport.com/Docpro/doctors-dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 09 Feb 2021 15:41:36 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

    <title>    namePage</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fav Icon -->
    <link rel="icon" href="{{asset('assets/images/favicon.ico')}}" type="image/x-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">

    <!-- Stylesheets -->
    <link href="{{asset('assets/css/font-awesome-all.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/flaticon.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/owl.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/jquery.fancybox.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/color.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/nice-select.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/responsive.css')}}" rel="stylesheet">
    <style>
        .color-white {
            color: #ffffff;
            width: 50px;
            height: 50px;
        }

    </style>
    @yield('linkCss')
</head>


<!-- page wrapper -->
<body>

<div class="boxed_wrapper">

    <!-- preloader -->
    <div class="preloader"></div>

    <!-- preloader -->


    <!-- main header -->
    <header class="main-header style-three">

        <!-- header-lower -->
        <div class="header-lower">
            <div class="outer-box clearfix">
                <div class="left-column pull-left">
                    <div class="logo-box">
                        <figure class="logo"><a href="{{route('homePatient')}}"><img src="assets/images/logo-3.png" alt=""></a></figure>
                    </div>
                    <div class="menu-area">
                        <!--Mobile Navigation Toggler-->
                        <div class="mobile-nav-toggler">
                            <i class="icon-bar"></i>
                            <i class="icon-bar"></i>
                            <i class="icon-bar"></i>
                        </div>
                        <nav class="main-menu navbar-expand-md navbar-light">
                            <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">

                            </div>
                        </nav>
                    </div>
                </div>
                <div class="right-column pull-right">
                    <div class="author-box">
                        <div class="author">
                            <figure class="author-image"><img width="50px" height="50px" src="{{asset($patient->patient->profile)}}" alt=""></figure>
                            <div class="select-box">
                                <select class="wide">
                                    <option data-display="{{$patient->name}}">{{$patient->name}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--sticky Header-->
        <div class="sticky-header">
            <div class="auto-container">
                <div class="outer-box">
                    <div class="logo-box">
                        <figure class="logo"><a href="{{route('homePatient')}}"><img src="assets/images/small-logo.png" alt=""></a></figure>
                    </div>
                    <div class="menu-area">
                        <nav class="main-menu clearfix">
                            <!--Keep This Empty / Menu will come through Javascript-->
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- main-header end -->

    <!-- Mobile Menu  -->
    <div class="mobile-menu">
        <div class="menu-backdrop"></div>
        <div class="close-btn"><i class="fas fa-times"></i></div>

        <nav class="menu-box">
            <div class="nav-logo"><a href="{{route('homePatient')}}"><img src="{{asset($patient->patient->profile)}}" alt="" title=""></a></div>
            <div class="menu-outer"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
            <div class="contact-info">
                <h4>{$patient->name}}</h4>
                <ul>
                    <li>Chicago 12, Melborne City, USA</li>
                    <li><a href="tel:+8801682648101">+88 01682648101</a></li>
                    <li><a href="mailto:info@example.com">info@example.com</a></li>
                </ul>
            </div>
            <div class="social-links">
                <ul class="clearfix">
                    <li><a href="{{route('homePatient')}}"><span class="fab fa-twitter"></span></a></li>
                    <li><a href="{{route('homePatient')}}"><span class="fab fa-facebook-square"></span></a></li>
                    <li><a href="{{route('homePatient')}}"><span class="fab fa-pinterest-p"></span></a></li>
                    <li><a href="{{route('homePatient')}}"><span class="fab fa-instagram"></span></a></li>
                    <li><a href="{{route('homePatient')}}"><span class="fab fa-youtube"></span></a></li>
                </ul>
            </div>
        </nav>
    </div><!-- End Mobile Menu -->


    <!--page-title-two-->
    <section class="page-title-two">
        <div class="title-box centred bg-color-2">
            <div class="pattern-layer">
                <div class="pattern-1" style="background-image: url(assets/images/shape/shape-70.png);"></div>
                <div class="pattern-2" style="background-image: url(assets/images/shape/shape-71.png);"></div>
            </div>
            <div class="auto-container">
                <div class="title">
                    <h1>Patient Dashboard</h1>
                </div>
            </div>
        </div>
        <div class="lower-content">
            <ul class="bread-crumb clearfix">
                <li><a href="{{route('homePatient')}}">Home</a></li>
                <li>Patient Dashboard</li>
            </ul>
        </div>
    </section>
    <!--page-title-two end-->


    <!-- patient-dashboard -->
    <section class="patient-dashboard bg-color-3">
        <div class="left-panel">
            <div class="profile-box patient-profile">
                <div class="upper-box">
                    <figure class="profile-image"><img src="{{asset($patient->patient->profile)}}" alt=""></figure>
                    <div class="title-box centred">
                        <div class="inner">
                            <h3>{{$patient->name}}</h3>
                            <p><i class="fas fa-calendar-alt"></i>{{$patient->patient->birthday}},  {{$patient->patient->age}} Years</p>
                        </div>
                    </div>
                </div>
                <div class="profile-info">
                    <ul class="list clearfix">
                        <li><a href="{{route('homePatient')}}" class="current"><i class="fas fa-columns"></i>Dashboard</a></li>
                        <li><a href="{{route('patientProfile')}}" class="current"><i class="fas fa-columns"></i>profile</a></li>
                        <li><a href="{{route('editProfilePatient')}}" class="current"><i class="fas fa-columns"></i>edit profile</a></li>
                        <li><a href=""><i class="fas fa-heart"></i>all Doctors</a></li>
                        <li><a href=""><i class="fas fa-heart"></i>all posts</a></li>
                        <li><a href="{{route('addSyndrome')}}"><i class="fas fa-heart"></i>add syndrome</a></li>
                        <li><a href="{{route('tableSyndromes')}}"><i class="fas fa-heart"></i> table Syndromes</a></li>

                        <li><a href="{{route('addDiseases')}}"><i class="fas fa-heart"></i>add Diseases</a></li>
                        <li><a href="{{route('tableDiseases')}}"><i class="fas fa-heart"></i> table Diseases</a></li>
                        <li><a href="{{route('addMedicalTest')}}"><i class="fas fa-heart"></i>add Medical Test</a></li>
                        <li><a href="{{route('tableMedicalTest')}}"><i class="fas fa-heart"></i> table Medical Test</a></li>

                        <li><a href="{{route('addXray')}}"><i class="fas fa-heart"></i>add Xray </a></li>
                        <li><a href="{{route('tableXray')}}"><i class="fas fa-heart"></i> table Xray </a></li>



                        <li><a href=""><i class="fas fa-heart"></i>all product</a></li>
                        <li><a href=""><i class="fas fa-heart"></i>all product</a></li>
                        <li><a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i>
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>

                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="right-panel">

            <div class="content-container">
                <div class="outer-container">

                    @yield('content')

                </div>
            </div>

        </div>

    </section>
    <!-- patient-dashboard -->


    <!-- main-footer -->


    <!--Scroll to top-->
    <button class="scroll-top scroll-to-target" data-target="html">
        <span class="fa fa-arrow-up"></span>
    </button>
</div>

<!-- jequery plugins -->
<script src="{{asset('assets/js/jquery.js')}}"></script>
<script src="{{asset('assets/js/popper.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/owl.js')}}"></script>
<script src="{{asset('assets/js/wow.js')}}"></script>
<script src="{{asset('assets/js/validation.js')}}"></script>
<script src="{{asset('assets/js/jquery.fancybox.js')}}"></script>
<script src="{{asset('assets/js/appear.js')}}"></script>
<script src="{{asset('assets/js/scrollbar.js')}}"></script>
<script src="{{asset('assets/js/tilt.jquery.js')}}"></script>
<script src="{{asset('assets/js/jquery.paroller.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.nice-select.min.js')}}"></script>
<script src="{{asset('assets/js/product-filter.js')}}"></script>

<!-- map script -->
<script src="{{asset('js.bundle.js')}}"></script>
<script src="{{asset('assets/js/gmaps.js')}}"></script>
<script src="{{asset('assets/js/map-helper.js')}}"></script>

<!-- main-js -->
<script src="{{asset('assets/js/script.js')}}"></script>
@yield('scriptJs')

</body><!-- End of .page_wrapper -->

<!-- Mirrored from azim.commonsupport.com/Docpro/doctors-dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 09 Feb 2021 15:41:50 GMT -->
</html>
