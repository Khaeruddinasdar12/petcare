@extends('layouts.app')

@section('content')
<div class="container">
  <!-- <div class="card"> -->
    <!-- <div class="card-body"> -->
      <h1 class="text-center">Tentang Kami</h1>
      <div class="row justify-content-center">
        <div class="col-md-10">
         <img src="{{asset('about.png')}}" class="img-fluid mx-auto d-block" alt="Responsive image" height="200px" width="300">
         <br>
         <p>Sesuai dengan namanya, <i>MyPets</i> adalah salah satu startup yang bergerak dibidang kesehatan hewan yang tujuannya memudahkan masyarakat untuk menemukan klinik hewan terdekat sesuai dengan lokasi tempat tinggalnya serta memudahkan juga dalam berkonsultasi langsung dengan dokter hewan.</p>
       </div>
     </div>
   
   <br>
   <div class="row justify-content-center">
    <h1 class="text-center">Fitur Unggulan</h1>
    <div class="col-md-10">
      <div class="media ">
        <img src="{{asset('live-chat.png')}}" class="align-self-center mr-3" alt="..." width="64px" height="64px">
        <div class="media-body">
          <h5 class="mt-0">Live Chat</h5>
          <p>Temukan dokter spesialis Anda yang sesuai dengan keluhan hewan Anda.</p>
          <p class="mb-0">Semua Dokter telah memenuhi standar dari pihak kedokteran hewan dan telah melalui proses validasi sesuai dengan syarat & ketentuan <i>MyPets</i></p>
        </div>
      </div>
      <hr>
      <div class="media ">
        <img src="{{asset('pet-shop.png')}}" class="align-self-center mr-3" alt="..." width="64px" height="64px">
        <div class="media-body">
          <h5 class="mt-0">Pet Shop</h5>
          <p>Berbelanja menjadi lebih hemat dan barang Anda akan kami kirimkan ke alamat Anda.</p>
          <p class="mb-0">Kami akan melayani setiap pembeli dengan ramah dan menyenangkan. Setiap pembelian akan kami kirim ke alamat Anda. Selamat Berbelanja !</p>
        </div>
      </div>
      <hr>
      <div class="media ">
        <img src="{{asset('location.png')}}" class="align-self-center mr-3" alt="..." width="64px" height="64px">
        <div class="media-body">
          <h5 class="mt-0">Nearby</h5>
          <p>Temukan Toko hewan terdekat dari lokasi Anda.</p>
          <p class="mb-0">Aplikasi ini akan membawa Anda ke Google Maps untuk mengetahui lokasi Toko Hewan terdekat dari lokasi Anda saat ini.</p>
        </div>
      </div>
    </div>
    </div>
  <!-- </div> -->
<!-- </div> -->
<br>
<br>
</div> 

@endsection