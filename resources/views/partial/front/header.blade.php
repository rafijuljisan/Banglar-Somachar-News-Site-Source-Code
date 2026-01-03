<div class="header-top-area">
    <div class="container custom-container">
      <div class="row custom-row">
        <div class="col-md-6 custom-padding">
          <div class="date-area">
            <ul class="current-date">
              <li><i class="fa fa-map-marker" aria-hidden="true"></i> ঢাকা</li>
             <span id ="Clock" onload="displayTime()"></span> | <span id="date-today"></span> বঙ্গাব্দ
            </ul><!--/.date-area-->
          </div><!--/.date-area-->
        </div><!--/.col-md-5-->
        <div class="col-md-6 custom-padding">
          <div class="social-icon-wrapper float-right">
            <!-- <div class="top-other-link">
              <ul class="other-link">
                <li><a href="#"><i class="fa fa-newspaper-o" aria-hidden="true"></i> English </a></li>
              </ul>
            </div> -->
            <div class="top_socail_icon_area">
               <ul class="list-inline">
                 
				 
				 @foreach ($social_links as $social_link) 
				 <li><a target="_blank" href="{{ $social_link->link}}" class="{{$social_link->name}}" target="_blank">
                   <span class="cube">
                     <span class="cube-top"><i class="{{$social_link->icon}}"></i></span>
                     <span class="cube-front"><i class="{{$social_link->icon}}"></i></span>
                   </span>
                 </a></li>
                 @endforeach
				 
				 				@if (Auth::guard('admin')->user() && Auth::guard('admin')->user()->role_id != 1)
				@else
				 <li><a target="_blank" href="{{ route('front.LogReg') }}" class="youtube" target="_blank">
                   <span class="cube">
                     <span class="cube-top"><i class="fa fa-user-circle"></i></span>
                     <span class="cube-front"><i class="fa fa-user-circle"></i></span>
                   </span>
                 </a></li>
				 
				 
									@endif
									@if (Auth::guard('admin')->user() && Auth::guard('admin')->user()->role_id != 1)
									     @php
											 $data = Auth::guard('admin')->user();
										 @endphp	
				 <li><a target="_blank" href="{{ route('admin.dashboard') }}" class="youtube" target="_blank">
                   <span class="cube">
                     <span class="cube-top"><i class="fa fa-dashboard"></i></span>
                     <span class="cube-front"><i class="fa fa-dashboard"></i></span>
                   </span>
                 </a></li>
				 @endif	
				 
				 
               </ul>
             </div><!--/.top_socail_icon_area-->
          </div><!--/.social-icon-wrapper-->
        </div><!--/.col-md-7-->
      </div><!--/.row-->
    </div><!--/.container-->
  </div><!--/.header-top-area-->
  <div class="logo-area">
    <div class="container custom-container">
      <div class="row custom-row">
        <div class="col-md-4 custom-padding">
		@php
		Session::has('language') ? $lid=Session::get('language') : $lid = (DB::table('languages')->where('is_default','=',1)->first()->id)
		@endphp
							
		@php
		$header_footer_logo = d_logo($lid);
		@endphp
          <div class="main-logo">
            <a href="{{route('frontend.index')}}"><img class="img-fluid" src="{{asset('assets/images/logo/'.$gs->logo)}}" alt="{{ $gs->title }}"></a>
          </div><!--/.main-logo-->
        </div><!--/.col-md-3-->
        <div class="col-md-8 custom-padding">
          <div class="header-baner float-right">
{!!$gs->header_728!!}
          </div>
        </div><!--/.col-md-9-->
      </div><!--/.row-->
    </div><!--/.container-->
  </div><!--/.logo-area-->
</header>
<div class="top-nav-main">
<nav class="navbar navbar-expand-lg top-nav-sports">
    <div class="container navbar-container custom-container">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fa fa-bars iconbar"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
		@foreach ($categories as $category)
		@if ($loop->first)
          <li class="nav-item d-none d-lg-block" id="home">
            <a class="nav-link" href="{{ route('frontend.index')}}"><i class="fa fa-home"></i></a>
          </li>
		  @endif


          @if ($category->child()->count() > 0)
          <li class="nav-item dropdown position-relative">
            <a class="nav-link dropdown-toggle" href="{{ route('frontend.category',$category->slug)}}" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> {{$category->title}} </a>
            <ul class="dropdown-menu dropdown-sub-menu" aria-labelledby="navbarDropdown">
			@foreach ($category->child as $child)
              <li><a href="{{ route('frontend.postBySubcategory',[$category->slug,$child->slug])}}" class="dropdown-item" data-tab="
											#{{$child->id}}">{{$child->title}}</a></li>
			  @endforeach
            </ul>
          </li><!--/.dropdown position-relative-->

					@else
					@if ($loop->first)
					@else 
          <li class="nav-item" id="national">
            <a class="nav-link" href="{{ route('frontend.category',$category->slug)}}">{{$category->title}}</a>
          </li><!--/.li-->
             @endif
				@endif
			@endforeach	

        </ul>
      </div><!--/.navbarSupportedContent-->
      <!-- Start Atribute Navigation -->
        <div class="attr-nav">
          <ul>
            <li class="search"><a href="#"><i class="fa fa-search"></i></a></li>
          </ul>
        </div><!--/.attr-nav-->
      <!-- End Atribute Navigation -->
    </div><!-- container -->
  </nav>
  <div class="top-search">
      <div class="container custom-container">
        <div class="col-lg-3 col-md-4 col-12 top-search-secton">
          <form action="{{ route('front.news_search') }}" method="get" class="search-form">
            <div class="input-group">
              <label for="search" class="sr-only">Search</label>
              <input type="hidden"/>
              <input type="text" class="form-control" name="search" id="q" placeholder="search">
              <button class="input-group-addon" type="submit"><i class="fa fa-search"></i></button>
              <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
            </div><!--/.input-group-->
          </form>
        </div><!--/.col-lg-2 col-md-4 -->
      </div><!--/.container-->
    </div><!--/.top-search-->
</div><!--/.top-nav-main-->
  <div class="container top-lead-news custom-container">
</div>