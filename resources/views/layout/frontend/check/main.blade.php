<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="eRapor SMKN 1 Krangkeng">
    <meta name="author" content="M. Ade Erik, S.Pd.">
    <title>{{ config('app.name') }} | @yield('judul_hal')</title>
    <!-- Bootstrap CSS -->
    @include('layout.frontend.check.header') 
    <style>
      .checkinv-box {
        margin-top: 3rem;
        width: 80%;
      }

      @media (max-width: 576px) {
        .checkinv-box {
          margin-top: 5rem;
          width: 90%;
        }
      }

      .checkinv-box .card{
        margin-bottom: 0;
      }

    </style>
    @stack('css')
    
</head>

<body class="hold-transition login-page">
    @yield('login_form')

    @include('layout.frontend.check.footer')   
    @stack('scripts')
  </body>
</html>