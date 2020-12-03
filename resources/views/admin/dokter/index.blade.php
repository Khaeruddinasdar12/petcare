@extends('layouts.app')

@section('title') | Admin | List Dokter @endsection
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
        <div class="col-md-6">
          <h3>Manage Dokter</h3>
        </div>
        <div class="col-md-6">
          <form action="{{route('dokter.index')}}" method="get">
          <div class="input-group mb-2">
            <input type="text" class="form-control" @if(\Request::get('cari') != '') value="{{\Request::get('cari')}}" @else placeholder="cari nama.." @endif aria-describedby="button-addon2" name="cari">
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
              <th scope="col">Nama</th>
              <th scope="col">Email</th>
              <th scope="col">Keterangan</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @if($data->isEmpty())
            <tr>
              <td class="text-danger text-center" colspan="5">Dokter tidak ditemukan !</td>
            </tr>
            @else
            @php
            $no = 1;
            @endphp
            @foreach($data as $datas)
            <tr>
              <td scope="row">{{$no++}}</td>
              <td>{{$datas->name}} </td>
              <td>{{$datas->email}}</td>
              <td>{{$datas->keterangan}}</td>
              <td>
                <div class="row">
                  <a type="button" href="" title="Tinjau" class="btn btn-outline-secondary btn-sm"><i class="fa fa-eye"></i></a>
                  <a type="button" href="" title="Edit" class="btn btn-outline-primary btn-sm"><i class="fa fa-edit"></i></a>
                </div>
              </td>
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

