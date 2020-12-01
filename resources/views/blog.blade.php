@extends('layouts.app')

@section('title') | Blog @endsection
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-10">
			<div class="card">
				<div class="card-body">
					<h3 class="text-center">{{$data->judul}}</h3>
					<!-- <hr> -->
					<div class="text-center">
						<img src="{{asset('picture.png')}}" class="img-fluid" alt="Responsive image">
					</div>
					<hr>
					{!! $data->artikel !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection