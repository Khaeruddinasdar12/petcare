@extends('layouts.app')

@section('title') | Admin | Pesanan @endsection
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
            <h3>Pesanan Pelanggan</h3>
          </div>
          <div class="col-md-6">
            <form action="{{route('admin.pesanan')}}" method="get">
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
                <th scope="col">Kurir</th>
                <th scope="col">Bukti Transfer</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              @if($data->isEmpty())
              <tr>
                <td class="text-danger text-center" colspan="9">Belum ada pesanan !</td>
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
                <td>{{$datas->kurir}} ({{$datas->service}})</td>
                <td>
                  @if($datas->bukti == '')
                  <p class="text-danger">Belum dikirim</p>
                  @else
                  <a href="{{asset('storage/'.$datas->bukti)}}"><img src="{{asset('storage/'.$datas->bukti)}}" height="90" width="90"></a>
                  @endif
                </td>
                <td>
                  <div class="row">
                    <button data-href="{{route('admin.konfirmasipesanan', $datas->id)}}" class="btn btn-outline-success btn-sm" title="Konfirmasi" data-toggle="modal" data-target="#konfirmasi"><i class="fa fa-check"></i></button>
                    <button data-href="{{route('admin.hapuspesanan', $datas->id)}}" class="btn btn-outline-danger btn-sm" title="Batalkan" data-toggle="modal" data-target="#modal-hapus"><i class="fa fa-trash"></i></button>
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

  <!-- modal konfirmasi -->
  <div class="modal modal-hapus fade" id="konfirmasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Pembelian?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="POST" id="confirm">
          @csrf
            {{ method_field('PUT') }}
          <div class="modal-body">
            <p class="text-center">Data yang telah di konfirmasi tidak dapat diubah</p>
            <hr>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-success">Ya, konfirmasi</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- end modal konfirmasi -->

  <!-- modal hapus -->
  <div class="modal modal-hapus fade" id="modal-hapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Hapus Data?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="POST" id="hapus">
          @csrf
            {{ method_field('DELETE') }}
          <div class="modal-body">
            <p class="text-center">Data yang telah di hapus tidak dapat dikembalikan lagi</p>
            <hr>
            <div class="row">
              <div class="col-md-12">
                <label>Keterangan pembatalan untuk pembeli: </label>
                <textarea class="form-control" name="keterangan"></textarea>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-danger">Ya, hapus</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- end modal hapus -->

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
    $('#modal-hapus').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget)
      var href = button.data('href')

      var modal = $(this)
      modal.find('#hapus').attr('action', href)
    })

    $('#konfirmasi').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget)
      var href = button.data('href')

      var modal = $(this)
      modal.find('#confirm').attr('action', href)
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

