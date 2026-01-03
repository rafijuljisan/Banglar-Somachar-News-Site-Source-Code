@extends('layouts.front')
@section('contents')
   
   
   
   
 <div class="container custom-container">
   <div class="row custom-row">
     <div class="left-content-area details-left-content-area">
       <div class="col-lg-12 custom-padding">

         <ol class="breadcrumb details-page-breadcrumb">
           <li><a href="#"><i class="fa fa-home"></i></a></li>
           <li class="active"><a href="#">{{$data->title}}</a></li>
         </ol><!--/.details-page-breadcrumb-->
         <div class="category-page">
                           <div class="category-content">
						   
						   
			@if ($posts1->count()>0)			   
			 @foreach ($posts1 as $post1)
                  <div class="category-content-lead">
                    <a href="{{ route('frontend.details',[$post1->id,$post1->slug])}}">
                      <div class="category-content-lead-left">
                        <img class="img-fluid" src="{{asset('assets/images/post/'.$post1->image_big)}}" alt="{{ strlen($post1->title)>50 ? mb_substr($post1->title,0,50,'utf-8').'...' :$post1->title}}">
                      </div>
                      <div class="category-content-lead-right">
                          <div class="category-content-lead-right-text">
                            <span></span>
                            <h1>{{ strlen($post1->title)>50 ? mb_substr($post1->title,0,50,'utf-8').'...' :$post1->title}}</h1>
                            <p>{{$post1->short_description}}</p>
                          </div><!--/.category-content-lead-right-text-->
                      </div><!--/.category-content-lead-right-->
                    </div><!--/.category-content-lead-->
                   </a>
                </div><!--/.category-content-->
				@endforeach
				@else
				                  <div class="category-content-lead">
                    <a href="#">
                      <div class="category-content-lead-left">
                        <img class="img-fluid" src="assets/images/nopic.png" alt="এই পোস্টের কোন টাইটেল নেই!">
                      </div>
                      <div class="category-content-lead-right">
                          <div class="category-content-lead-right-text">
                            <span></span>
                            <h1>এই পোস্টের কোন টাইটেল নেই!</h1>
                            <p>এখানে কোন নিউজ ডেসক্রিপশন নেই!</p>
                          </div><!--/.category-content-lead-right-text-->
                      </div><!--/.category-content-lead-right-->
                    </div><!--/.category-content-lead-->
                   </a>
                </div><!--/.category-content-->
				 @endif             <div class="row custom-row content_list">
                               


@if ($posts->count()>0)
@foreach ($posts as $post)
							   <div class="col-md-6 custom-padding">
                  <div class="category-content-single">
                    <a href="{{ route('frontend.details',[$post->id,$post->slug])}}">
                      <div class="category-content-single-left">
                        <img class="img-fluid" src="{{asset('assets/images/post/'.$post->image_big)}}" alt="{{ strlen($post->title)>50 ? mb_substr($post->title,0,50,'utf-8').'...' : $post->title}}">
                      </div>
                      <div class="category-content-single-right">
                        <span></span>
                        <h2>{{ strlen($post->title)>50 ? mb_substr($post->title,0,50,'utf-8').'...' : $post->title}}</h2>
                      </div>
                    </a>
                  </div>
                </div>
                    @endforeach   
					  @else 



							   <div class="col-md-6 custom-padding">
                  <div class="category-content-single">
                    <a href="#">
                      <div class="category-content-single-left">
                        <img class="img-fluid" src="assets/images/nopic.png" alt="এই পোস্টের কোন টাইটেল নেই।">
                      </div>
                      <div class="category-content-single-right">
                        <span></span>
                        <h2>এই পোস্টের কোন টাইটেল নেই।</h2>
                      </div>
                    </a>
                  </div>
                </div>
 @endif





					
                                </div>
                            <div class="row"  id="show_more_main18127" style="margin-bottom:30px;">
              <div class="col-sm-12 text-center">
                <div class="mt-3">{{ $posts->links() }}</div>
              </div>
            </div>
                   </div>

         <!-- <div class="category-content-btn">
           <div class="details-btn">
             <a href="#" class="btn btn-more-details hvr-bounce-to-right">আরও খবর </a>
           </div>
         </div> -->

       </div><!--/.col-lg-12-->
     </div><!--/.left-content-area-->

     <div class="right-content-area details-right-content-area">
       <div class="col-lg-12 custom-padding">

         <div class="details-page-side-banner">
           {!!$gs->sidebar_ads!!}
         </div><!--/.details-page-side-banner-->

         <div class="details-tab-container">
		     	@php
				$latestpost=DB::table('posts')->inRandomOrder()->orderBy('id','DESC')->skip(10)->limit(20)->get();
				@endphp
           <ul class="nav nav-pills side-tab-main" id="pills-tab" role="tablist">
             <li class="nav-item">
               <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">সর্বশেষ</a>
             </li>
             <li class="nav-item">
               <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">জনপ্রিয়</a>
             </li>
           </ul>

           <div class="tab-content alokitonews-tab-content" id="pills-tabContent">

             <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
               <div class="least-news">
                 <ul class="least-news-ul detail-least-news-ul">
  
  
  
  
  @foreach($latestpost as $row)
  <li><a href="{{ route('frontend.details',[$row->id,$row->slug])}}">
    <div class="least-news-left">
      <img src="{{asset('assets/images/post/'.$row->image_big)}}" class="img-fluid" alt="{{ $row->title}}" title="{{ $row->title}}" />
    </div>
    <div class="least-news-right">
      <h3>{{ $row->title}}</h3>
    </div>
  </a></li>
  @endforeach
  
  
 
 </ul><!--/.least-news-ul-->
               </div><!--/.least-news-->
             </div><!--/.tab-pane-->

             <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
               <div class="least-news">
                 <ul class="least-news-ul detail-least-news-ul">
    
	    			@php
				$favourite=DB::table('posts')->inRandomOrder()->orderBy('id','DESC')->skip(5)->limit(20)->get();
				@endphp 
	
	@foreach($favourite as $row)
	<li><a href="{{ route('frontend.details',[$row->id,$row->slug])}}">
    <div class="least-news-left">
      <img src="{{asset('assets/images/post/'.$row->image_big)}}" class="img-fluid" alt="{{ $row->title}}" title="{{ $row->title}}" />
    </div>
    <div class="least-news-right">
      <h3>{{ $row->title}}</h3>
    </div>
  </a></li>
    @endforeach
  
  
  
  </ul><!--/.least-news-ul-->
               </div><!--/.least-news-->
             </div><!--/.tab-pane-->

           </div><!--/.tab-content-->
         </div><!--/.details-tab-container-->

       </div><!--/.col-lg-12-->
     </div><!--/.right-content-area-->
   </div><!--/.row-->
 </div><!--/.container-->  
   
   
   
   
   
   
   
   
@endsection
