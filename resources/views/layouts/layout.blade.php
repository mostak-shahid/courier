<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ $company_name }}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('adminLTE/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('adminLTE/plugins/toastr/toastr.min.css')}}">
  @yield('style')
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminLTE/dist/css/adminlte.min.css')}}">
  <!-- Custom style -->
  <link rel="stylesheet" href="{{ asset('adminLTE/dist/css/custom.css')}}">
  <link rel="icon" href="{{route('image', ['url'=>$company_favicon, 'width'=>32, 'height'=>32])}}" sizes="32x32" />
  <link rel="apple-touch-icon" href="{{route('image', ['url'=>$company_favicon, 'width'=>180, 'height'=>180])}}" />
</head>
<body class="hold-transition {{$body_class}}">
<div class="{{$wrapper_class}}">
  @include('layouts.errors')
  @yield('topnav')
  @yield('sidebar_left')
  @yield('content')
  @yield('sidebar_right')
  @yield('footer')
</div>
<!-- ./wrapper -->
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
@csrf
</form>
<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('adminLTE/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('adminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- Toastr -->
<script src="{{ asset('adminLTE/plugins/toastr/toastr.min.js')}}"></script>
<script>
  jQuery(document).ready(function($){
    @if(Session::has('success'))
        toastr.success('{{Session::get('success')}}', 'Success!');
    @elseif(Session::has('error'))
        toastr.error('{{Session::get('error')}}', 'Error!');
    @endif
  });
</script>
@yield('script')
<!-- AdminLTE App -->
<script src="{{ asset('adminLTE/dist/js/adminlte.min.js')}}"></script>
</body>
</html>
