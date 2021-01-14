@extends('layouts.app')

@section('title') | Admin | Barang-create @endsection
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        Berhasil Menambah Barang ! <a href="{{route('barang.edit', session('success'))}}">sunting</a> atau <a href="{{route('produk.detail', session('success'))}}">tinjau</a>
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
          <form action="{{route('barang.store')}}" method="POST" accept="image/*" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-md-6">
                <h3>Tambah Barang Baru</h3>
              </div> 
              <div class="col-md-6">
                <button class="btn btn-outline-primary float-right" role="button" type="submit"><i class="fa fa-share-square"></i> Publish</button>
              </div>
            </div>
            <br>
            <hr>
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <div class="col-md-12 row">
                    <label for="inputEmail4">Nama Barang</label>
                    <input type="text" class="form-control" id="inputEmail4" name="nama" value="{{old('nama')}}">
                  </div>
                  <div class="col-md-12 row">
                    <label for="inputEmail4">Harga</label>
                    <input type="text" class="form-control" id="inputEmail4" name="harga" value="{{old('harga')}}">
                  </div>
                  <div class="col-md-12 row">
                    <div class="row">
                      <div class="col-md-6">
                        <label for="inputEmail4">Stok</label>
                        <input type="number" class="form-control" id="inputEmail4" name="stok" value="{{old('stok')}}">
                      </div>
                      <div class="col-md-6">
                        <label for="inputEmail4">Berat</label>
                        <input type="number" class="form-control" id="inputEmail4" name="berat" value="{{old('berat')}}">
                      </div>
                    </div>
                  </div>
                  
                </div>
                <div class="col-md-6 ">
                  <div class="form-group row col-md-12">
                    <img id="preview" src="{{asset('picture.png')}}" width="90px" height="90px">
                  </div>
                  <div class="form-group row col-md-12">
                    <label for="exampleFormControlFile1">Gambar Utama</label>
                    <input type="file" onchange="tampilkanPreview(this,'preview')" accept="image/*" class="form-control-file" id="exampleFormControlFile1" name="gambar">
                  </div>
                </div>
                
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <label for="ckeditor">Keterangan</label>
                  <textarea class="ckeditor form-control" id="ckeditor" rows="8" name="keterangan">{{old('keterangan')}}</textarea>
                </div>
              </div>
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
