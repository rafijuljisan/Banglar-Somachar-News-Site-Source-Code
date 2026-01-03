@extends('layouts.admin')

@section('content')

<div class="content-area">
              <div class="mr-breadcrumb">
                <div class="row">
                  <div class="col-lg-12">
                      <h4 class="heading">{{ __('Website Contents') }}</h4>
                    <ul class="links">
                      <li>
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                      </li>
                      <li>
                        <a href="javascript:;">{{ __('General Settings') }}</a>
                      </li>
                      <li>
                        <a href="">{{ __('Website Contents') }}</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="add-product-content">
                @include('includes.admin.form-both')
                <div class="row">
                  <div class="col-lg-12">
                    <div class="product-description">
                      <div class="body-area">
                      <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                      <form class="uplogo-form" id="elitedesignform" action="{{ route('admin.generalsettings.update')}}"  method="POST" enctype="multipart/form-data">
                          {{ csrf_field() }}

                        <div class="row justify-content-center">
                          <div class="col-lg-3">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Website Title') }} *
                                  </h4>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <input type="text" class="input-field" placeholder="{{ __('Write Your Site Title Here') }}" name="title" value="{{$data->title}}" required="">
                          </div>
                        </div>
                        {{-- Print Header Logo Upload --}}
                        <div class="row justify-content-center">
                          <div class="col-lg-3">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Print Page Header Logo') }}</h4>
                            </div>
                          </div>
                          <div class="col-lg-6">
                              <div class="img-upload">
                                  <div id="image-preview" class="img-preview" style="background: url({{ $data->print_logo ? asset('assets/images/'.$data->print_logo) : asset('assets/images/noimage.png') }});">
                                      <label for="image-upload" class="img-label" id="image-label"><i class="icofont-upload-alt"></i> {{ __('Upload Image') }}</label>
                                      <input type="file" name="print_logo" class="img-upload" id="image-upload">
                                  </div>
                              </div>
                          </div>
                        </div>

                        <div class="row justify-content-center">
                          <div class="col-lg-3">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Print Header Text') }}</h4>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <textarea class="input-field" name="print_header_text" placeholder="{{ __('Custom text for print header (leave empty to use Site Title)') }}">{{ $data->print_header_text }}</textarea>
                          </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-lg-3">
                                <div class="left-area">
                                    <h4 class="heading">{{ __('Manage Photocard Frames') }}</h4>
                                    <p class="sub-heading">{{ __('Upload multiple 1080x1080 frames here') }}</p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                
                                {{-- 1. Upload Form (AJAX ready via existing script or standard submit) --}}
                                <div class="img-upload full-width-img">
                                    <div id="frame-preview" class="img-preview" style="background: url({{ asset('assets/images/noimage.png') }});">
                                        <label for="image-upload-frame" class="img-label" id="frame-label"><i class="icofont-upload-alt"></i> {{ __('Upload New Frame') }}</label>
                                        <input type="file" name="frame" class="img-upload" id="image-upload-frame" onchange="uploadFrame(this)" accept="image/*">
                                    </div>
                                </div>

                            </div>
                        </div>

                        {{-- 3. Display Existing Frames --}}
                        <div class="row justify-content-center">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-6">
                                <h5 style="margin-top: 20px; border-bottom: 1px solid #ddd; padding-bottom: 10px;">{{ __('Current Frames List') }}</h5>
                                <div class="row">
                                    @if(isset($frames) && count($frames) > 0)
                                        @foreach($frames as $frame)
                                        <div class="col-4" style="margin-bottom: 15px;">
                                            <div style="border: 1px solid #ccc; padding: 5px; text-align: center; border-radius: 5px;">
                                                <img src="{{ asset('assets/images/frames/'.$frame->image) }}" style="width: 100%; height: auto; display: block; margin-bottom: 5px;">
                                                <a href="{{ route('admin.photocard.delete', $frame->id) }}" class="btn btn-danger btn-sm" style="font-size: 10px; padding: 2px 5px;">
                                                    <i class="fas fa-trash"></i> Delete
                                                </a>
                                            </div>
                                        </div>
                                        @endforeach
                                    @else
                                        <div class="col-12"><p>{{ __('No frames uploaded yet.') }}</p></div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        

						

									




                        <div class="row justify-content-center">
                          <div class="col-lg-3">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Website Base Color') }} *</h4>
                            </div>
                          </div>
                          <div class="col-lg-6">
                              <div class="form-group">
                                <div class="input-group colorpicker-component cp">
                                <input type="text" class="form-control input-field color-field cp" name="theme_color" value="{{$data->theme_color}}"/>
                                  <span class="input-group-addon"><i></i></span>
                                </div>
                              </div>

                          </div>
                        </div>									

                        <div class="row justify-content-center">
                          <div class="col-lg-3">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Footer Color') }} *</h4>
                            </div>
                          </div>
                          <div class="col-lg-6">
                              <div class="form-group">
                                <div class="input-group colorpicker-component cp">
                                  <input type="text" class="form-control input-field color-field cp" name="footer_color" value="{{$data->footer_color}}" />
                                  <span class="input-group-addon"><i></i></span>
                                </div>
                              </div>
                          </div>
                        </div>
						
												    <div class="row justify-content-center">
                          <div class="col-lg-3">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Copyright Color') }} *</h4>
                            </div>
                          </div>
                          <div class="col-lg-6">
                              <div class="form-group">
                                <div class="input-group colorpicker-component cp">
                                <input type="text" class="form-control input-field color-field cp" name="copyright_color" value="{{$data->copyright_color}}"/>
                                  <span class="input-group-addon"><i></i></span>
                                </div>
                              </div>

                          </div>
                        </div>


                            <div class="row justify-content-center">
                            <div class="col-lg-3">
                              <div class="left-area">
                                  <h4 class="heading">{{ __('TimeZone') }} *
                                    </h4>
                              </div>
                            </div>
                            <div class="col-lg-6">
                              @php
                                $timezone_identifiers =  
                                    DateTimeZone::listIdentifiers(DateTimeZone::ALL); 
                                  
                                echo "<select name='time_zone'>"; 
                                  
                                echo "<option disabled selected> 
                                        Please Select Timezone 
                                      </option>"; 
                                  
                                $n = count($timezone_identifiers); 
                                for($i = 0; $i < $n; $i++) { 
                                  if($data->time_zone == $timezone_identifiers[$i]){
                                        $msg = 'selected';
                                    }else{
                                        $msg = '';
                                    }
                                    echo "<option value='" . $timezone_identifiers[$i] ."' ".$msg.">" . $timezone_identifiers[$i] . "</option>"; 
                                } 
                                  
                                echo "</select>"; 
                              @endphp
                            </div>
                          </div>
						  
						  
						  
						  
		                        <div class="row justify-content-center">
                          <div class="col-lg-3">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Fazar Time') }} *
                                  </h4>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <input type="text" class="input-field" placeholder="{{ __('Fazar Time') }}" name="fazar" value="{{$data->fazar}}" required="">
                          </div>
                        </div>				  
						  
						  
                     <div class="row justify-content-center">
                          <div class="col-lg-3">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Jahar Time') }} *
                                  </h4>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <input type="text" class="input-field" placeholder="{{ __('Jahar Time') }}" name="jahar" value="{{$data->jahar}}" required="">
                          </div>
                        </div>		  
						  
						  
				<div class="row justify-content-center">
                          <div class="col-lg-3">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Achor Time') }} *
                                  </h4>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <input type="text" class="input-field" placeholder="{{ __('Achor Time') }}" name="achar" value="{{$data->achar}}" required="">
                          </div>
                        </div>		  

						  						                       <div class="row justify-content-center">
                          <div class="col-lg-3">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Magrib Time') }} *
                                  </h4>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <input type="text" class="input-field" placeholder="{{ __('Magrib Time') }}" name="magrib" value="{{$data->magrib}}" required="">
                          </div>
                        </div>	
						  
						  						  						                       <div class="row justify-content-center">
                          <div class="col-lg-3">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Esha Time') }} *
                                  </h4>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <input type="text" class="input-field" placeholder="{{ __('Esha Time') }}" name="esha" value="{{$data->esha}}" required="">
                          </div>
                        </div>	
						  
						  
						  						  						                       <div class="row justify-content-center">
                          <div class="col-lg-3">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Jumma Time') }} *
                                  </h4>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <input type="text" class="input-field" placeholder="{{ __('Jumma Time') }}" name="jumma" value="{{$data->jumma}}" required="">
                          </div>
                        </div>	
						  
						  
						  
						  
						  
						  
						  
						  
						  
						  
						  
						  
						  
						  
						  
						  
						  
						  
						  
			<div class="row justify-content-center">
                              <div class="col-lg-3">
                                <div class="left-area">
                                    <h4 class="heading">
                                        Search Console Verification Code
                                        <p class="sub-heading">{{(__('In Any Language'))}}</p>
                                    </h4>
                                  
                                </div>
                              </div>
                              <div class="col-lg-6">
                                  <div class="tawk-area">
                                  <textarea name="search_console" required="">{{$data->search_console}}</textarea>
                                  </div>
                              </div>
                            </div>
							
			<div class="row justify-content-center">
                              <div class="col-lg-3">
                                <div class="left-area">
                                    <h4 class="heading">
                                        Adsense Verification Code
                                        <p class="sub-heading">{{(__('In Any Language'))}}</p>
                                    </h4>
                                  
                                </div>
                              </div>
                              <div class="col-lg-6">
                                  <div class="tawk-area">
                                  <textarea name="adsense_code" required="">{{$data->adsense_code}}</textarea>
                                  </div>
                              </div>
                            </div>

					<div class="row justify-content-center">
                              <div class="col-lg-3">
                                <div class="left-area">
                                    <h4 class="heading">
                                        Header 728X90 Ads *
                                        <p class="sub-heading">{{(__('In Any Language'))}}</p>
                                    </h4>
                                  
                                </div>
                              </div>
                              <div class="col-lg-6">
                                  <div class="tawk-area">
                                  <textarea name="header_728" required="">{{$data->header_728}}</textarea>
                                  </div>
                              </div>
                            </div>
							
							
							
													<div class="row justify-content-center">
                              <div class="col-lg-3">
                                <div class="left-area">
                                    <h4 class="heading">
                                        Homepage 1 728X90 Ads *
                                        <p class="sub-heading">{{(__('In Any Language'))}}</p>
                                    </h4>
                                  
                                </div>
                              </div>
                              <div class="col-lg-6">
                                  <div class="tawk-area">
                                  <textarea name="header1_728" required="">{{$data->header1_728}}</textarea>
                                  </div>
                              </div>
                            </div>	
							
														
													<div class="row justify-content-center">
                              <div class="col-lg-3">
                                <div class="left-area">
                                    <h4 class="heading">
                                        Homepage 2 728X90 Ads *
                                        <p class="sub-heading">{{(__('In Any Language'))}}</p>
                                    </h4>
                                  
                                </div>
                              </div>
                              <div class="col-lg-6">
                                  <div class="tawk-area">
                                  <textarea name="header2_728" required="">{{$data->header2_728}}</textarea>
                                  </div>
                              </div>
                            </div>
																				<div class="row justify-content-center">
                              <div class="col-lg-3">
                                <div class="left-area">
                                    <h4 class="heading">
                                        Homepage 3 728X90 Ads *
                                        <p class="sub-heading">{{(__('In Any Language'))}}</p>
                                    </h4>
                                  
                                </div>
                              </div>
                              <div class="col-lg-6">
                                  <div class="tawk-area">
                                  <textarea name="header3_728" required="">{{$data->header3_728}}</textarea>
                                  </div>
                              </div>
                            </div>
							
																											<div class="row justify-content-center">
                              <div class="col-lg-3">
                                <div class="left-area">
                                    <h4 class="heading">
                                        Homepage 4 728X90 Ads *
                                        <p class="sub-heading">{{(__('In Any Language'))}}</p>
                                    </h4>
                                  
                                </div>
                              </div>
                              <div class="col-lg-6">
                                  <div class="tawk-area">
                                  <textarea name="header4_728" required="">{{$data->header4_728}}</textarea>
                                  </div>
                              </div>
                            </div>
							
							
							
							
							
						<div class="row justify-content-center">
                              <div class="col-lg-3">
                                <div class="left-area">
                                    <h4 class="heading">
                                        Homepage 1 970X90 Ads *
                                        <p class="sub-heading">{{(__('In Any Language'))}}</p>
                                    </h4>
                                  
                                </div>
                              </div>
                              <div class="col-lg-6">
                                  <div class="tawk-area">
                                  <textarea name="homepageads1_970" required="">{{$data->homepageads1_970}}</textarea>
                                  </div>
                              </div>
                            </div>	
							
													<div class="row justify-content-center">
                              <div class="col-lg-3">
                                <div class="left-area">
                                    <h4 class="heading">
                                        Homepage 2 970X90 Ads *
                                        <p class="sub-heading">{{(__('In Any Language'))}}</p>
                                    </h4>
                                  
                                </div>
                              </div>
                              <div class="col-lg-6">
                                  <div class="tawk-area">
                                  <textarea name="homepageads2_970" required="">{{$data->homepageads2_970}}</textarea>
                                  </div>
                              </div>
                            </div>
							
							
																				<div class="row justify-content-center">
                              <div class="col-lg-3">
                                <div class="left-area">
                                    <h4 class="heading">
                                        Homepage 3 970X90 Ads *
                                        <p class="sub-heading">{{(__('In Any Language'))}}</p>
                                    </h4>
                                  
                                </div>
                              </div>
                              <div class="col-lg-6">
                                  <div class="tawk-area">
                                  <textarea name="homepageads3_970" required="">{{$data->homepageads3_970}}</textarea>
                                  </div>
                              </div>
                            </div>
							
																											<div class="row justify-content-center">
                              <div class="col-lg-3">
                                <div class="left-area">
                                    <h4 class="heading">
                                        Homepage 4 970X90 Ads *
                                        <p class="sub-heading">{{(__('In Any Language'))}}</p>
                                    </h4>
                                  
                                </div>
                              </div>
                              <div class="col-lg-6">
                                  <div class="tawk-area">
                                  <textarea name="homepageads4_970" required="">{{$data->homepageads4_970}}</textarea>
                                  </div>
                              </div>
                            </div>
							
							
							
							
							
							
						
						<div class="row justify-content-center">
                              <div class="col-lg-3">
                                <div class="left-area">
                                    <h4 class="heading">
                                        Sidebar 1 Ads *
                                        <p class="sub-heading">{{(__('In Any Language'))}}</p>
                                    </h4>
                                  
                                </div>
                              </div>
                              <div class="col-lg-6">
                                  <div class="tawk-area">
                                  <textarea name="sidebar_ads" required="">{{$data->sidebar_ads}}</textarea>
                                  </div>
                              </div>
                            </div>




						<div class="row justify-content-center">
                              <div class="col-lg-3">
                                <div class="left-area">
                                    <h4 class="heading">
                                        Sidebar 2 Ads *
                                        <p class="sub-heading">{{(__('In Any Language'))}}</p>
                                    </h4>
                                  
                                </div>
                              </div>
                              <div class="col-lg-6">
                                  <div class="tawk-area">
                                  <textarea name="sidebar1_ads" required="">{{$data->sidebar1_ads}}</textarea>
                                  </div>
                              </div>
                            </div>



						<div class="row justify-content-center">
                              <div class="col-lg-3">
                                <div class="left-area">
                                    <h4 class="heading">
                                        Sidebar 3 Ads *
                                        <p class="sub-heading">{{(__('In Any Language'))}}</p>
                                    </h4>
                                  
                                </div>
                              </div>
                              <div class="col-lg-6">
                                  <div class="tawk-area">
                                  <textarea name="sidebar2_ads" required="">{{$data->sidebar2_ads}}</textarea>
                                  </div>
                              </div>
                            </div>






                        <div class="row justify-content-center">
                          <div class="col-lg-3">
                            <div class="left-area">

                            </div>
                          </div>
                          <div class="col-lg-6">
                            <button class="addProductSubmit-btn" type="submit">{{ __('Save') }}</button>
                          </div>
                        </div>
                     </form>
                     {{-- PASTE THIS HIDDEN FORM HERE (OUTSIDE the main form) --}}
                      <form id="frameUploadForm" action="{{ route('admin.photocard.store') }}" method="POST" enctype="multipart/form-data" style="display: none;">
                          {{ csrf_field() }}
                          <input type="file" name="frame" id="hiddenFrameInput">
                      </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

@endsection

@section('scripts')
<script src="{{asset('assets/admin/js/notify.js')}}"></script>
<script src="{{asset('assets/admin/js/distawk.js')}}"></script>
{{-- Simple Script to auto-submit the frame when selected --}}
                        <script>
                            function uploadFrame(input) {
                              if (input.files && input.files[0]) {
                                  var formData = new FormData();
                                  formData.append('frame', input.files[0]);
                                  formData.append('_token', '{{ csrf_token() }}');
                                  
                                  $.ajax({
                                      url: "{{ route('admin.photocard.store') }}",
                                      type: "POST",
                                      data: formData,
                                      contentType: false,
                                      cache: false,
                                      processData: false,
                                      success: function(data) {
                                          if(data.errors){
                                              alert('Error: ' + data.errors);
                                          } else {
                                              alert('Frame uploaded successfully!');
                                              location.reload(); 
                                          }
                                      },
                                      error: function(xhr) {
                                          alert('Upload failed: ' + xhr.responseText);
                                      }
                                  });
                              }
                          }
                        </script>

@endsection
