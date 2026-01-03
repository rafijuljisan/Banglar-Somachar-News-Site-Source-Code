@extends('layouts.front')

@push('css')

@endpush

@section('contents')
    	
		
		 <div class="create-page">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="create-pageTitle">                        
                            <span> {{$page->title}}  </span>     
                        </div>
                        
                        <div class="create-page-details">
                            <p>{!! $page->description!!}</p>
                        
                    </div>
                </div>
            </div>
        </div>

		
		
		
@endsection

@push('js')
<script src="{{asset('assets/front/js/notify.min.js')}}"></script>
<script src="{{asset('assets/front/js/rfront.js')}}"></script>

@endpush