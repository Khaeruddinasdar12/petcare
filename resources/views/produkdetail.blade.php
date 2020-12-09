@extends('layouts.app')

@section('title') | Produk - {{$data->nama}} @endsection
@section('content')
<div class="container " style="background-color: white">
	<div class="row">
		<div class="col-md-8 blog-main">
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

		<aside class="col-md-4 blog-sidebar">
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
			<div class="p-4 mb-3 bg-light rounded">
				@if(!Auth::check()) <p class="text-danger">Login untuk pembelian!</p> @endif
				<h4 class="text-muted">Rp. {{format_uang($data->harga)}}/item</h4>
				<form action="{{route('user.transaksi', $data->id)}}" method="POST">
					@csrf
					{{ method_field('PUT') }}
					<div class="row col-md-12">
						<label>Nama penerima :</label>
						<input class="form-control" type="text" @if(Auth::check()) value="{{ Auth::user()->name }}" @else value="" @endif name="nama">
					</div>
					<div class="row col-md-12">
						<label>No. HP :</label>
						<input class="form-control" type="text" @if(Auth::check()) value="{{ Auth::user()->nohp }}" @else value="" @endif name="nohp">
					</div>
					<div class="row col-md-12">
						<label>Alamat pengiriman :</label>
						<textarea class="form-control" name="alamat"></textarea>
					</div>

					<div class="row col-md-12">	
						<label>Jumlah : </label>
						<div class="input-group">		
							<input type="number" class="form-control" name="jumlah" value="1" min="1" id="jumlah" onchange="total()" onkeyup="total()">
							<div class="input-group-append">
								<button class="btn btn-danger" type="submit" id="button-addon2">Beli</button>
							</div>
						</div>

					</div>
				</form>
				<br>
				<h3 id="total" class="text-success">Total : Rp. {{format_uang($data->harga)}}</h3>

				<p>Metode Pembayaran : </p>
				BRI a.n Widya 0111 0122 5489 900
				<li class="text-danger">Bayar sesuai dengan <b>Total Pembayaran</b>, akan muncul setelah menekan tombol beli</li>
				<li class="text-danger">Bayar sesuai dengan <b>Total Pembayaran</b>, misal Rp. 200.007 terutama 3 angka terakhir</li>
				<img src="{{asset('bri-logo.png')}}" class="img-fluid d-block" alt="Bri logo" height="140px" width="140px">
			</div>
		</aside><!-- /.blog-sidebar -->

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
@endsection