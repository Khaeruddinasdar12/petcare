@extends('layouts.app')

@section('title') | Profile Dokter @endsection
@section('content')
<div class="container " style="background-color: white">
	<div class="row">
		<div class="col-md-8 blog-main">
			<h3 class="pb-4 mb-4 font-italic border-bottom">
				Profile Dokter
			</h3>

			<div class="blog-post">
				<h2 class="blog-post-title">{{$data->name}}</h2>
				Email : {{$data->email}}
				<br>
				{!!$data->keterangan!!}
			</div>
			<br>
			<form action="{{route('user.chat')}}" method="post">
				@csrf
				<input type="hidden" name="idDokter" value="{{$data->id}}">
				<button class="btn btn-sm btn-primary stretched-link position-relative"><i class="fa fa-comments"></i> Mulai chat</button>
			</form>

		</div><!-- /.blog-main -->

		<aside class="col-md-4 blog-sidebar">
			<div class="p-4 mb-3 bg-light rounded">
				<h4 class="font-italic">Tentang Dokter</h4>
				<p class="mb-0">Dokter yang tersedia dalam sistem <em>MyPets</em> adalah dokter hewan yang telah berpengalaman dalam dunia medis hewan dan perawatan jenis-jenis hewan.</p>
			</div>
		</aside><!-- /.blog-sidebar -->

	</div><!-- /.row -->

</div><!-- /.container -->
@endsection