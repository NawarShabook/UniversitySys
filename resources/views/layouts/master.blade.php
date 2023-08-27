<!DOCTYPE html>
<html lang="en">
<style>
    #pre-loader {
        display:none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.8);
    display: flex;
    justify-content: center;
    align-items: center;
}

.university-image {
    position: absolute;
    top: 100px; /* Adjust this value to your preference */
    z-index: 1;
}

.loader-image {
    position: relative;
    z-index: 2;
}
</style>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template" />
    <meta name="author" content="potenzaglobalsolutions.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    @include('layouts.head')
</head>

<body>

    <div class="wrapper" style="font-family: 'Cairo', sans-serif">

        <!--=================================
 preloader -->

        <div id="pre-loader">
            <img style="top:200px" rel="shortcut icon" width='200' height="200" src="{{ URL::asset('assets/images/university.png') }}" class="university-image" />
            <img src="{{ URL::asset('assets/images/pre-loader/loader-01.svg')}}" alt="" class="loader-image">
        </div>

        <!--=================================
 preloader -->

        @include('layouts.main-header')

        @include('layouts.main-sidebar')

        <!--=================================
 Main content -->
        <!-- main-content -->
        <div class="content-wrapper">

            @yield('page-header')
            <div class="page-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="mb-0" style="font-family: 'Cairo', sans-serif">@yield('PageTitle')</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}" class="default-color">{{__('dashboard.name')}}</a></li>
                            <li class="breadcrumb-item active">@yield('PageTitle')</li>
                        </ol>
                    </div>
                </div>


            @yield('content')

            <!--=================================
 wrapper -->

            <!--=================================
 footer -->

            @include('layouts.footer')
        </div><!-- main content wrapper end-->
    </div>
    </div>
    </div>



    <!--=================================
 footer -->

    @include('layouts.footer-scripts')

</body>

</html>
