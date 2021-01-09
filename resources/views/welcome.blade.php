@extends('layouts.app')

@section('css')
<link href="{{ asset('css/blog.css') }}" rel="stylesheet">
<style type="text/css">
  a.custom-card,
  a.custom-card:hover {
    color: inherit;
  }
 /* .card-body .btn !important{
    z-index: 1 !important;
    }*/
  </style>
  @endsection
  @section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
       <div class="jumbotron">
        <h1 class="display-4">Hello!</h1>
        <p class="lead"><em>MyPets</em> adalah salah satu startup yang bergerak dibidang kesehatan hewan yang tujuannya memudahkan masyarakat untuk menemukan klinik hewan terdekat sesuai dengan lokasi tempat tinggalnya serta memudahkan juga dalam berkonsultasi langsung dengan dokter hewan.</p>
        <p><em>MyPets</em> hadir sebagai solusi bagi kesehatan hewan peliharaan Anda, kami menyediakan berbagai peralatan, bahan dan tips-tips seputar kesehatan hewan.</p>
        <hr class="my-4">
        <p>Kunjungi terus dan ikuti perkembangan informasi dari <em>MyPets</em>. Tanya Dokter dan dapatkan informasi khusus seputar hewan peliharaan.</p>
        <a class="btn btn-primary btn-lg" href="{{route('tanya.dokter')}}" role="button">Chat dokter</a>
      </div>
    </div>
  </div>
  <!-- Three columns of text below the carousel -->
  <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <h1 class="text-center">Fitur fitur</h1>
    <p class="lead">Berikut adalah fitur yang bisa Anda gunakan di <i>MyPets</i></p>
  </div>
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
    <h1>Produk Terbaru</h1>
    <p class="lead">Dapatkan makanan atau barang kesukaan Anda di <i>MyPets</i>. Dapatkan dengan harga termurah.</p>
  </div>
  <div class="row">
    @if($brg->isEmpty())
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <p class="text-danger">Blog belum ada blog</p>
    </div>

    @else
    @foreach($brg as $barang)
    <div class="col-md-4">
      <div class="card" style="width: 18rem;">
        <img src="{{asset('storage/'.$barang->gambar)}}" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">{{$barang->nama}}</h5>
          <p class="card-text">{!! substr($barang->keterangan, 0, 50) !!} ...</p>
          <a href="{{route('produk.detail', $barang->id)}}" class="stretched-link"></a>
          <a href="{{route('produk.detail', $barang->id)}}" class="btn btn-success btn-sm stretched-link"><i class="fa fa-shopping-cart"></i> Beli sekarang</a>
        </div>
      </div>
    </div>
    @endforeach
    @endif
  </div>

  <hr>
  <br>
  <br>
  <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <h1>Artikel & Tips Terbaru</h1>
    <p class="lead">Dapatkan informasi seputar kesehatan hewan dan cara pemeliharaan hewan yang baik dan benar.</p>
  </div>
  <div class="card-deck">
    @if($data->isEmpty())
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <p class="text-danger">Blog belum ada blog</p>
    </div>

    @else
    @foreach($data as $datas)

    <div class="card">
      @if($datas->gambar == '')
      <img src="{{asset('picture.png')}}" alt="..." class="card-img-top rounded-circle mx-auto d-block" height="240px" width="240">
      @else 
      <img src="{{asset('storage/'.$datas->gambar)}}" alt="..." class="card-img-top rounded-circle mx-auto d-block" height="240px" width="240">
      @endif
      <div class="card-body">
        <h5 class="card-title">{{$datas->judul}}</h5>
      </div>
      <a href="{{route('blog.detail', $datas->slug)}}" class="custom-card stretched-link"></a> 
      <div class="card-footer bg-warning">
        <small class="text-dark" >Terakhir diubah {{$datas->updated_at}}</small>
      </div>
    </div>

    @endforeach
    @endif
  </div>
</div> 

@endsection