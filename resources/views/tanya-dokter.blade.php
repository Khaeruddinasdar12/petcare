@extends('layouts.app')

@section('title') | Tanya dokter @endsection

@section('css')
<style type="text/css">
  .card .btn {
    z-index: 1;
  }
</style>
@endsection
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-6">
      <h2><i class="fa fa-user-md"></i> Dokter <i>MyPets</i></h2>
    </div>
    <div class="col-md-6">

      <a href="{{route('dokter.register')}}" class="float-right btn btn-outline-success"><i class="fa fa-user-md"></i> Daftar dokter</a>
    </div>
    
    
  </div>
  
  <br>
  <form action="{{route('tanya.dokter')}}" method="get">
    <div class="row">
      <div class="col-md-12">
        <div class="input-group mb-4">
          <input type="text" class="form-control" @if(\Request::get('cari') != '') value="{{\Request::get('cari')}}" @else placeholder="cari nama dokter.." @endif aria-describedby="button-addon2" name="cari">
          <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fa fa-search"></i></button>
          </div>
        </div>
      </div>
    </div>
  </form>
  @if($data->isEmpty())
  <h4 class="text-center justify-content-center text-muted">Dokter tidak ditemukan !</h4>
  @else
  <div class="card-deck mb-3">
    @foreach($data as $datas)
    <div class="col-md-4">
      <div class="card h-100 position-relative" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title text-success"><i class="fa fa-user-md"></i> {{$datas->name}}</h5>
          <h6 class="card-subtitle mb-2 text-muted">dokter hewan</h6>
          <p class="card-text">{!! substr($datas->keterangan, 0, 50) !!}</p>
          <a href="{{route('profile.dokter', $datas->id)}}" class="stretched-link"></a>
          
        </div>
        <div class="card-footer alert-light">
          <form action="{{route('user.chat')}}" method="post">
            @csrf
            <input type="hidden" name="idDokter" value="{{$datas->id}}">
            <button class="btn btn-sm btn-primary stretched-link position-relative"><i class="fa fa-comments"></i> Mulai chat</button>
          </form>
          
        </div>
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
