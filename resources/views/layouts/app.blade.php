<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }} @yield('title')</title>

  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('fontawesome/css/all.min.css') }}" rel="stylesheet">
  <!-- Scripts -->
  

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Styles -->
  



  <body>
    <!-- Insert these scripts at the bottom of the HTML, but before you use any Firebase services -->

    <!-- Firebase App (the core Firebase SDK) is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/8.1.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.1.1/firebase-messaging.js"></script>
    <!-- If you enabled Analytics in your project, add the Firebase SDK for Analytics -->
    <!-- <script src="https://www.gstatic.com/firebasejs/8.1.1/firebase-analytics.js"></script> -->

    <!-- Add Firebase products that you want to use -->
    <script src="https://www.gstatic.com/firebasejs/8.1.1/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.1.1/firebase-firestore.js"></script>
  </body>

  <script>
  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  var firebaseConfig = {
    apiKey: "AIzaSyAlMslEpJ8rSkaA8648H0ySkis-668E-P0",
    authDomain: "chat-b1584.firebaseapp.com",
    databaseURL: "https://chat-b1584.firebaseio.com",
    projectId: "chat-b1584",
    storageBucket: "chat-b1584.appspot.com",
    messagingSenderId: "375668871045",
    appId: "1:375668871045:web:f0e8da12520d4d8e84beec",
    measurementId: "G-5GDV77GLYH"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
  // firebase.analytics();
</script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<!-- <script src="https://unpkg.com/axios/dist/axios.min.js"></script> -->
</head>
<body>
  <div id="app">
    <nav class="navbar navbar-expand-md navbar-dark bg-info shadow-sm" style="background-color:#5F9EA0 !important">
      <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
          {{ config('app.name', 'Pet Care') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav mr-auto">

          </ul>

          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
            <li class="nav-item">
              <a class="nav-link" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="">Blog</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="">Tanya Dokter</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @if (Route::has('register'))
            <li class="nav-item">
              <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
            @endif
            @else
            @if($guard == 'admin')
            <li class="nav-item">
              <a class="nav-link" href="">Dashboard</a>
            </li>
            <li class="nav-item dropdown">
              <a id="adminDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                Manage Blog <span class="caret"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="adminDropdown">
                <a href="{{route('blog.index')}}" class="dropdown-item">Semua Blog</a>
                <a href="{{route('blog.create')}}" class="dropdown-item">Tambah Blog</a>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="">Manage Dokter</a>
            </li>
            <li class="nav-item dropdown">
              <a id="adminDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::guard('admin')->user()->name }} (ADMIN) <span class="caret"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="adminDropdown">
                <a href="{{route('admin.dashboard')}}" class="dropdown-item">Dashboard</a>
                <a class="dropdown-item" href="#" onclick="event.preventDefault();document.querySelector('#admin-logout-form').submit();">
                  Logout
                </a>
                <form id="admin-logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </div>
            </li>
            @elseif($guard == 'user')
            <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
              </a>

              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            </div>
          </li>
          @elseif($guard == 'dokter')
          <li class="nav-item dropdown">
            <a id="adminDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              {{ Auth::guard('dokter')->user()->name }} (Dokter) <span class="caret"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="adminDropdown">
              <a href="{{route('dokter.dashboard')}}" class="dropdown-item">Dashboard</a>
              <a class="dropdown-item" href="#" onclick="event.preventDefault();document.querySelector('#admin-logout-form').submit();">
                Logout
              </a>
              <form id="admin-logout-form" action="{{ route('dokter.logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </div>
          </li>
          @endif
          @endguest
        </ul>
      </div>
    </div>
  </nav>

  <main class="py-4">
    @yield('content')
  </main>
</div>
</body>

@yield('js')
<script src="{{ asset('js/app.js') }}" defer></script>
</html>
