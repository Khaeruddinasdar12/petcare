@extends('layouts.app')

@section('title') | Produk - {{$data->nama}} @endsection
@section('content')
<div class="container " style="background-color: white">
	<div class="row">
		<div class="col-md-4">
			<h3 class="pb-4 mb-4 font-italic border-bottom">
				Our Product
			</h3>

			<div class="blog-post">
				<h2 class="blog-post-title">{{$data->nama}}</h2>
				@if($data->gambar != '')
				<img src="{{asset('storage/'.$data->gambar)}}" class="img-fluid mx-auto d-block" alt="Responsive image" height="200px" width="300">
				@endif
				<br>
				{!!$data->keterangan!!}
			</div>

		</div><!-- /.blog-main -->

		<div class="col-md-8">
			<div class="row p-4 mb-3 bg-light rounded">
				@if(session('success'))
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					Berhasil Membeli Barang ! <a href="{{route('user.pesanan')}}">lihat pesanan</a>
					<li>Total Pembayaran : <b>Rp. {{format_uang(session('success'))}}</b></li>
					<li>Lakukan pembayaran Di BRI a.n Widya 0111 0122 5489 900 sesuai Total Pembayaran diatas.</li>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				@elseif(session('error'))
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					{{session('error')}}
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				@endif
				@if (count($errors) > 0)
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<strong>Whoops!</strong><br><br>
					<ul>
						@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
					</ul>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				@endif
				<div class="col-md-6">
					@if(!Auth::check()) <p class="text-danger">Login untuk pembelian!</p> @endif
					<h4 class="text-muted">Rp. {{format_uang($data->harga)}}/item</h4>
					<form action="" method="" id="cek-ongkir">
						@csrf
						<input type="hidden" name="berat" id="berat-post" value="">
						
						<div class="row col-md-12">
							<label>Nama penerima :</label>
							<input class="form-control" type="text" @if(Auth::check()) value="{{ Auth::user()->name }}" @else value="" @endif name="nama" onkeyup="nama()" id="nama-send">
						</div>
						<div class="row col-md-12">
							<label>No. HP :</label>
							<input class="form-control" type="text" onkeyup="nohp()" @if(Auth::check()) value="{{ Auth::user()->nohp }}" @else value="" @endif name="nohp" id="nohp-send">
						</div>
						<div class="row col-md-12">	
							<label>Jumlah : </label>
							<div class="input-group">		
								<input type="number" class="form-control" name="jumlah" value="1" min="1" id="jumlah" onkeyup="jumlah()">
							</div>
						</div>
						<div class="row col-md-12">
							<label>Provinsi</label>
							<select class="form-control" id="provinsi" name="provinsi" onchange="show_kabupaten()" >
								<option value="">--Pilih provinsi--</option>
								@foreach($prov as $provs)
								<option value="{{$provs->id}}">{{$provs->nama}}</option>
								@endforeach
							</select>
						</div>
						<div class="row col-md-12">
							<label>Kabupaten</label>
							<select class="form-control" id="kabupaten" name="kabupaten">
								<option value="">--Pilih kabupaten-- </option>
							</select>
						</div>
						<div class="row col-md-12">
							<label>Alamat Lengkap Pengiriman :</label>
							<textarea class="form-control" id="alamat-send" onkeyup="alamat()"></textarea>
						</div>

					</div>
					<div class="col-md-6">
						<label>Kurir</label>
						<div class="row">
							<div class="col-md-6">
								<select class="form-control" id="kurir" name="kurir">
									<option value="jne">JNE</option>
									<option value="pos">POS</option>
									<option value="tiki">TIKI</option>
								</select>
							</div>
							<div class="col-md-6">
								<button class="btn btn-outline-primary" type="submit">Cek ongkir</button>
							</div>
						</div>
					</form>
					Pilih Paket Pengiriman
					<div class="" id="paket">
					</div>
					<table>
						<tr>
							<td>Kota Asal Pengiriman</td>
							<td> : </td>
							<td>Kota Makassar, Sul-sel</td>
						</tr>
						<tr>
							<td>Total barang</td>
							<td> : </td>
							<td id="matotal1">Rp. -, </td>
						</tr>
						<tr>
							<td>Ongkir</td>
							<td> : </td>
							<td id="ongkir">Rp. -, </td>
						</tr>
						<tr>
							<td>Nama service</td>
							<td> : </td>
							<td id="service"> -, </td>
						</tr>
						<tr>
							<td><b>Total Pembayaran</b></td>
							<td> : </td>
							<td id="total"><b>Rp. -, </b></td>
						</tr>
					</table>
					<br>
					<div class="row col-md-12">
						<form  method="post" action="{{route('user.transaksi', $data->id)}}">
							@csrf
							<input type="hidden" name="nama" id="nama-post" @guest value="" @else value="{{ Auth::user()->name }}" @endif >
							<input type="hidden" name="nohp" id="nohp-post" @guest value="" @else value="{{ Auth::user()->nohp }}" @endif >
							<input type="hidden" name="alamat" id="alamat-post">
							<input type="hidden" name="jumlah" id="jumlah-post">
							<input type="hidden" name="service" id="service-post">
							<input type="hidden" name="total" id="total-post" value="">
							<input type="hidden" name="kurir" id="kurir-post" value="">
							<input type="hidden" name="ongkir" id="ongkir-post" value="">
							<input type="hidden" name="kabupaten" id="kabupaten-post" value="">
							<button class="btn btn-outline-success btn-md float-right" type="submit"><i class="nav-icon fas fa-money-check" ></i> Checkout</button>
						</form>
					</div>

				</div>

			</div>

			<div class="p-4 mb-3 bg-light rounded">

				<br>
				<h3 id="total" class="text-success">Total : Rp. {{format_uang($data->harga)}}</h3>

				<p>Metode Pembayaran : </p>
				BRI a.n Widya 0111 0122 5489 900
				<li class="text-danger">Bayar sesuai dengan <b>Total Pembayaran</b>, akan muncul setelah menekan tombol beli</li>
				<li class="text-danger">Bayar sesuai dengan <b>Total Pembayaran</b>, misal Rp. 200.007 terutama 3 angka terakhir</li>
				<img src="{{asset('bri-logo.png')}}" class="img-fluid d-block" alt="Bri logo" height="140px" width="140px">
			</div>
		</div>


	</div><!-- /.row -->

