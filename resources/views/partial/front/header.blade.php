<header class="header-section sticky-top bg-white shadow-sm" style="z-index: 1020;">
    <div class="header-topbar bg-white shadow-sm">
        <div class="container custom-container">
            <div class="d-flex align-items-center justify-content-between py-2">
                
                <div class="d-flex align-items-center order-1 order-md-1 flex-grow-1 flex-md-grow-0">
                    <div class="d-block d-md-none mr-auto">
                        <a href="{{route('frontend.index')}}">
                            <img src="{{asset('assets/images/logo/'.$gs->logo)}}" alt="{{ $gs->title }}" class="mobile-logo" style="max-height: 40px;">
                        </a>
                    </div>
                    
                    <button class="custom-toggler sidebar-trigger d-none d-md-block mr-3" type="button">
                        <span class="bar"></span><span class="bar"></span><span class="bar"></span>
                    </button>

                    <div class="date-area d-none d-md-block border-left pl-3">
                         <ul class="list-inline mb-0 small text-muted font-weight-bold">
                            <li class="list-inline-item"><i class="fa fa-map-marker text-danger"></i> ঢাকা</li>
                            <li class="list-inline-item">
                                <span id="Clock" onload="displayTime()"></span> | <span id="date-today"></span> বঙ্গাব্দ
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="text-center order-md-2 d-none d-md-block flex-grow-1">
                     <a href="{{route('frontend.index')}}">
                        <img src="{{asset('assets/images/logo/'.$gs->logo)}}" alt="{{ $gs->title }}" class="desktop-logo" style="max-height: 50px;">
                    </a>
                </div>

                <div class="d-flex align-items-center justify-content-end order-2 order-md-3 flex-grow-0">
                    
                    <div class="mr-2 mr-md-3">
                        <button class="icon-btn search-toggle text-dark p-2 border-0 bg-transparent">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>

                    <button class="custom-toggler sidebar-trigger d-md-none ml-2" type="button">
                        <span class="bar"></span><span class="bar"></span><span class="bar"></span>
                    </button>

                    <div class="social-icons d-none d-md-flex align-items-center border-left pl-3">
                        @foreach ($social_links as $social_link) 
                            <a target="_blank" href="{{ $social_link->link}}" class="social-circle ml-2">
                                <i class="{{$social_link->icon}}"></i>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="horizontal-menu-container d-none d-md-block bg-white border-bottom">
        <div class="container custom-container">
            <nav class="navbar navbar-expand-md p-0">
                <ul class="navbar-nav w-100 justify-content-between">
                    <li class="nav-item">
                         <a class="nav-link font-weight-bold text-danger" href="{{ route('frontend.index')}}">
                             <i class="fa fa-home"></i> হোম
                         </a>
                    </li>
                    @foreach ($categories as $category)
                        @if ($category->child()->count() > 0)
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">{{$category->title}}</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item text-danger" href="{{ route('frontend.category',$category->slug)}}">সব {{$category->title}}</a></li>
                                    <div class="dropdown-divider"></div>
                                    @foreach ($category->child as $child)
                                        <li><a href="{{ route('frontend.postBySubcategory',[$category->slug,$child->slug])}}" class="dropdown-item">{{$child->title}}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('frontend.category',$category->slug)}}">{{$category->title}}</a>
                            </li>
                        @endif
                    @endforeach 
                </ul>
            </nav>
        </div>
    </div>
</header>

<div id="search-overlay" class="search-overlay-area">
    <div class="container custom-container h-100">
        <div class="d-flex align-items-center justify-content-center h-100 position-relative">
            <button class="search-close-btn search-toggle"><i class="fa fa-times"></i></button>
            <form action="{{ route('front.news_search') }}" method="GET" class="w-100">
                <div class="input-group search-group">
                    <input type="text" name="search" class="form-control" placeholder="কি খুঁজছেন? লিখুন..." autocomplete="off">
                    <div class="input-group-append">
                        <button class="btn btn-danger" type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="sidebar-backdrop sidebar-close-trigger"></div>

<div id="sidebarMenu" class="sidebar-menu">
    <div class="sidebar-header d-flex justify-content-between align-items-center">
        <img src="{{asset('assets/images/logo/'.$gs->logo)}}" alt="Logo" style="max-height: 30px;">
        <button class="close-sidebar-btn sidebar-close-trigger"><i class="fa fa-times"></i></button>
    </div>

    <div class="sidebar-content">
        <ul class="nav flex-column">
             <li class="nav-item">
                 <a class="nav-link" href="{{ route('frontend.index')}}">হোম</a>
            </li>
            @foreach ($categories as $category)
                <li class="nav-item">
                    @if ($category->child()->count() > 0)
                        <a href="#sidebarSubmenu{{$category->id}}" data-toggle="collapse" aria-expanded="false" class="nav-link dropdown-toggle">
                            {{$category->title}} <i class="fa fa-angle-right"></i>
                        </a>
                        <ul class="collapse list-unstyled" id="sidebarSubmenu{{$category->id}}">
                            <li><a class="nav-link text-danger" href="{{ route('frontend.category',$category->slug)}}">সব {{$category->title}}</a></li>
                            @foreach ($category->child as $child)
                                <li><a href="{{ route('frontend.postBySubcategory',[$category->slug,$child->slug])}}" class="nav-link">{{$child->title}}</a></li>
                            @endforeach
                        </ul>
                    @else
                        <a class="nav-link" href="{{ route('frontend.category',$category->slug)}}">{{$category->title}}</a>
                    @endif
                </li>
            @endforeach
        </ul>

        <div class="sidebar-footer mt-2">
            <h6 class="font-weight-bold mb-2">বিজ্ঞাপনের জন্য যোগাযোগ করুন</h6>
            <div class="d-flex">
                @foreach ($social_links as $social_link) 
                    <a href="{{ $social_link->link}}" class="text-dark mr-3" style="font-size: 18px;"><i class="{{$social_link->icon}}"></i></a>
                @endforeach
            </div>
        </div>
    </div>
</div>