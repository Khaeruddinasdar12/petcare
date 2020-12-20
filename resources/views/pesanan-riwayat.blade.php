@extends('layouts.app')

@section('title') | User | Pesanan-riwayat @endsection
@section('content')
<div class="container">
  <!-- <div class="card-body"> -->
  <div class="row justify-content-center">
    <div class="col-md-10">
      @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{session('success')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <br>
      @elseif(session('error'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{session('error')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <br>
      @endif
      <div class="row">
        <div class="col-md-12 ">
        <a class="btn btn-outline-primary float-right mb-3" href="{{route('produk')}}" role="button"><i class="fa fa-shopping-cart"></i> Lihat Produk</a>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-md-6">
          <h3>Riwayat Pesanan</h3>
        </div>
        <div class="col-md-6">
          <form action="{{route('user.pesanan_riwayat')}}" method="get">
          <div class="input-group mb-2">
            <input type="text" class="form-control" @if(\Request::get('cari') != '') value="{{\Request::get('cari')}}" @else placeholder="cari nama barang.." @endif aria-describedby="button-addon2" name="cari">
            <div class="input-group-append">
              <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fa fa-search"></i></button>
            </div>
          </div>
          </form>
        </div>
      </div>
      <br>
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">No.</th>
              <th scope="col">Produk</th>
              <th scope="col">Penerima</th>
              <th scope="col">Alamat</th>
              <th scope="col">Jumlah</th>
              <th scope="col">Harga satuan</th>
              <th scope="col">Total</th>
            </tr>
          </thead>
          <tbody>
            @if($data->isEmpty())
            <tr>
              <td class="text-danger text-center" colspan="7">Belum ada riwayat !</td>
            </tr>
            @else
            @php
            $no = 1;
            @endphp
            @foreach($data as $datas)
            <tr>
              <td scope="row">{{$no++}}</td>
              <td>{{$datas->barang->nama}}</td>
              <td>{{$datas->nama}}</td>
              <td>{{$datas->alamat}}</td>
              <td>{{$datas->jumlah}}</td>
              <td>Rp. {{format_uang($datas->harga)}}</td>
              <td>Rp. {{format_uang($datas->total)}}</td>
            </tr>
            @endforeach
            @endif
          </tbody>
        </table>
      </div>
      {{$data->links()}}
    </div>
  </div>
<!-- </div> -->
</div>
@endsection

