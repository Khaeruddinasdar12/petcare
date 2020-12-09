@extends('layouts.app')

@section('title') | User | Pesanan @endsection
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
            <h3>Pesanan (menunggu konfirmasi admin)</h3>
          </div>
          <div class="col-md-6">
            <form action="{{route('user.pesanan')}}" method="get">
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
                <th scope="col">Bukti Transfer</th>
              </tr>
            </thead>
            <tbody>
              @if($data->isEmpty())
              <tr>
                <td class="text-danger text-center" colspan="8">Belum ada pesanan !</td>
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
                <td>
                  @if($datas->bukti == '')
                  <button type="button" data-href="{{route('user.sendbukti', $datas->id)}}" title="Kirim bukti transfer" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#upload"><i class="fa fa-upload"></i> Kirim Bukti</button>
                  @else
                  <a href="{{asset('storage/'.$datas->bukti)}}"><img src="{{asset('storage/'.$datas->bukti)}}" height="90" width="90"></a>
                  @endif
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


  <!-- Modal upload bukti transfer -->
  <div class="modal fade" id="upload" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Upload Bukti Transfer</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="" method="POST" accept="image/*" enctype="multipart/form-data" id="send">
            @csrf
            {{ method_field('PUT') }}
            <div class="form-group row col-md-12">
              <img id="preview" src="{{asset('picture.png')}}" width="210px" height="210px">
            </div>
            <div class="form-group row col-md-12">
              <label for="exampleFormControlFile1">Gambar Utama</label>
              <input type="file" onchange="tampilkanPreview(this,'preview')" accept="image/*" class="form-control-file" id="exampleFormControlFile1" name="gambar">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Upload</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- End Modal upload bukti transfer -->
  @endsection

  @section('js')
  
  <script type="text/javascript">
    $('#upload').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget)
      var href = button.data('href')

      var modal = $(this)
      modal.find('.modal-body #send').attr('action', href)
    })

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

