@extends('layouts.app')

@section('content')
<div class="container">
  <form action="{{route('blog')}}" method="get">
    <div class="input-group mb-3">
      <input type="text" class="form-control" @if(\Request::get('cari') != '') value="{{\Request::get('cari')}}" @else placeholder="cari judul.." @endif aria-describedby="button-addon2" name="cari">
      <div class="input-group-append">
        <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fa fa-search"></i></button>
      </div>
    </div>
  </form>
  @if($data->isEmpty())
  <h2 class="text-center justify-content-center">Blog tidak ditemukan !</h2>
  @else
  <div class="row mb-2">
    @foreach($data as $datas)
    <div class="col-md-6">
      <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-success">Artikel & Tips</strong>
          <h3 class="mb-0">{{$datas->judul}}</h3>
          <div class="mb-1 text-muted">{{$datas->updated_at}}</div>
          <p class="mb-auto">{!! substr($datas->artikel, 0, 50) !!}</p>
          <a href="{{route('blog.detail', $datas->slug)}}" class="stretched-link">Continue reading</a>
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
</div>
</div>
@endsection

@section('js')

@endsection
