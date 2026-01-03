@extends('layouts.admin')

@section('content')

<div class="content-area">
              <div class="mr-breadcrumb">
                <div class="row">
                  <div class="col-lg-12">
                      <h4 class="heading">{{__('Website Footer')}}</h4>
                    <ul class="links">
                      <li>
                        <a href="{{ route('admin.dashboard') }}">{{__('Dashboard')}} </a>
                      </li>
                      <li>
                        <a href="javascript:;">{{__('General Settings')}}</a>
                      </li>
                      <li>
                        <a href="{{ route('admin.generalsettings.footer')}}">{{__('Footer')}}</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="add-product-content">
                @include('includes.admin.form-both')
                <div class="row justify-content-center">
                  <div class="col-lg-8">
                    <div class="product-description">
                      <div class="body-area">
<form class="uplogo-form" id="elitedesignform" action="{{route('admin.generalsettings.update')}}" method="POST" enctype="multipart/form-data">
                          {{ csrf_field() }}
                          <div class="row justify-content-center">
                              <div class="col-lg-12">
                                <div class="left-area">
                                    <h4 class="heading">
                                        {{__('Copyright Text')}} *
                                        <p class="sub-heading">{{(__('In Any Language'))}}</p>
                                    </h4>
                                  
                                </div>
                              </div>
                              <div class="col-lg-12">
                                  <div class="tawk-area">
                                  <textarea name="copyright_text" required="">{{$data->copyright_text}}</textarea>
                                  </div>
                              </div>
                            </div>
							
							
							
							
							                         <div class="row justify-content-center">
                              <div class="col-lg-12">
                                <div class="left-area">
                                    <h4 class="heading">
                                        Sompadok & Prokashok *
                                        <p class="sub-heading">{{(__('In Any Language'))}}</p>
                                    </h4>
                                  
                                </div>
                              </div>
                              <div class="col-lg-12">
                                  <div class="tawk-area">
                                  <textarea name="sompadok" required="">{{$data->sompadok}}</textarea>
                                  </div>
                              </div>
                            </div>
							
														                         <div class="row justify-content-center">
                              <div class="col-lg-12">
                                <div class="left-area">
                                    <h4 class="heading">
                                      Nirbahi Sompadok *
                                        <p class="sub-heading">{{(__('In Any Language'))}}</p>
                                    </h4>
                                  
                                </div>
                              </div>
                              <div class="col-lg-12">
                                  <div class="tawk-area">
                                  <textarea name="nirbahi_sompadok" required="">{{$data->nirbahi_sompadok}}</textarea>
                                  </div>
                              </div>
                            </div>
							
							<div class="row justify-content-center">
							                              <div class="col-lg-12">
                                <div class="left-area">
                                    <h4 class="heading">
                                      Barta Sompadok *
                                        <p class="sub-heading">{{(__('In Any Language'))}}</p>
                                    </h4>
                                  
                                </div>
                              </div>
                              <div class="col-lg-12">
                                  <div class="tawk-area">
                                  <textarea name="barta_sompadok" required="">{{$data->barta_sompadok}}</textarea>
                                  </div>
                              </div>
                            </div>
							
							
							
							
							<div class="row justify-content-center">
                              <div class="col-lg-12">
                                <div class="left-area">
                                    <h4 class="heading">
                                        Live TV Code *
                                        <p class="sub-heading">{{(__('In Any Language'))}}</p>
                                    </h4>
                                  
                                </div>
                              </div>
                              <div class="col-lg-12">
                                  <div class="tawk-area">
                                  <textarea name="live_tv" required="">{{$data->live_tv}}</textarea>
                                  </div>
                              </div>
                            </div>
							
							
							
							
														<div class="row justify-content-center">
                              <div class="col-lg-12">
                                <div class="left-area">
                                    <h4 class="heading">
                                        Google Map Code *
                                        <p class="sub-heading">{{(__('In Any Language'))}}</p>
                                    </h4>
                                  
                                </div>
                              </div>
                              <div class="col-lg-12">
                                  <div class="tawk-area">
                                  <textarea name="google_map" required="">{{$data->google_map}}</textarea>
                                  </div>
                              </div>
                            </div>
							
							
							
							
							
							
							
							
														<div class="row justify-content-center">
                              <div class="col-lg-12">
                                <div class="left-area">
                                    <h4 class="heading">
                                        Facebook Page ID *
                                        <p class="sub-heading">{{(__('In Any Language'))}}</p>
                                    </h4>
                                  
                                </div>
                              </div>
                              <div class="col-lg-12">
                                  <div class="tawk-area">
                                  <textarea name="facebookpage_id" required="">{{$data->facebookpage_id}}</textarea>
                                  </div>
                              </div>
                            </div>
							
							
							<div class="row justify-content-center">
                              <div class="col-lg-12">
                                <div class="left-area">
                                    <h4 class="heading">
                                        Dhaka Bivag Map Link *
                                        <p class="sub-heading">{{(__('In Any Language'))}}</p>
                                    </h4>
                                  
                                </div>
                              </div>
                              <div class="col-lg-12">
                                  <div class="tawk-area">
                                  <textarea name="dhaka" required="">{{$data->dhaka}}</textarea>
                                  </div>
                              </div>
                            </div>
							
							
														<div class="row justify-content-center">
                              <div class="col-lg-12">
                                <div class="left-area">
                                    <h4 class="heading">
                                        Khulna Bivag Map Link *
                                        <p class="sub-heading">{{(__('In Any Language'))}}</p>
                                    </h4>
                                  
                                </div>
                              </div>
                              <div class="col-lg-12">
                                  <div class="tawk-area">
                                  <textarea name="khulna" required="">{{$data->khulna}}</textarea>
                                  </div>
                              </div>
                            </div>
							
							<div class="row justify-content-center">
                              <div class="col-lg-12">
                                <div class="left-area">
                                    <h4 class="heading">
                                         Rajshahi Bivag Map Link  *
                                        <p class="sub-heading">{{(__('In Any Language'))}}</p>
                                    </h4>
                                  
                                </div>
                              </div>
                              <div class="col-lg-12">
                                  <div class="tawk-area">
                                  <textarea name="rajshahi" required="">{{$data->rajshahi}}</textarea>
                                  </div>
                              </div>
                            </div>
							
														<div class="row justify-content-center">
                              <div class="col-lg-12">
                                <div class="left-area">
                                    <h4 class="heading">
                                        CTG Bivag Map Link *
                                        <p class="sub-heading">{{(__('In Any Language'))}}</p>
                                    </h4>
                                  
                                </div>
                              </div>
                              <div class="col-lg-12">
                                  <div class="tawk-area">
                                  <textarea name="ctg" required="">{{$data->ctg}}</textarea>
                                  </div>
                              </div>
                            </div>
							
							
																					<div class="row justify-content-center">
                              <div class="col-lg-12">
                                <div class="left-area">
                                    <h4 class="heading">
                                        Maymonsingh Bivag Map Link *
                                        <p class="sub-heading">{{(__('In Any Language'))}}</p>
                                    </h4>
                                  
                                </div>
                              </div>
                              <div class="col-lg-12">
                                  <div class="tawk-area">
                                  <textarea name="maymonsingh" required="">{{$data->maymonsingh}}</textarea>
                                  </div>
                              </div>
                            </div>
							
							<div class="row justify-content-center">
                              <div class="col-lg-12">
                                <div class="left-area">
                                    <h4 class="heading">
                                        Barishal Bivag Map Link *
                                        <p class="sub-heading">{{(__('In Any Language'))}}</p>
                                    </h4>
                                  
                                </div>
                              </div>
                              <div class="col-lg-12">
                                  <div class="tawk-area">
                                  <textarea name="barishal" required="">{{$data->barishal}}</textarea>
                                  </div>
                              </div>
                            </div>
							
							                              <div class="row justify-content-center">
														  <div class="col-lg-12">
                                <div class="left-area">
                                    <h4 class="heading">
                                        Rangpur Bivag Map Link *
                                        <p class="sub-heading">{{(__('In Any Language'))}}</p>
                                    </h4>
                                  
                                </div>
                              </div>
                              <div class="col-lg-12">
                                  <div class="tawk-area">
                                  <textarea name="rangpur" required="">{{$data->rangpur}}</textarea>
                                  </div>
                              </div>
                            </div>
							<div class="row justify-content-center">
														                              <div class="col-lg-12">
                                <div class="left-area">
                                    <h4 class="heading">
                                        Syleth Bivag Map Link *
                                        <p class="sub-heading">{{(__('In Any Language'))}}</p>
                                    </h4>
                                  
                                </div>
                              </div>
                              <div class="col-lg-12">
                                  <div class="tawk-area">
                                  <textarea name="syleth" required="">{{$data->syleth}}</textarea>
                                  </div>
                              </div>
                            </div>
							
							
							
							<div class="row justify-content-center">
							                              <div class="col-lg-12">
                                <div class="left-area">
                                    <h4 class="heading">
                                      Address *
                                        <p class="sub-heading">{{(__('In Any Language'))}}</p>
                                    </h4>
                                  
                                </div>
                              </div>
                              <div class="col-lg-12">
                                  <div class="tawk-area">
                                  <textarea name="address" required="">{{$data->address}}</textarea>
                                  </div>
                              </div>
                            </div>
							
							
							
														<div class="row justify-content-center">
							                              <div class="col-lg-12">
                                <div class="left-area">
                                    <h4 class="heading">
                                      Phone Number *
                                        <p class="sub-heading">{{(__('In Any Language'))}}</p>
                                    </h4>
                                  
                                </div>
                              </div>
                              <div class="col-lg-12">
                                  <div class="tawk-area">
                                  <textarea name="mobile" required="">{{$data->mobile}}</textarea>
                                  </div>
                              </div>
                            </div>
							
							
																					<div class="row justify-content-center">
							                              <div class="col-lg-12">
                                <div class="left-area">
                                    <h4 class="heading">
                                      Email Address *
                                        <p class="sub-heading">{{(__('In Any Language'))}}</p>
                                    </h4>
                                  
                                </div>
                              </div>
                              <div class="col-lg-12">
                                  <div class="tawk-area">
                                  <textarea name="email_address" required="">{{$data->email_address}}</textarea>
                                  </div>
                              </div>
                            </div>
							
							
							
                          <div class="row justify-content-center">
                              <div class="col-lg-12">
                                <div class="left-area">
                                    <h4 class="heading">
                                        {{__('Footer Text')}} *
                                        <p class="sub-heading">{{(__('In Any Language'))}}</p>
                                    </h4>
                                </div>
                              </div>
                              <div class="col-lg-12">
                                  <div class="tawk-area">
                                    <textarea class="nic-edit"  name="footer_text">{{$data->footer_text}}</textarea>
                                  </div>
                              </div>
                            </div>


<div class="row justify-content-center">
                              <div class="col-lg-12">
                                <div class="left-area">
                                    <h4 class="heading">
                                        {{__('Notice')}} *
                                        <p class="sub-heading">{{(__('In Any Language'))}}</p>
                                    </h4>
                                </div>
                              </div>
                              <div class="col-lg-12">
                                  <div class="tawk-area">
                                    <textarea class="nic-edit"  name="notice">{{$data->notice}}</textarea>
                                  </div>
                              </div>
                            </div>


                        <div class="row justify-content-center">
                          <div class="col-lg-12">
                            <button class="addProductSubmit-btn" type="submit">{{__('Save')}}</button>
                          </div>
                        </div>
                     </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

@endsection