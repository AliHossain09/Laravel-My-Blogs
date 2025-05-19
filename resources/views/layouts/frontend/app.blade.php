<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="/resources/css/app.css">
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">

    <style>
        body {
          background-color: #f4f8fb;
        }
        .card-title {
          font-size: 1rem;
          font-weight: bold;
        }
        .card-footer {
          font-size: 0.9rem;
        }
        .author-img {
          width: 40px;
          height: 40px;
          border-radius: 50%;
          object-fit: cover;
        }
        .load-more {
          background-color: #cbdcf6;
        }
        footer {
          background-color: white;
          padding: 40px 0;
        }
        .gradient-advanced {
          background: radial-gradient(50% 123.47% at 50% 50%, #00ff94 0%, #720059 100%),
          linear-gradient(121.28deg, #669600 0%, #ff0000 100%),
          linear-gradient(360deg, #0029ff 0%, #8fff00 100%),
          radial-gradient(100% 164.72% at 100% 100%, #6100ff 0%, #00ff57 100%),
          radial-gradient(100% 148.07% at 0% 0%, #fff500 0%, #51d500 100%);
          background-blend-mode: screen, color-dodge, overlay, difference, normal;
}
      </style>
</head>
<body>
    @include('layouts.frontend.partial.header')
  
    @yield('content')
  
  @include('layouts.frontend.partial.footer')
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Bootstrap Icons (optional for icons used above) --> 

       
   

    
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    </body>
</html>
