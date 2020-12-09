@extends('layouts.app')

@section('css')
<style type="text/css">
  .row .btn {
    z-index: 1;
  }
</style>
@endsection
@section('content')
<div class="container">
  <h2 class="justify-content-center text-center"><i class="fa fa-search"></i> Produk</h2>
  <br>
  <form action="{{route('produk')}}" method="get">
    <div class="input-group mb-3">
      <input type="text" class="form-control" @if(\Request::get('cari') != '') value="{{\Request::get('cari')}}" @else placeholder="cari nama barang.." @endif aria-describedby="button-addon2" name="cari">
      <div class="input-group-append">
        <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fa fa-search"></i></button>
      </div>
    </div>
  </form>
  @if($data->isEmpty())
  <h4 class="text-center justify-content-center text-muted">Barang tidak ditemukan !</h4>
  @else
  <div class="row mb-2">
    @foreach($data as $datas)
    <div class="col-md-6">
      <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-dark">Our Produk</strong>
          <h3 class="mb-0">{{$datas->nama}}</h3>
          <div class="mb-1 text-muted">Rp. {{format_uang($datas->harga)}}</div>
          <p class="mb-auto">{!! substr($datas->keterangan, 0, 50) !!}</p>
          <a href="{{route('produk.detail', $datas->id)}}" class="stretched-link"></a>
          <a href="{{route('produk.detail', $datas->id)}}" class="btn btn-success btn-sm">Beli sekarang</a>
        </div>
        @if($datas->gambar == '')
        <div class="col-auto d-none d-lg-block">
          <img src="{{asset('picture.png')}}" alt="..." class="rounded-circle mx-auto d-block" height="240px" width="240">
        </div>
        @else 
        <div class="col-auto d-none d-lg-block">
          <img src="{{asset('storage/'.$datas->gambar)}}" alt="..." class="rounded-circle mx-auto d-block" height="240px" width="240">
        </div>
        @endif
        
      </div>
    </div>
    @endforeach
    @endif
  </div>
  {{$data->links()}}
</div>
</div>
@endsection

@section('js')

@endsection
