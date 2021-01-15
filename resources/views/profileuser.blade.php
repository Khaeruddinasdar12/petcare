@extends('layouts.app')

@section('title') | User - profile @endsection
@section('content')
<div class="container " style="background-color: white">
	<div class="row">
		<div class="col-md-8 blog-main">
			<h3 class="pb-4 mb-4 font-italic border-bottom">
				Profile User
			</h3>
			<div class="blog-post">
				<h2 class="blog-post-title">Tentang MyPets</h2>
				<p class="blog-post-meta text-muted">Sesuai dengan namanya, MyPets adalah salah satu startup yang bergerak dibidang kesehatan hewan yang tujuannya memudahkan masyarakat untuk menemukan klinik hewan terdekat sesuai dengan lokasi tempat tinggalnya serta memudahkan juga dalam berkonsultasi langsung dengan dokter hewan.</p>
				
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
				<form action="{{route('user.profile')}}" method="POST">
					@csrf
					<div class="form-group col-md-12">
						<label>Nama Lengkap :</label>
						<input class="form-control" type="text" name="nama" value="{{Auth::user()->name}}">
					</div>
					<div class="form-group col-md-12">
						<label>Email :</label>
						<input class="form-control" type="text" disabled value="{{Auth::user()->email}}">
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