@extends('layouts.admin')

@section('content')

    <div class="content-area">
        <div class="mr-breadcrumb">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="heading">{{ __('Add Advertisement') }}</h4>
                    <ul class="links">
                        <li><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a></li>
                        <li><a href="{{ route('ads.index') }}">{{ __('Advertisements') }}</a></li>
                        <li><a href="javascript:;">{{ __('Add New') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="add-product-content">
            @include('includes.admin.form-success')
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="product-description">
                        <div class="body-area">
                            @include('includes.admin.form-error')

                            <div class="gocover"
                                style="background: url({{asset('assets/images/' . $gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);">
                            </div>

                            <form id="geniusformdata" action="{{ route('ads.store') }}" method="POST"
                                enctype="multipart/form-data">
                                {{csrf_field()}}

                                {{-- PLACEMENT --}}
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="left-area">
                                            <h4 class="heading">{{ __('Placement') }} *</h4>
                                            <p class="sub-heading">{{ __('Where will this ad show?') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <select name="add_placement" id="placement" class="input-field" required>
                                            <option value="">{{__('Select Position')}}</option>

                                            {{-- Header --}}
                                            <option value="header" data-size="size_728">{{__('Header Top (728x90)')}}
                                            </option>

                                            {{-- Homepage 728x90 Series --}}
                                            <option value="header1_728" data-size="size_728">{{__('Homepage 1 (728x90)')}}
                                            </option>
                                            <option value="header2_728" data-size="size_728">{{__('Homepage 2 (728x90)')}}
                                            </option>
                                            <option value="header3_728" data-size="size_728">{{__('Homepage 3 (728x90)')}}
                                            </option>
                                            <option value="header4_728" data-size="size_728">{{__('Homepage 4 (728x90)')}}
                                            </option>

                                            {{-- Homepage 970x90 Series --}}
                                            <option value="homepageads1_970" data-size="size_728">
                                                {{__('Homepage 1 (970x90)')}}</option>
                                            <option value="homepageads2_970" data-size="size_728">
                                                {{__('Homepage 2 (970x90)')}}</option>
                                            <option value="homepageads3_970" data-size="size_728">
                                                {{__('Homepage 3 (970x90)')}}</option>
                                            <option value="homepageads4_970" data-size="size_728">
                                                {{__('Homepage 4 (970x90)')}}</option>

                                            {{-- Sidebar Series --}}
                                            <option value="sidebar_ads" data-size="size_234">{{__('Sidebar Ads (234x60)')}}</option>
                                            <option value="sidebar1_ads" data-size="size_234">{{__('Sidebar 1 (300x250)')}}
                                            </option>
                                            <option value="sidebar2_ads" data-size="size_234">{{__('Sidebar 2 (300x250)')}}
                                            </option>
                                            <option value="sidebar3_ads" data-size="size_234">{{__('Sidebar 3 (300x250)')}}
                                            </option>
                                            <option value="sidebar_bottom" data-size="size_234">{{__('Sidebar Bottom')}}
                                            </option>

                                            {{-- Others --}}
                                            <option value="index_bottom" data-size="size_728">{{__('Index Bottom')}}
                                            </option>
                                            <option value="single_page_sponsor" data-size="size_728">{{__('Single Page Sponsor')}}</option>
                                            <option value="single_sidebar_ads" data-size="size_234">{{__('Single Sidebar Ads')}}</option>
                                        </select>
                                        <small id="size_guideline" class="text-danger d-block mt-2 font-weight-bold"
                                            style="display:none;"></small>
                                    </div>
                                </div>

                                {{-- SIZE --}}
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="left-area">
                                            <h4 class="heading">{{ __('Banner Size') }} *</h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <select name="addSize" id="banner_size" class="input-field" required>
                                            <option value="">{{__('Select Size')}}</option>
                                            <option value="size_728">{{__('728x90 (Leaderboard)')}}</option>
                                            <option value="size_468">{{__('468x60 (Full Banner)')}}</option>
                                            <option value="size_234">{{__('234x60 (Half Banner)')}}</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- TYPE --}}
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="left-area">
                                            <h4 class="heading">{{ __('Ad Type') }} *</h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <select name="banner_type" id="banner_type" class="input-field" required>
                                            <option value="upload">{{__('Upload Image File')}}</option>
                                            <option value="url">{{__('External Image URL')}}</option>
                                            <option value="code">{{__('Google Adsense / Script')}}</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- UPLOAD --}}
                                <div class="row show-section" id="section_upload">
                                    <div class="col-lg-4">
                                        <div class="left-area">
                                            <h4 class="heading">{{ __('Upload Image') }} *</h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="img-upload">
                                            <div id="image-preview" class="img-preview"
                                                style="background: url({{ asset('assets/admin/images/upload.png') }});">
                                                <label for="image-upload" class="img-label" id="image-label">
                                                    <i class="icofont-upload-alt"></i>{{ __('Click or Drop File') }}
                                                </label>
                                                <input type="file" name="photo" class="img-upload" id="image-upload">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- URL --}}
                                <div class="row show-section d-none" id="section_url">
                                    <div class="col-lg-4">
                                        <div class="left-area">
                                            <h4 class="heading">{{ __('Image URL') }} *</h4>
                                            <p class="sub-heading">(e.g. https://example.com/banner.jpg)</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <input type="url" class="input-field" name="photo_url" placeholder="https://...">
                                    </div>
                                </div>

                                {{-- CODE --}}
                                <div class="row show-section d-none" id="section_code">
                                    <div class="col-lg-4">
                                        <div class="left-area">
                                            <h4 class="heading">{{ __('Ad Script') }} *</h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <textarea class="input-field" name="banner_code" placeholder="<script>...</script>"
                                            style="min-height: 150px;"></textarea>
                                    </div>
                                </div>

                                {{-- REDIRECT --}}
                                <div class="row" id="section_link">
                                    <div class="col-lg-4">
                                        <div class="left-area">
                                            <h4 class="heading">{{ __('Redirect URL') }} *</h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <input type="text" class="input-field" name="link" placeholder="https://..."
                                            autocomplete="off">
                                    </div>
                                </div>

                                {{-- STATUS --}}
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="left-area">
                                            <h4 class="heading">{{__('Status')}} *</h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="custom-control custom-radio d-inline-block mr-4">
                                            <input class="custom-control-input" type="radio" name="status" value="1"
                                                id="enable" checked>
                                            <label class="custom-control-label" for="enable">{{__('Active')}}</label>
                                        </div>
                                        <div class="custom-control custom-radio d-inline-block">
                                            <input class="custom-control-input" type="radio" name="status" value="0"
                                                id="disable">
                                            <label class="custom-control-label" for="disable">{{__('Inactive')}}</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4"></div>
                                    <div class="col-lg-7">
                                        <button class="addProductSubmit-btn"
                                            type="submit">{{ __('Create Advertisement') }}</button>
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

@section('scripts')
    <script>
        $(document).ready(function () {

            // 1. GUIDELINES
            $('#placement').on('change', function () {
                var selectedOption = $(this).find(':selected');
                var recommendedSize = selectedOption.data('size');
                var sizeText = {
                    'size_728': 'Recommended Size: 728x90 Pixel',
                    'size_468': 'Recommended Size: 468x60 Pixel',
                    'size_234': 'Recommended Size: 234x60 Pixel'
                };
                if (recommendedSize && sizeText[recommendedSize]) {
                    $('#size_guideline').text(sizeText[recommendedSize]).show();
                    $('#banner_size').val(recommendedSize); // Auto select size
                } else {
                    $('#size_guideline').hide();
                }
            });

            // 2. TOGGLE
            $('#banner_type').on('change', function () {
                var type = $(this).val();
                $('.show-section').addClass('d-none');

                if (type === 'upload') {
                    $('#section_upload').removeClass('d-none');
                    $('#section_link').removeClass('d-none');
                }
                else if (type === 'url') {
                    $('#section_url').removeClass('d-none');
                    $('#section_link').removeClass('d-none');
                }
                else if (type === 'code') {
                    $('#section_code').removeClass('d-none');
                    $('#section_link').addClass('d-none');
                }
            });
        });
    </script>
@endsection