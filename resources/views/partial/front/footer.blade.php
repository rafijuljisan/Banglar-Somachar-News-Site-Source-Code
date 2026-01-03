<footer class="footer-new">
  <div class="container jagaran-container">
    <div class="row custom-row">
      <div class="col-lg-3 custom-padding">
        <div class="contact-details">
          <h3> <span> আমাদের পরিচিতি </span>  </h3>
          <p>সম্পাদক ও প্রকাশক : {{$gs->sompadok}}</p>
          <p>নির্বাহী সম্পাদক : {{$gs->nirbahi_sompadok}}</p>
          <p>বার্তা সম্পাদক : {{$gs->barta_sompadok}}</p>
        </div><!--/.contact-details-->
        <ul class="social-icon footer-icon footer-icon-2">
		
		@foreach ($social_links as $social_link) 
          <li><a target="_blank" href="{{ $social_link->link}}" class="{{$social_link->name}}"><i class="{{$social_link->icon}}"></i></a></li>
         @endforeach
        </ul><!--/.social-icon-->
      </div><!--/.col-lg-3-->
      <div class="col-lg-3 custom-padding">
        <div class="contact-details">
          <h3> <span> রেজিস্টার্ড অফিস </span>  </h3>
          <ul class="footer-address-ul">
            <li>
              <span class="size-w-3">
                <i class="fa fa-home" aria-hidden="true"></i>
              </span>
              <span class="size-w-4">
              {{$gs->address}}
              </span>
            </li>
            <li>
              <span class="size-w-3">
                <i class="fa fa-phone" aria-hidden="true"></i>
              </span>
              <span class="size-w-4">
              {{$gs->mobile}}
              </span>
            </li>
            <li>
              <span class="size-w-3">
                <i class="fa fa-envelope-o" aria-hidden="true"></i>
              </span>
              <span class="size-w-4">
                {{$gs->email_address}}
              </span>
            </li>
            <li>
              <span class="size-w-3">
                <i class="fa fa-internet-explorer" aria-hidden="true"></i>
              </span>
              <span class="size-w-4">
                {{ route('frontend.index')}}
              </span>
            </li>
          </ul>
        </div><!--/.contact-details-->
      </div><!--/.col-md-4-->


      <div class="col-lg-3 custom-padding">
        <div class="contact-details">
          <h3> <span> কর্পোরেট অফিস </span>  </h3>
          <ul class="footer-address-ul">
            <li>
              <span class="size-w-3">
                <i class="fa fa-home" aria-hidden="true"></i>
              </span>
              <span class="size-w-4">
              {{$gs->address}}
              </span>
            </li>
            <li>
              <span class="size-w-3">
                <i class="fa fa-phone" aria-hidden="true"></i>
              </span>
              <span class="size-w-4">
              {{$gs->mobile}}
              </span>
            </li>
            <li>
              <span class="size-w-3">
                <i class="fa fa-envelope-o" aria-hidden="true"></i>
              </span>
              <span class="size-w-4">
               {{$gs->email_address}}
              </span>
            </li>
            <li>
              <span class="size-w-3">
                <i class="fa fa-internet-explorer" aria-hidden="true"></i>
              </span>
              <span class="size-w-4">
                {{ route('frontend.index')}}
              </span>
            </li>
          </ul>
        </div><!--/.contact-details-->
      </div><!--/.col-md-3-->
      <div class="col-lg-3 custom-padding">
        <div class="contact-details">
          <h3> <span> মানচিত্রে আমরা </span>  </h3>
        </div>
        <div class="footer-widget-map">
          
		  {!! $gs->google_map !!}
		  
        </div>
      </div><!--/.col-lg-3-->
    </div><!--/.row-->
  </div><!--/.container-->
</footer><!--/.footer-new-->
<div class="footer">
  <div class="container custom-container">
    <div class="row custom-row footer-bottom-row">
        <div class="col-md-8 footer-copy-text">
          <p>{{$gs->copyright_text}}</p>
        </div>
        <div class="col-md-4">
          <div class="design-link">
            <p>সকল কারিগরী সহযোগিতায়  <a href="htps://futureitlimited.com/ target="_blank" title="Elitedesign.com.bd"> FUTURE IT</a></p>
          </div>
        </div>
    </div><!--/.custom-row-->
  </div><!--/.custom-container-->
</div><!--/.footer-->