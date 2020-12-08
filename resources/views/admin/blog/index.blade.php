@extends('layouts.app')

@section('title') | Admin | Blog @endsection
@section('content')
<div class="container">
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
          <h3>Manage Blog</h3>
        </div>
        <div class="col-md-6">
          <a class="btn btn-outline-primary float-right" href="{{route('blog.create')}}" role="button"><i class="fa fa-plus"></i> Tambah Blog</a>
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
          @if($data == '')
          <tr>
              <td class="text-danger text-center" colspan="4">Belum ada blog !</td>
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
        {{$data->links()}}
      </div>
    </div>
  </div>
</div>
@endsection

