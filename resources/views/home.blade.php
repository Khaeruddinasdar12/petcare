@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header alert-dark">Selamat Datang <b>{{ Auth::user()->name }}</b></div>

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
              <div class="card-header text-dark alert-success">Pesanan</div>
              <div class="card-body text-success">
                <h1>{{$psn}}</h1>
                <p class="card-text">Pesanan Anda saat ini</p>
                <a href="{{route('user.pesanan')}}" class="btn btn-outline-success btn-sm">lihat semua</a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-primary mb-3" style="max-width: 18rem;">
          <div class="card-header text-dark alert-primary">Jumlah Riwayat</div>
          <div class="card-body text-primary">
            <h1>{{$rwyt}}</h1>
            <p class="card-text">Semua riwayat belanja Anda</p>
            <a href="{{route('user.pesanan_riwayat')}}" class="btn btn-outline-primary btn-sm">lihat semua</a>
        </div>
    </div>
</div> 
<div class="col-md-3">
    <div class="card border-secondary mb-3" style="max-width: 18rem;">
        <div class="card-header text-dark alert-secondary">Pesanan Dibatalkan</div>
        <div class="card-body text-secondary">
            <h1>{{$btl}}</h1>
            <p class="card-text">Pesanan Anda dibatalkan admin</p>
            <a href="{{route('user.pesanan_batal')}}" class="btn btn-outline-secondary btn-sm">lihat semua</a>
        </div>
    </div>
</div>

</div>
</div>
@endsection
