@extends('layouts.app')

@section('title') | Admin | Blog-edit @endsection
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      @if(session('success'))
      <div class="alert alert-success">
        Berhasil Menambah Blog ! <a href="">sunting</a>
      </div>
      @elseif(session('error'))
      <div class="alert alert-danger">
        {{session('error')}}
      </div>
      @endif
      @if (count($errors) > 0)
      <div class="alert alert-danger">
        <strong>Whoops!</strong> Foto minimal 2MB<br><br>
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif
      <div class="card">
        <div class="card-body">
          <form action="{{route('blog.update', $data->id)}}" method="POST" accept="image/*" enctype="multipart/form-data">
            @csrf
            {{ method_field('PUT') }}
            <div class="row">
              <div class="col-md-6">
                <h3>Edit Blog</h3>
              </div> 
              <div class="col-md-6">
                <button class="btn btn-outline-primary float-right" role="button" type="submit"><i class="fa fa-share-square"></i> Publish</button>
              </div>
            </div>
            <br>
            <hr>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputEmail4">Judul</label>
                <input type="text" class="form-control" id="inputEmail4" name="judul" value="{{old('judul', $data->judul)}}">
              </div>
              <div class="form-group col-md-6">
                <label for="exampleFormControlFile1">Gambar</label>
                <input type="file" class="form-control-file" id="exampleFormControlFile1" name="gambar">
              </div>
            </div>
            <div class="form-group">
              <textarea class="ckeditor" id="ckeditor" rows="5" name="artikel">{{old('artikel', $data->artikel)}}</textarea>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script src="{{ asset('ckeditor/ckeditor.js') }}" defer></script>
@endsection
