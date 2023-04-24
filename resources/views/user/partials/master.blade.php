<!DOCTYPE html>
<html lang="en">

<head>
    <base href="{{asset('')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta content="Codescandy" name="author">

     <!-- paypal -->
    
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-M8S4MT3EYG"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        
        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        
        gtag('config', 'G-M8S4MT3EYG');
        </script>

    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon/favicon.ico') }}">

    <!-- Libs CSS -->
    {{-- <link href="{{ asset('css/slick.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/slick-theme.css') }}" rel="stylesheet" /> --}}
    <link href="{{asset('../node_modules/slick-carousel/slick/slick.css')}}" rel="stylesheet" />
    <link href="{{asset('../node_modules/slick-carousel/slick/slick-theme.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/tiny-slider.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- Theme CSS -->
    <link href="{{ asset('css/simplebar.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dropzone.min.css') }}">
    
    {{-- <link rel="stylesheet" href="{{ asset('css/feather-icons.css') }}"> --}}
    <title>@yield('title')</title>
    <style>
        .user_dropdown::after{
            content: none
        }
        
    </style>
</head>

<body>

    @include('user.partials.header')
    {{-- @include('user.partials.breadcrumb') --}}
    @yield('content')

    @include('user.partials.modal-fade')

    @include('user.partials.footer')
    <!-- Libs JS -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="{{ asset('js/simplebar.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>


    <!-- Theme JS -->
    <script src="{{ asset('js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('js/countdown.js') }}"></script>
    <script src="{{ asset('js/slick.min.js') }}"></script>
    <script src="{{ asset('js/slick-slider.js') }}"></script>
    <script src="{{asset('../node_modules/slick-carousel/slick/slick.js')}}"></script>
    <script src="{{asset('../node_modules/slick-carousel/slick/slick.min.js')}}"></script>
    <script src="{{ asset('js/theme.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/min/tiny-slider.js"></script>
    <script src="{{ asset('js/zoom.js') }}"></script>
    <script src="{{ asset('js/increment-value.js') }}"></script>
    @include('user.partials.script')
    @yield('script')
</body>

</html>
