<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Shreyu - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('admin.assets/images/favicon.ico')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- App css -->
    <link href="{{asset('admin/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin/assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />

    @yield('css')

</head>

<body>

<!-- Begin page -->
<div id="wrapper">

@include('owner.includes.topnav')
@include('owner.includes.sidebar')


    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">
                <div class="row page-title">
                    <div class="col-md-12">
                        <nav aria-label="breadcrumb" class="float-right mt-1">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Shreyu</a></li>
                                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Starter</li>
                            </ol>
                        </nav>
                        <h4 class="mb-1 mt-0">Starter Page</h4>
                        @yield('content')

                    </div>
                </div>
            </div> <!-- container-fluid -->

        </div> <!-- content -->



        <!-- end Footer -->

    </div>


</div>
<!-- END wrapper -->

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

<!-- Vendor js -->
<script src="{{asset('admin/assets/js/vendor.min.js')}}"></script>

<!-- App js -->
<script src="{{asset('admin/assets/js/app.min.js')}}"></script>
@yield('script')
@yield('scriptjs')
</body>
</html>
