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
    <!--     <div class="preloader"></div> -->


    <!-- main header -->
    <header class="main-header style-three">

        <!-- header-lower -->
        <div class="header-lower">
            <div class="outer-box clearfix">
                <div class="left-column pull-left">
                    <div class="logo-box">
                        <figure class="logo"><a href="{{route('homeDoctor')}}"><img
                                    src="{{asset('assets/images/logo-3.png')}}" alt=""></a></figure>
                    </div>
                    <div class="menu-area">
                        <!--Mobile Navigation Toggler-->
                        <div class="mobile-nav-toggler">
                            <i class="icon-bar"></i>
                            <i class="icon-bar"></i>
                            <i class="icon-bar"></i>
                        </div>


                    </div>
                </div>
                <div class="right-column pull-right">
                    <div class="author-box">

                        <div class="author">
                            @if($doctor->doctorprofile->profile)

                                <figure class="author-image">
                                    <img src="{{asset($doctor->doctorprofile->profile)}}" alt="">
                                </figure>
                            @else
                                <figure class="author-image">

                                     <span class="rounded-circle d-inline-block bg-danger  text-center py-2 color-white">
                                         <div class="d-flex justify-content-center align-items-center w-100 h-100">


                                         {{strtoupper(substr($doctor->name, 0, 1))}}
                                </div>
                                     </span>
                                </figure>

                            @endif
                            <div class="select-box d-flex align-items-center mt-2 ">
                                {{$doctor->name}}

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
                        <figure class="logo"><a href="{{route('homeDoctor')}}"><img
                                    src="{{asset('assets/images/small-logo.png')}}" alt=""></a></figure>
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
            <div class="nav-logo"><a href="{{route('homeDoctor')}}"><img src="{{asset('assets/images/logo-2.png')}}"
                                                                         alt="" title=""></a></div>
            <div class="menu-outer">
                <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
            <div class="contact-info">
                <h4>Contact Info</h4>
                <ul>
                    <li>Chicago 12, Melborne City, USA</li>
                    <li><a href="tel:+8801682648101">+88 01682648101</a></li>
                    <li><a href="mailto:info@example.com">info@example.com</a></li>
                </ul>
            </div>
            <div class="social-links">
                <ul class="clearfix">
                    <li><a href="{{route('homeDoctor')}}"><span class="fab fa-twitter"></span></a></li>
                    <li><a href="{{route('homeDoctor')}}"><span class="fab fa-facebook-square"></span></a></li>
                    <li><a href="{{route('homeDoctor')}}"><span class="fab fa-pinterest-p"></span></a></li>
                    <li><a href="{{route('homeDoctor')}}"><span class="fab fa-instagram"></span></a></li>
                    <li><a href="{{route('homeDoctor')}}"><span class="fab fa-youtube"></span></a></li>
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
                    <h1>Doctor</h1>
                </div>
            </div>
        </div>
        <div class="lower-content">
            <ul class="bread-crumb clearfix">
            </ul>
        </div>
    </section>
    <!--page-title-two end-->


    <!-- doctors-dashboard -->
    <section class="doctors-dashboard bg-color-3">
        <div class="left-panel">
            <div class="profile-box">
                <div class="upper-box">

                    <figure class="profile-image">
                        @if($doctor->doctorprofile->profile)
                            <img src="{{asset($doctor->doctorprofile->profile)}}"  class="max-height" alt="">

                        @else
                            <img src="{{asset('upload/image/gender_1613020276.png')}}" class="max-height" alt="">

                        @endif

                    </figure>
                    <div class="title-box centred">
                        <div class="inner">
                            <h3> {{$doctor->name}}</h3>
                            <p>MDS - Periodontology</p>
                        </div>
                    </div>
                </div>
                <div class="profile-info">
                    <ul class="list clearfix">
                        <li><a href="{{route('homeDoctor')}}"   class="{{ \Illuminate\Support\Facades\Route::is('homeDoctor') ? 'current' : '' }}"><i class="fas fa-columns"></i>Dashboard</a></li>
                        <li><a href="{{route('profileDoctor')}}" class="{{ \Illuminate\Support\Facades\Route::is('profileDoctor') ? 'current' : '' }}" ><i class="fas fa-columns"></i>profile</a></li>
                        <li><a href="{{route('editDoctor')}}" class="{{ \Illuminate\Support\Facades\Route::is('editDoctor') ? 'current' : '' }}"><i class="fas fa-columns"></i>edit profile</a></li>
                        <li><a href="{{route('specialtiesDoctor')}}" class="{{ \Illuminate\Support\Facades\Route::is('specialtiesDoctor') ? 'current' : '' }}"><i class="fas fa-columns"></i>add  specialties</a></li>
                        <li><a href="{{route('addOffer')}}" class="{{ \Illuminate\Support\Facades\Route::is('addOffer') ? 'current' : '' }}"><i class="fas fa-columns"></i>add  Offer</a></li>
                        <li><a href="{{route('addServiceview')}}" class="{{ \Illuminate\Support\Facades\Route::is('addServiceview') ? 'current' : '' }}"><i class="fas fa-columns"></i>add  Service</a></li>
                        <li><a href="{{route('addeducationview')}}" class="{{ \Illuminate\Support\Facades\Route::is('addeducationview') ? 'current' : '' }}"><i class="fas fa-columns"></i>add  education</a></li>
                        <li><a href="{{route('addtitleview')}}" class="{{ \Illuminate\Support\Facades\Route::is('addtitleview') ? 'current' : '' }}"><i class="fas fa-columns"></i>add  title</a></li>
                        <li><a href="{{route('addexperienceview')}}" class="{{ \Illuminate\Support\Facades\Route::is('addexperienceview') ? 'current' : '' }}"><i class="fas fa-columns"></i>add  new experience</a></li>
                        <li><a href="{{route('addtagview')}}" class="{{ \Illuminate\Support\Facades\Route::is('addtagview') ? 'current' : '' }}"><i class="fas fa-columns"></i>add   tag</a></li>
                        <li><a href="{{route('addpostview')}}" class="{{ \Illuminate\Support\Facades\Route::is('addpostview') ? 'current' : '' }}"><i class="fas fa-columns"></i>add  post</a></li>
                        <li><a href="{{route('getAllPosts')}}" class="{{ \Illuminate\Support\Facades\Route::is('getAllPosts') ? 'current' : '' }}"><i class="fas fa-columns"></i>all  post</a></li>

                        <li><a href="{{route('tableAllOffers')}}" class="{{ \Illuminate\Support\Facades\Route::is('tableAllOffers') ? 'current' : '' }}"><i class="fas fa-calendar-alt">

                                </i>table offer</a></li>


                        <li><a href="{{route('tableAllService')}}" class="{{ \Illuminate\Support\Facades\Route::is('tableAllService') ? 'current' : '' }}"><i class="fas fa-calendar-alt"></i>table Service</a></li>

                        <li><a href="{{route('tableAllEducation')}}" class="{{ \Illuminate\Support\Facades\Route::is('tableAllEducation') ? 'current' : '' }}"><i class="fas fa-calendar-alt"></i>table education</a></li>

                        <li><a href="{{route('tableAllExperience')}}" class="{{ \Illuminate\Support\Facades\Route::is('tableAllExperience') ? 'current' : '' }}">
                                <i class="fas fa-calendar-alt"></i>table experience</a></li>

                        <li><a href="{{route('tableAllPosts')}}" class="{{ \Illuminate\Support\Facades\Route::is('tableAllPosts') ? 'current' : '' }}">
                                <i class="fas fa-calendar-alt"></i>table post</a></li>

                        <li><a href="{{route('addClinic')}}" class="{{ \Illuminate\Support\Facades\Route::is('addClinic') ? 'current' : '' }}">
                                <i class="fas fa-calendar-alt"></i>add Clinic </a></li>

                        <li><a href="{{route('tableClinic')}}" class="{{ \Illuminate\Support\Facades\Route::is('tableClinic') ? 'current' : '' }}">
                                <i class="fas fa-calendar-alt"></i>table Clinic </a></li>

                        <li><a href=""><i class="fas fa-wheelchair"></i>My Patients</a></li>
                        <li><a href=""><i class="fas fa-plus-circle"></i>Add Listing</a></li>
                        <li><a href=""><i class="fas fa-clock"></i>Schedule Timing</a></li>
                        <li><a href=""><i class="fas fa-star"></i>Reviews</a></li>
                        <li><a href=""><i class="fas fa-comments"></i>Messages</a><span>20</span></li>
                        <li><a href=""><i class="fas fa-user"></i>My Profile</a></li>
                        <li><a href=""><i class="fas fa-unlock-alt"></i>Change Password</a></li>
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
        @yield('content')

    </section>
    <!-- doctors-dashboard -->


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
