<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
  <!-- Bootstrap core CSS-->
  <link href="{{ asset('/css/app.css') }}" rel="stylesheet" type="text/css">

  <!-- Custom fonts for this template-->
  <link href="{{ asset('/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="{{ asset('/css/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="{{ asset('/css/sb-admin.css') }}" rel="stylesheet" type="text/css">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
  
  <script src="{{ asset("/js/jquery.js") }}"></script>
  <!-- Core plugin JavaScript-->
  <script src="{{ asset("/js/jquery.easing.min.js") }}"></script>
  </head>
  <body>
    <div id="app">
        @include('inc.header')
        <main class="py-4">
            <div class="container">
                @include('inc.messages')
                @yield('content')
                @include('inc.footer')
            </div>
        </main>
    </div>
  </body>
</html>