</div><!-- /.container -->
@endsection

@section('js')
<script type="text/javascript">
	var harga = {!! $data->harga !!};
	function total() {
		var jumlah = document.getElementById("jumlah").value;
		var total = harga * jumlah;
		document.getElementById("total").innerHTML = 'Total : Rp. '+ rupiah(total);
	}

	function rupiah(rp){
		var	reverse = rp.toString().split('').reverse().join(''),
		ribuan 	= reverse.match(/\d{1,3}/g);
		ribuan	= ribuan.join('.').split('').reverse().join('');

		return ribuan;
	}
</script>

<script type="text/javascript">
	  // menampilkan kabupaten setelah memilih provinsi
	  function show_kabupaten() {
	  	$("#kabupaten").empty();
	  	$("#kabupaten").append("<option value=''>--Pilih kabupaten--</option>");
	  	var id_provinsi = $('#provinsi').val();
	  	$.ajax({
	  		'url': "../get-all-kabupaten/" + id_provinsi,
	  		'dataType': 'json',
	  		beforeSend: function(){
	  			$(".loader").css("display","block");
	  		},
	  		success: function(data) {
	  			jQuery.each(data, function(i, val) {
	  				$('#kabupaten').append('<option value="' + val.id + '">' + val.type +' '+ val.city_name + '</option>');
	  			});
	  			$(".loader").css("display","none");
	  		},
	  		error: function(xhr, status, error) {
	  			var error = xhr.responseJSON;
	  			if ($.isEmptyObject(error) == false) {
	  				$.each(error.errors, function(key, value) {
	  					alert(value);
	  				});
	  				$(".loader").css("display","none");
	  			}
	  		}
	  	})
	  }
  //end menampilkan kabupaten setelah memilih provinsi

  data_paket= [] ;
  berat = '{{$data->berat}}';

  //cek ongkir
  $('#cek-ongkir').submit(function(e){
  	e.preventDefault();
    // $("#loading").show();
    $('#berat-post').val(berat);
    var divIdHtml = $("#myDiv").html();
    var request = new FormData(this);
    var endpoint = "{{route('cek-ongkir')}}";
    $.ajax({
    	url: endpoint,
    	method: "POST",
    	headers: {
    		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')          
    	},
    	data: request,
    	beforeSend: function(){
    		$(".loader").css("display","block");
    	},
    	contentType: false,
    	cache: false,
    	processData: false,
      // dataType: "json",
      success: function(data) {
        // console.log(data);
        bersih();
        jQuery.each(data, function(i, val) {
          // console.log(i);
          $('#paket').append('<div class="card box-shadow"><div class="card-body"><div class="form-check"><input class="form-check-input" type="radio" onchange="code_kurir(this)" name="paket"  value="'+val.cost[0].value+'"><label class="form-check-label" for="exampleRadios1">Rp. '+rupiah(val.cost[0].value)+' '+val.description+ ' ('+val.service+')</label></div></div></div>');
          data_paket[i] = val; 
      });
        var jumlah = $('#jumlah').val();
        var kurir = $('#kurir').val();
        var kabupaten = $('#kabupaten').val();
        //set form checkout
        $('#kurir-post').val(kurir);
        $('#kabupaten-post').val(kabupaten);
        $('#jumlah-post').val(jumlah);
        //end set form checkout
        $(".loader").css("display","none");
    },
    error: function(xhr, status, error) {
    	var error = xhr.responseJSON;
    	if ($.isEmptyObject(error) == false) {
    		$.each(error.errors, function(key, value) {
    			alert(value);
    		});
    		$(".loader").css("display","none");
    	}
    }
});
});
  // end cek ongkir
  harga_pcs = "{{$data->harga}}";
  ongkir = 0;
  total= 0;
  kurir_service = '';
  function code_kurir(service) {
  	jml_brg = $('#jumlah').val()
  	ongkir = service.value;
  	subtotal = harga_pcs * jml_brg;
  // console.log(subtotal);  
  jQuery.each(data_paket, function(i, val) {
  	console.log(val);
  	if(val.cost[0].value == ongkir) {
  		kurir_service = val.service;
  		total = eval(ongkir) + eval(subtotal);
  		$('#matotal1').text('Rp. '+rupiah(subtotal));
  		$('#ongkir').text('Rp. '+rupiah(ongkir)+' '+val.service);
  		$('#total').html('<b>Rp. '+rupiah(total)+'</b>');
  		$('#service').text(val.description);
  		$('#service-post').val(kurir_service);
  	}
  });
  // set form checkout
  
  $('#ongkir-post').val(ongkir);
  $('#total-post').val(total);
  // end form checkout 
} 

function rupiah(angka){
	var reverse = angka.toString().split('').reverse().join(''),
	ribuan = reverse.match(/\d{1,3}/g);
	ribuan = ribuan.join('.').split('').reverse().join('');
	return ribuan;
}

function bersih() {
	ongkir = 0;
	total = 0;
	$('#paket').empty();
	$('#ongkir').text('Rp. -,');
	$('#service').text(' -,');
	$('#total').html('<b>Rp. -,</b>');
}

function nama() {
	var nama = document.getElementById("nama-send").value;
	$('#nama-post').val(nama);
  // console.log($('#nama').val());
}
function nohp() {
	var nohp = document.getElementById("nohp-send").value;
	$('#nohp-post').val(nohp);
}
function alamat() {
	var alamat = document.getElementById("alamat-send").value;
	$('#alamat-post').val(alamat);
}
function jumlah() {
	var alamat = document.getElementById("jumlah").value;
	$('#jumlah-post').val(alamat);
}
</script>
@endsection