@extends('layouts.app')

@section('title') | Admin | Dokter - belum terkonfirmasi @endsection
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
          <h3>Dokter yang mendaftar</h3>
        </div>
        <div class="col-md-6">
          <form action="{{route('admin.dokter')}}" method="get">
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
              <th scope="col">Status</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @if($data->isEmpty())
            <tr>
              <td class="text-danger text-center" colspan="5">Dokter BELUM AKTIF tidak ditemukan !</td>
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
              <td><span class="badge badge-pill badge-warning"><i class="fa fa-exclamation-circle"></i> Belum aktif</span></td>
              <td>
                <div class="row">
                  <button type="button" data-nama="{{$datas->name}}" data-email="{{$datas->email}}" data-keterangan="{{$datas->keterangan}}" title="Lihat detail" class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#detail"><i class="fa fa-eye"></i></button>&nbsp;
                  <button type="button" data-href="{{route('admin.konfirmasidokter', $datas->id)}}" title="Konfirmasi" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#konfirmasi"><i class="fa fa-check" ></i></button>
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

 <!-- modal detail -->
  <div class="modal modal-hapus fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Detail Dokter</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
          <div class="modal-body">
            <table>
              <tr>
                <td>Nama</td>
                <td> : </td>
                <td id="nama"></td>
              </tr>
              <tr>
                <td>Email</td>
                <td> : </td>
                <td id="email"></td>
              </tr>
              <tr>
                <td>Ketarangan</td>
                <td> : </td>
                <td id="keterangan"></td>
              </tr>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          </div>
      </div>
    </div>
  </div>
  <!-- end modal detail -->

  <!-- modal konfirmasi -->
  <div class="modal modal-hapus fade" id="konfirmasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Konfirmasi dokter ?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="POST" id="confirm">
          @csrf
            {{ method_field('PUT') }}
          <div class="modal-body">
            <p class="text-center">Dokter yang telah dikonfirmasi dapat menikmati segala fitur <i>MyPets</i> dan tidak dapat diubah</p>
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
@endsection

@section('js')
<script type="text/javascript">
  $('#detail').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget)
      var nama = button.data('nama')
      var email = button.data('email')
      var keterangan = button.data('keterangan')

      var modal = $(this)
      modal.find('#nama').text(nama)
      modal.find('#email').text(email)
      modal.find('#keterangan').text(keterangan)
    })

  $('#konfirmasi').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget)
      var href = button.data('href')

      var modal = $(this)
      modal.find('#confirm').attr('action', href)
    })
</script>
@endsection

