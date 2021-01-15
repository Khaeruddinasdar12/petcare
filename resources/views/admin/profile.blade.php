@extends('layouts.app')

@section('title') | Admin - profile @endsection
@section('content')
<div class="container " style="background-color: white">
	<div class="row">
		<div class="col-md-8 blog-main">
			<h3 class="pb-4 mb-4 font-italic border-bottom">
				Profile Admin
			</h3>
			<div class="blog-post">
				<h2 class="blog-post-title">Admin MyPets</h2>
				<ul>
					<li>Anda sebagai admin berhak mengatur aplikasi ini.</li>
					<li>Gunakan aplikasi ini sesuai dengan protokol aplikasi.</li>
					<li>Gunakan aplikasi ini dengan bijak.</li>
					<li>Periksalah terlebih dahulu sebelum mengkonfirmasi sesuatu.</li>
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
				<form action="{{route('admin.profile')}}" method="POST">
					@csrf
					<div class="form-group col-md-12">
						<label>Nama Lengkap :</label>
						<input class="form-control" type="text" name="nama" value="{{Auth::guard('admin')->user()->name}}">
					</div>
					<div class="form-group col-md-12">
						<label>Email :</label>
						<input class="form-control" type="text" disabled value="{{Auth::guard('admin')->user()->email}}">
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