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
  
  @yield('css')
  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Styles -->
  



  <body>
    <!-- Insert these scripts at the bottom of the HTML, but before you use any Firebase services -->

    <!-- Firebase App (the core Firebase SDK) is always required and must be listed first -->
    <!-- <script src="https://www.gstatic.com/firebasejs/8.1.1/firebase-app.js"></script> -->
    <!-- <script src="https://www.gstatic.com/firebasejs/8.1.1/firebase-messaging.js"></script> -->
    <!-- If you enabled Analytics in your project, add the Firebase SDK for Analytics -->
    <!-- <script src="https://www.gstatic.com/firebasejs/8.1.1/firebase-analytics.js"></script> -->

    <!-- Add Firebase products that you want to use -->
    <!-- <script src="https://www.gstatic.com/firebasejs/8.1.1/firebase-auth.js"></script> -->
    <!-- <script src="https://www.gstatic.com/firebasejs/8.1.1/firebase-firestore.js"></script> -->
  </body>

 <!--  <script>
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
</script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script> -->
<!-- <script src="https://unpkg.com/axios/dist/axios.min.js"></script> -->
</head>
<body>
  <div id="app">
    <nav class="navbar navbar-expand-md navbar-dark shadow-sm navbar-laravel" style="background-color:{{$navColor}} !important">
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


            <!-- SEBAGAI TAMU -->
            @guest 
            <li class="nav-item">
              <a class="nav-link" href="{{route('produk')}}">Produk</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('blog') }}">Blog</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('tanya.dokter')}}">Tanya Dokter</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('nearby')}}">Nearby</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('about')}}">Tentang Kami</a>
            </li>
            <li class="nav-item">
              <a class="btn btn-outline-warning" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>&nbsp;
            @if (Route::has('register'))
            <li class="nav-item">
              <a class="btn btn-warning" href="{{ route('register') }}">Daftar</a>
            </li>
            @endif
            @else
            <!-- END SEBAGAI TAMU -->

            <!-- SEBAGAI ADMIN -->
            @if($guard == 'admin')
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li class="nav-item dropdown">
              <a id="adminDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                Pesanan <span class="caret"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="adminDropdown">
                <a href="{{route('admin.pesanan')}}" class="dropdown-item">Pesanan (belum konfirmasi)</a>
                <a href="{{route('admin.riwayatpesanan')}}" class="dropdown-item">Riwayat Pesanan</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a id="adminDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                Manage Barang <span class="caret"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="adminDropdown">
                <a href="{{route('barang.index')}}" class="dropdown-item">Semua Barang</a>
                <a href="{{route('barang.create')}}" class="dropdown-item">Tambah Barang</a>
              </div>
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
            <li class="nav-item dropdown">
              <a id="adminDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                Manage Dokter <span class="caret"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="adminDropdown">
                <a href="{{route('admin.dokter')}}" class="dropdown-item">Dokter (Belum konfirmasi)</a>
                <a href="{{route('admin.dokteraktif')}}" class="dropdown-item">Dokter (Terkonfirmasi))</a>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('manage.user') }}">Manage User</a>
            </li>
            <li class="nav-item dropdown">
              <a id="adminDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::guard('admin')->user()->name }} (ADMIN) <span class="caret"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="adminDropdown">
                <a href="{{route('admin.dashboard')}}" class="dropdown-item">Dashboard</a>
                <a class="dropdown-item" href="{{ route('admin.profile') }}">Profile</a>
                <a class="dropdown-item" href="#" onclick="event.preventDefault();document.querySelector('#admin-logout-form').submit();">
                  Logout
                </a>
                <form id="admin-logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </div>
            </li>
            <!-- END SEBAGAI ADMIN -->

            <!-- SEBAGAI USER -->
            @elseif($guard == 'user')
            <li class="nav-item">
              <a class="nav-link" href="{{route('home')}}">Home</a>
            </li>
            <li class="nav-item dropdown">
              <a id="adminDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                Pesanan <span class="caret"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="adminDropdown">
                <a href="{{route('user.pesanan')}}" class="dropdown-item">Pesanan (belum konfirmasi)</a>
                <a href="{{route('user.pesanan_riwayat')}}" class="dropdown-item">Riwayat Pesanan</a>
                <a href="{{route('user.pesanan_batal')}}" class="dropdown-item">Dibatalkan</a>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('produk')}}">Produk</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('blog') }}">Blog</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('tanya.dokter')}}">Tanya Dokter</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('nearby')}}">Nearby</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('about')}}">Tentang Kami</a>
            </li>
            <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
              </a>

              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('user.profile') }}">Profile</a>
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
        <!-- END SEBAGAI USER -->

        <!-- SEBAGAI DOKTER -->
        @elseif($guard == 'dokter')
        <li class="nav-item">
          <a class="nav-link" href="{{route('dokter.chat')}}">Tanya Dokter</a>
        </li>
        <li class="nav-item dropdown">
          <a id="adminDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            {{ Auth::guard('dokter')->user()->name }} (Dokter) <span class="caret"></span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="adminDropdown">
            <a href="{{route('dokter.dashboard')}}" class="dropdown-item">Dashboard</a>
            <a href="{{route('dokter.profile')}}" class="dropdown-item">Profile</a>
            <a class="dropdown-item" href="#" onclick="event.preventDefault();document.querySelector('#admin-logout-form').submit();">
              Logout
            </a>
            <form id="admin-logout-form" action="{{ route('dokter.logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </div>
        </li>
        <!-- END SEBAGAI DOKTER -->


        @else
        <li class="nav-item">
          <a class="nav-link" href="{{route('produk')}}">Produk</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('blog') }}">Blog</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('tanya.dokter')}}">Tanya Dokter</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('nearby')}}">Nearby</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('about')}}">Tentang Kami</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-outline-warning" href="{{ route('login') }}">{{ __('Login') }}</a>
        </li>&nbsp;
        @if (Route::has('register'))
        <li class="nav-item">
          <a class="btn btn-warning" href="{{ route('register') }}">Daftar</a>
        </li>
        @endif
        @endif

        @endguest
      </ul>
    </div>
  </div>
