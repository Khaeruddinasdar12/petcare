@extends('layouts.app')

@section('title') | Blog @endsection
@section('content')
<div class="container " style="background-color: white">
	<div class="row">
		<div class="col-md-8 blog-main">
			<h3 class="pb-4 mb-4 font-italic border-bottom">
				Artikel & Tips - Our Blog
			</h3>

			<div class="blog-post">
				<h2 class="blog-post-title">{{$data->judul}}</h2>
				<p class="blog-post-meta text-muted">{{$data->created_at}}</p>
				@if($data->gambar != '')
					<img src="{{asset('storage/'.$data->gambar)}}" class="img-fluid mx-auto d-block" alt="Responsive image" height="200px" width="300">
				@endif
				{!!$data->artikel!!}
			</div>

			<!-- <div class="blog-post">
				<h2 class="blog-post-title">Another blog post</h2>
				<p class="blog-post-meta">December 23, 2013 by <a href="#">Jacob</a></p>

				<p>Cum sociis natoque penatibus et magnis <a href="#">dis parturient montes</a>, nascetur ridiculus mus. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Sed posuere consectetur est at lobortis. Cras mattis consectetur purus sit amet fermentum.</p>
				<blockquote>
					<p>Curabitur blandit tempus porttitor. <strong>Nullam quis risus eget urna mollis</strong> ornare vel eu leo. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
				</blockquote>
				<p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
				<p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
			</div>

			<div class="blog-post">
				<h2 class="blog-post-title">New feature</h2>
				<p class="blog-post-meta">December 14, 2013 by <a href="#">Chris</a></p>

				<p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis euismod. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
				<ul>
					<li>Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</li>
					<li>Donec id elit non mi porta gravida at eget metus.</li>
					<li>Nulla vitae elit libero, a pharetra augue.</li>
				</ul>
				<p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
				<p>Donec ullamcorper nulla non metus auctor fringilla. Nulla vitae elit libero, a pharetra augue.</p>
			</div> -->

			<!-- <nav class="blog-pagination">
				<a class="btn btn-outline-primary" href="#">Older</a>
				<a class="btn btn-outline-secondary disabled" href="#" tabindex="-1" aria-disabled="true">Newer</a>
			</nav> -->

		</div><!-- /.blog-main -->

		<aside class="col-md-4 blog-sidebar">
			<div class="p-4 mb-3 bg-light rounded">
				<h4 class="font-italic">Tentang Kami</h4>
				<p class="mb-0"><em>MyPets</em> adalah salah satu startup yang bergerak dibidang kesehatan hewan yang tujuannya memudahkan masyarakat untuk menemukan klinik hewan terdekat sesuai dengan lokasi tempat tinggalnya serta memudahkan juga dalam berkonsultasi langsung dengan dokter hewan.</p>
			</div>

			<!-- <div class="p-4">
				<h4 class="font-italic">Archives</h4>
				<ol class="list-unstyled mb-0">
					<li><a href="#">March 2014</a></li>
					<li><a href="#">February 2014</a></li>
					<li><a href="#">January 2014</a></li>
					<li><a href="#">December 2013</a></li>
					<li><a href="#">November 2013</a></li>
					<li><a href="#">October 2013</a></li>
					<li><a href="#">September 2013</a></li>
					<li><a href="#">August 2013</a></li>
					<li><a href="#">July 2013</a></li>
					<li><a href="#">June 2013</a></li>
					<li><a href="#">May 2013</a></li>
					<li><a href="#">April 2013</a></li>
				</ol>
			</div>

			<div class="p-4">
				<h4 class="font-italic">Elsewhere</h4>
				<ol class="list-unstyled">
					<li><a href="#">GitHub</a></li>
					<li><a href="#">Twitter</a></li>
					<li><a href="#">Facebook</a></li>
				</ol>
			</div> -->
		</aside><!-- /.blog-sidebar -->

	</div><!-- /.row -->

</div><!-- /.container -->
@endsection