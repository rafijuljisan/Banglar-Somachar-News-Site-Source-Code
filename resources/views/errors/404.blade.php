@extends('layouts.front')

@section('contents')

 <div id="notfound">
		<div class="notfound">
			<div class="notfound-404">
				<h1>404</h1>
				<h2>Page not found</h2>
			</div>
			<a href="{{route('frontend.index')}}">Homepage</a>
		</div>
	</div>


@endsection