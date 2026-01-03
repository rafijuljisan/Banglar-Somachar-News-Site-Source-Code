@extends('layouts.front')
@section('contents')
  

<div class="container custom-container">
  <ol class="breadcrumb details-page-breadcrumb video-breadcum">
    <li><a href=""><i class="fa fa-home"></i></a></li>
    <li class="active"><a href=""> ফটো গ্যালারি </a></li>
  </ol><!--/.details-page-breadcrumb-->

   <div class="row custom-row content_list">
   				@php
				$photobig=DB::table('image_albums')->orderBy('id','DESC')->limit(10000000)->get();
				@endphp 
   
   @foreach ($photobig as $row)
           <div class="col-md-3 custom-padding">
        <div class="video-gallery-category">
           <a href="{{asset('assets/images/image-album/'.$row->photo)}}">
             <div class="video-category-img">
               <i class="fa fa-camera"></i>
               <img class="img-fluid" src="{{asset('assets/images/image-album/'.$row->photo)}}" alt="{{$row->album_name}}">
             </div>
             <div class="video-heading">
               <h2>{{$row->album_name}}</h2>
             </div>
           </a>
         </div><!--/.video-gallery-category-->
       </div><!--/.col-md-3-->
	   @endforeach
	   
	   

            <!--/.video-gallery-category-->
       </div><!--/.col-md-3-->
         </div><!--/.row-->
 </div><!--/.container-->





  
@endsection