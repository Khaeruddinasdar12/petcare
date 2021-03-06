@extends('layouts.app')

@section('title') | Admin | Blog @endsection
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
        <a class="btn btn-outline-primary float-right mb-3" href="{{route('blog.create')}}" role="button"><i class="fa fa-plus"></i> Tambah Blog</a>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-md-6">
          <h3>Manage Blog</h3>
        </div>
        <div class="col-md-6">
          <form action="{{route('blog.index')}}" method="get">
          <div class="input-group mb-2">
            <input type="text" class="form-control" @if(\Request::get('cari') != '') value="{{\Request::get('cari')}}" @else placeholder="cari judul.." @endif aria-describedby="button-addon2" name="cari">
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
              <th scope="col">Judul</th>
              <th scope="col">Tanggal Upload</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @if($data->isEmpty())
            <tr>
              <td class="text-danger text-center" colspan="4">Belum tidak ditemukan !</td>
            </tr>
            @else
            @php
            $no = 1;
            @endphp
            @foreach($data as $datas)
            <tr>
              <td scope="row">{{$no++}}</td>
              <td>{{$datas->judul}} </td>
              <td>{{$datas->created_at}}</td>
              <td>
                <div class="row">
                  <a type="button" href="{{route('blog.detail', $datas->slug)}}" title="Tinjau" class="btn btn-outline-secondary btn-sm"><i class="fa fa-eye"></i></a>
                  <a type="button" href="{{route('blog.edit', $datas->slug)}}" title="Edit" class="btn btn-outline-primary btn-sm"><i class="fa fa-edit"></i></a>
                  <form method="POST" action="{{route('blog.destroy', $datas->id)}}">
                    @csrf
                    {{ method_field('DELETE') }}
                    <button onclick="return confirm('Yakin Hapus ?')" type="submit" title="Hapus" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash"></i></button>
                  </form>
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

