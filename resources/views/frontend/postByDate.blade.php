@extends('layouts.front')

@push('css')

@endpush

@section('contents')


<div class="archive-page2">
            <div class="container">


                <div class="row">   
                    <div class="col-lg-8 col-md-8">
                        <div class="rachive-info-cats">
                            <a href=""><i class="las la-home"> </i>{{__('Home')}} </a>  <i class="las la-angle-right"></i>  {{__('News')}} <i class="las la-angle-right"></i> প্রকাশের তারিখঃ {{\Carbon\Carbon::parse($date)->toFormattedDateString()}} ইং
                        </div>

                        <div class="archivePage-content2">
                            <div class="row">
                                

                                
                           @if ($datas->count()>0)
                            @foreach ($datas as $post)                                 

                                <div class="themesBazar-3 themesBazar-m2">
                                    <div class="archivePage-wrpp2">
                                        <div class="archive2-image">
                                            <img class="lazyload" src="{{asset('assets/images/logo/'.$gs->lazy_baner)}}" data-src="{{asset('assets/images/post/'.$post->image_big)}}" alt="{{ strlen($post->title)>50 ? mb_substr($post->title,0,50,'utf-8').'...' : $post->title}}" title="{{ strlen($post->title)>50 ? mb_substr($post->title,0,50,'utf-8').'...' : $post->title}}">

                                             

                                        </div>
                                        <h4 class="archivePage2-title">
                                            <a href="{{ route('frontend.details',[$post->id,$post->slug])}}">{{ strlen($post->title)>50 ? mb_substr($post->title,0,50,'utf-8').'...' : $post->title}}</a>
                                        </h4>
                                        
                                        <div class="archive-meta2">
                                            <a href="{{ route('frontend.details',[$post->id,$post->slug])}}"><i class="las la-tags"> </i>  প্রকাশের তারিখঃ  {{$post->createdAt()}} ইং
  </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else 
							<div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <p class="text-danger text-danger text-center">{{__('This Date has no News.')}}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                                                                     

                               

                                 

                                  <div style="text-align: center; margin:20px; display:display: ruby;">  </div>

                            
<div class="mt-2">{{ $datas->appends(['date' => request()->input('date')])->links() }}</div>
                                

                            </div>
                         
                         
                            
                          
                            
                            
                            
                        </div>
                        
                    </div> 
                                 

                    
                            
<div class="col-lg-4 aside">
                             
                <div class="celander-widget-area mt-4">
                  {!!$gs->sidebar_ads!!}
                </div>
                <div class="celander-widget-area mt-4">
                        <div id="datecalender">
                        </div>
                </div>

				
                <div class="aside-newsletter-widget mt-3 subarea">
                    <h4 class="title">{{__('Newsletter')}}</h4>
                    <p class="text">{{__('Subscribe to our newsletter to stay.')}}</p>
                    <form action="{{ route('front.subscribers.store') }}" class="subscribe-form" method="POST" id="subForm">
                        @csrf
                        <input type="text" placeholder="{{__('Enter Your Email Address')}}" name="email" class="subEmail">
                        <button type="submit" class="submit subBtn">{{__('Subscribe')}}</button>
                    </form>
                </div>

            </div>


                    </div>
                </div>
            </div>
        </div>


@endsection

@push('js')
<script src="{{asset('assets/front/js/notify.min.js')}}"></script>
<script src="{{asset('assets/front/js/rfront.js')}}"></script>

@endpush