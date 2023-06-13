<!DOCTYPE html>
<html>
  <head>
    <title>@yield('page_title', $page_title)</title>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="{{ asset('/img/favicon.png') }}" rel="shortcut icon">
	<link rel="stylesheet" href="{{ asset('/css/admin.css') }}">
    <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;600;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/6e703c102f.js" crossorigin="anonymous"></script>
    <!-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">  -->


  </head>
  <body class="sidebar-dark">
    <div class="main-wrapper">
        @include('master.sidebar')

        <div class="page-wrapper">
            @include('master.topnavbar')

            <div class="page-content">
                @yield('konten')
            </div>
        </div>


        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_status" value="">
    </div>

    <script src="{{ asset('js/admin.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" integrity="sha512-7x3zila4t2qNycrtZ31HO0NnJr8kg2VI67YLoRSyi9hGhRN66FHYWr7Axa9Y1J9tGYHVBPqIjSE1ogHrJTz51g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @yield('my-script','')
    <script src="{{ asset('js/master.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" crossorigin="anonymous"></script> --}}
    
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
</body>
</html>