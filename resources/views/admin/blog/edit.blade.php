@extends('layouts.app')

@section('title') | Admin | Blog-edit @endsection
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        Berhasil Mengubah Blog ! <a href="{{route('blog.edit', session('success'))}}">sunting</a> atau <a href="{{route('blog.detail', session('success'))}}">tinjau</a>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
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
              <div class="form-group col-md-12">
                <label for="inputEmail4">Judul</label>
                <input type="text" class="form-control" id="inputEmail4" name="judul" value="{{old('judul', $data->judul)}}">
              </div>
              <div class="form-group col-md-6">
                <img id="preview" src="{{asset('storage/'.$data->gambar)}}" width="90px" height="90px">
              </div>
              <div class="form-group col-md-6">
                <label for="exampleFormControlFile1">Gambar</label>
                <input type="file" onchange="tampilkanPreview(this,'preview')" accept="image/*" class="form-control-file" id="exampleFormControlFile1" name="gambar">
              </div>
            <div class="form-group col-md-12">
              <textarea class="ckeditor" id="ckeditor" rows="8" name="artikel">{{old('artikel', $data->artikel)}}</textarea>
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
<script type="text/javascript">
  function tampilkanPreview(gambar, idpreview) {
    //membuat objek gambar
    var gb = gambar.files;
    //loop untuk merender gambar
    for (var i = 0; i < gb.length; i++) {
      //bikin variabel
      var gbPreview = gb[i];
      var imageType = /image.*/;
      var preview = document.getElementById(idpreview);
      var reader = new FileReader();
      if (gbPreview.type.match(imageType)) {
        //jika tipe data sesuai
        preview.file = gbPreview;
        reader.onload = (function(element) {
          return function(e) {
            element.src = e.target.result;
          };
        })(preview);
        //membaca data URL gambar
        reader.readAsDataURL(gbPreview);
      } else {
        //jika tipe data tidak sesuai
        alert("Type file tidak sesuai. Khusus image.");
      }
    }
  }
</script>
@endsection
