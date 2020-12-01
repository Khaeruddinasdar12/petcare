@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
     <div class="jumbotron">
      <h1 class="display-4">Hello!</h1>
      <p class="lead">Pet Care Solution hadir sebagai solusi bagi kesehatan hewan peliharaan Anda, kami menyediakan berbagai peralatan, bahan dan tips-tips seputar kesehatan hewan.</p>
      <hr class="my-4">
      <p>Kunjungi terus dan ikuti perkembangan informasi dari Pet Care Solution. Tanya Dokter dan dapatkan informasi khusus seputar hewan peliharaan.</p>
      <a class="btn btn-primary btn-lg" href="#" role="button">Chat dokter</a>
    </div>
  </div>
</div>
<!-- Three columns of text below the carousel -->
<h1 class="text-center">Fitur fitur</h1>
<div class="row text-center">

  <div class="col-lg-4">
    <img src="{{asset('live-chat.png')}}" class="rounded mx-auto d-block" alt="...">
    <h4>Live Chat</h4>
    <p>Tanya dokter hewan </p>
  </div>
  <div class="col-lg-4">
    <img src="{{asset('pet-shop.png')}}" alt="..." class="rounded-circle">
    <h4>Pet Shop</h4>
    <p>Belanja kebutuhan hewan Anda</p>
  </div>
  <div class="col-lg-4">
    <img src="{{asset('location.png')}}" alt="..." class="rounded-circle">
    <h4>Nearby</h4>
    <p>Temukan toko hewan terdekat</p>
  </div>
</div>
<hr>
<br>
<br>
<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
  <h1>Artikel & Tips Terbaru</h1>
  <p class="lead">Dapatkan informasi seputar kesehatan hewan dan cara pemeliharaan hewan yang baik dan benar.</p>
</div>
<div class="card-deck">
  <div class="card">
    <img src="{{asset('picture.png')}}" alt="..." class="rounded-circle">
    <div class="card-body">
      <h5 class="card-title">Artikel & Tips</h5>
      <p class="card-text">Dapatkan informasi seputar kesehatan hewan dan cara pemeliharaan hewan yang baik dan benar.</p>
    </div>
    <div class="card-footer">
      <small class="text-muted">Last updated 3 mins ago</small>
    </div>
  </div>
  <div class="card">
    <img src="..." class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
    </div>
    <div class="card-footer">
      <small class="text-muted">Last updated 3 mins ago</small>
    </div>
  </div>
  <div class="card">
    <img src="..." class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
    </div>
    <div class="card-footer">
      <small class="text-muted">Last updated 3 mins ago</small>
    </div>
  </div>
</div>
</div> 

@endsection