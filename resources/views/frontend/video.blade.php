@extends('layouts.front')
@section('contents')



<div class="container custom-container">

  <ol class="breadcrumb details-page-breadcrumb video-breadcum">
    <li><a href="#"><i class="fa fa-home"></i></a></li>
    <li class="active"><a href="#"> ভিডিও </a></li>
  </ol><!--/.details-page-breadcrumb-->

   <div class="row custom-row content_list">
                @php
				$video2=DB::table('posts')->inRandomOrder()->orderBy('id','DESC')->where('is_video',1)->limit(100000)->get();
				@endphp
	   
	   @foreach($video2 as $row)
	   <div class="col-md-3 custom-padding">
      <div class="video-gallery-category">
         <a href="{{ route('frontend.details',[$row->id,$row->slug])}}">
           <div class="video-category-img">
             <i class="fa fa-video-camera"></i>
             <img class="img-fluid" src="https://img.youtube.com/vi/{{ $row->video_link}}/mqdefault.jpg" alt="{{strlen($row->title)>40 ? mb_substr($row->title,0,40,"utf-8") : $row->title}}...">
           </div>
           <div class="video-heading">
             <h2>{{strlen($row->title)>40 ? mb_substr($row->title,0,40,"utf-8") : $row->title}}...</h2>
           </div>
         </a>
       </div>
     </div>
      @endforeach  
	 
	 
	 
	 
	 
	 
   </div><!--/.row-->
 </div><!--/.container-->







@endsection