@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Selamat Datang <b>{{ Auth::guard('admin')->user()->name }}</b></div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <i>MyPets</i> adalah salah satu startup yang bergerak dibidang kesehatan hewan yang tujuannya memudahkan masyarakat untuk menemukan klinik hewan terdekat sesuai dengan lokasi tempat tinggalnya serta memudahkan juga dalam berkonsultasi langsung dengan dokter hewan.
                
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="card border-success mb-3" style="max-width: 18rem;">
              <div class="card-header text-success">Jumlah Dokter</div>
              <div class="card-body text-success">
                <h1>{{$jmldokter}}</h1>
                <p class="card-text">dokter yang terverifikasi</p>
                <a href="#" class="btn btn-outline-success btn-sm">lihat semua</a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-secondary mb-3" style="max-width: 18rem;">
            <div class="card-header text-secondary">Jumlah User</div>
          <div class="card-body text-secondary">
            <h1>{{$jmluser}}</h1>
            <p class="card-text">user yang terdaftar</p>
            <a href="#" class="btn btn-outline-secondary btn-sm">lihat semua</a>
        </div>
    </div>
</div>
<div class="col-md-3">
    <div class="card border-primary mb-3" style="max-width: 18rem;">
      <div class="card-header text-primary">Jumlah Blog</div>
      <div class="card-body text-primary">
        <h1>{{$jmlblog}}</h1>
        <p class="card-text">dibuat oleh admin dan dokter</p>
        <a href="{{route('blog.index')}}" class="btn btn-outline-primary btn-sm">lihat semua</a>
    </div>
</div>
</div>
</div>
</div>
@endsection
