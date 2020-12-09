@extends('layouts.app')

@section('title') | Dokter - profile @endsection
@section('content')
<div class="container " style="background-color: white">
	<div class="row">
		<div class="col-md-8 blog-main">
			<h3 class="pb-4 mb-4 font-italic border-bottom">
				Mohon perhatian !
			</h3>
			<div class="blog-post">
				<h2 class="blog-post-title">Syarat & Ketentuan</h2>
				<p class="blog-post-meta text-muted">Anda harus memenuhi syarat berikut untuk menjadi dokter di sistem <i>MyPets</i></p>
				
				<ul>
					<li>Harus memiliki akun dokter atau pernah mendaftar sebagai dokter.</li>
					<li>Email harus email aktif.</li>
					<li>Keterangan harus berisi kompentensi yang dimiliki.</li>
				</ul>
				
			</div>
		</div>

		<aside class="col-md-4 blog-sidebar">
			@if(session('success'))
			<div class="alert alert-success alert-dismissible fade show" role="alert">
				{{session('success')}}
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
				<form action="{{route('dokter.profile')}}" method="POST">
					@csrf
					<div class="form-group col-md-12">
						<label>Nama Lengkap :</label>
						<input class="form-control" type="text" name="nama" value="{{Auth::guard('dokter')->user()->name}}">
					</div>
					<div class="form-group col-md-12">
						<label>Email :</label>
						<input class="form-control" type="text" disabled value="{{Auth::guard('dokter')->user()->email}}">
					</div>
					<div class="form-group col-md-12">
						<label>Ketarangan :</label>
						<textarea class="form-control" name="keterangan" rows="5">{{Auth::guard('dokter')->user()->keterangan}}</textarea>
					</div>

					<div class="form-group col-md-12">	
						<button class="btn btn-primary" type="submit" id="button-addon2">Simpan</button>
					</div>
				</form>
			</div>
		</aside>

	</div>

</div>
@endsection