</nav>

<main class="py-4 bg-white">
  @if($guard == 'dokter')
  @if(Auth::guard('dokter')->user()->status != '1')
  <div class="container">
    <div class="row col-md-12 justify-content-center">
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        Akun anda belum diverifikasi, abaikan jika Anda telah mengisi keterangan saat mendaftar dan tunggu konfirmasi Admin ! isi keterangan <a href="{{route('dokter.profile')}}" class="alert-link">disini</a>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    </div>
  </div>
  @endif
  @endif
  @yield('content')
  <footer class="pt-4 my-md-5 pt-md-5 border-top text-center container">
    <div class="row">
      <div class="col-4 col-md">
        <h5>Features</h5>
        <ul class="list-unstyled text-small">
          <li><a class="text-muted" href="#">Live Chat</a></li>
          <li><a class="text-muted" href="#">Pet Shop</a></li>
          <li><a class="text-muted" href="#">Nearby</a></li>
        </ul>
      </div>
      <div class="col-4 col-md">
        <h5>Resources</h5>
        <ul class="list-unstyled text-small">
          <li><a class="text-muted" href="#">Laravel</a></li>
          <li><a class="text-muted" href="#">jQuery</a></li>
        </ul>
      </div>
      <div class="col-4 col-md">
        <h5>About</h5>
        <ul class="list-unstyled text-small">
          <li><a class="text-muted" href="#">Email</a></li>
          <li><a class="text-muted" href="#">Phone</a></li>
        </ul>
      </div>
    </div>
  </footer>
</main>

</div>


</body>

<script src="{{ asset('js/jquery-3.4.1.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript"></script>
@yield('js')

</html>
