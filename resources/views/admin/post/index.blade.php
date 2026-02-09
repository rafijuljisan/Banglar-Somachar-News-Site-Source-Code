@extends('layouts.admin')

@section('content')
    <input type="hidden" id="headerdata" value="{{ __('POSTS') }}">
    <div class="content-area">
        <div class="mr-breadcrumb">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="heading">{{ __('All Posts') }} <small id="filter-summary"></small></h4>
                    <ul class="links">
                        <li>
                            <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                        </li>
                        <li>
                            <a href="{{ route('post.index') }}">{{ __('Posts') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- ADVANCED FILTER PANEL --}}
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="fas fa-filter"></i> {{ __('Advanced Filters') }}
                    <button class="btn btn-sm btn-light float-right" id="toggle-filters">
                        <i class="fas fa-chevron-down"></i> {{ __('Toggle') }}
                    </button>
                    <button class="btn btn-sm btn-warning float-right mr-2" id="reset-filters">
                        <i class="fas fa-undo"></i> {{ __('Reset All') }}
                    </button>
                </h5>
            </div>
            <div class="card-body" id="filter-panel">
                <div class="row">
                    {{-- Language Filter --}}
                    <div class="col-md-3 mb-3">
                        <label><b><i class="fas fa-language"></i> {{ __('Language') }}</b></label>
                        <select class="form-control filter-select" id="filter_lang" name="lang">
                            <option value="">{{ __('All Languages') }}</option>
                            @foreach ($languages as $language)
                                <option value="{{ $language->id }}" {{ $language->is_default == 1 ? 'selected' : '' }}>
                                    {{ $language->language }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Category Filter --}}
                    <div class="col-md-3 mb-3">
                        <label><b><i class="fas fa-folder"></i> {{ __('Category') }}</b></label>
                        <select class="form-control filter-select" id="filter_category" name="category">
                            <option value="">{{ __('All Categories') }}</option>
                        </select>
                    </div>

                    {{-- Subcategory Filter --}}
                    <div class="col-md-3 mb-3">
                        <label><b><i class="fas fa-folder-open"></i> {{ __('Subcategory') }}</b></label>
                        <select class="form-control filter-select" id="filter_subcategory" name="subcategory">
                            <option value="">{{ __('All Subcategories') }}</option>
                        </select>
                    </div>

                    {{-- Author Filter --}}
                    <div class="col-md-3 mb-3">
                        <label><b><i class="fas fa-user-edit"></i> {{ __('Author') }}</b></label>
                        <select class="form-control filter-select" id="filter_author" name="author">
                            <option value="">{{ __('All Authors') }}</option>
                            @foreach ($authors as $author)
                                <option value="{{ $author->id }}">{{ $author->name }}</option>
                            @endforeach
                        </select>
                        <small>
                            <a href="#" id="view-author-stats" class="text-primary">
                                <i class="fas fa-chart-bar"></i> {{ __('View Stats') }}
                            </a>
                        </small>
                    </div>

                    {{-- Post Type Filter --}}
                    <div class="col-md-3 mb-3">
                        <label><b><i class="fas fa-file-alt"></i> {{ __('Post Type') }}</b></label>
                        <select class="form-control filter-select" id="filter_post_type" name="post_type">
                            <option value="">{{ __('All Types') }}</option>
                            @foreach ($postTypes as $type)
                                <option value="{{ $type }}">{{ ucfirst($type) }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Approval Status Filter --}}
                    <div class="col-md-3 mb-3">
                        <label><b><i class="fas fa-check-circle"></i> {{ __('Approval Status') }}</b></label>
                        <select class="form-control filter-select" id="filter_approval" name="approval_status">
                            <option value="">{{ __('All Status') }}</option>
                            <option value="0">{{ __('Approved') }}</option>
                            <option value="1">{{ __('Pending') }}</option>
                        </select>
                    </div>

                    {{-- Slider Status Filter --}}
                    <div class="col-md-3 mb-3">
                        <label><b><i class="fas fa-images"></i> {{ __('Slider Status') }}</b></label>
                        <select class="form-control filter-select" id="filter_slider" name="slider_status">
                            <option value="">{{ __('All') }}</option>
                            <option value="1">{{ __('In Slider') }}</option>
                            <option value="0">{{ __('Not in Slider') }}</option>
                        </select>
                    </div>

                    {{-- Breaking News Filter --}}
                    <div class="col-md-3 mb-3">
                        <label><b><i class="fas fa-newspaper"></i> {{ __('Breaking News') }}</b></label>
                        <select class="form-control filter-select" id="filter_breaking" name="breaking_status">
                            <option value="">{{ __('All') }}</option>
                            <option value="1">{{ __('Breaking') }}</option>
                            <option value="0">{{ __('Not Breaking') }}</option>
                        </select>
                    </div>

                    {{-- Featured Status Filter --}}
                    <div class="col-md-3 mb-3">
                        <label><b><i class="fas fa-star"></i> {{ __('Featured Status') }}</b></label>
                        <select class="form-control filter-select" id="filter_feature" name="feature_status">
                            <option value="">{{ __('All') }}</option>
                            <option value="1">{{ __('Featured') }}</option>
                            <option value="0">{{ __('Not Featured') }}</option>
                        </select>
                    </div>

                    {{-- Date From --}}
                    <div class="col-md-3 mb-3">
                        <label><b><i class="fas fa-calendar-alt"></i> {{ __('Date From') }}</b></label>
                        <input type="date" class="form-control filter-input" id="filter_date_from" name="date_from">
                    </div>

                    {{-- Date To --}}
                    <div class="col-md-3 mb-3">
                        <label><b><i class="fas fa-calendar-check"></i> {{ __('Date To') }}</b></label>
                        <input type="date" class="form-control filter-input" id="filter_date_to" name="date_to">
                    </div>

                    {{-- Quick Date Filters --}}
                    <div class="col-md-3 mb-3">
                        <label><b><i class="fas fa-clock"></i> {{ __('Quick Date') }}</b></label>
                        <select class="form-control" id="quick_date_filter">
                            <option value="">{{ __('Custom Range') }}</option>
                            <option value="today">{{ __('Today') }}</option>
                            <option value="yesterday">{{ __('Yesterday') }}</option>
                            <option value="last7days">{{ __('Last 7 Days') }}</option>
                            <option value="last30days">{{ __('Last 30 Days') }}</option>
                            <option value="thismonth">{{ __('This Month') }}</option>
                            <option value="lastmonth">{{ __('Last Month') }}</option>
                        </select>
                    </div>

                    {{-- Minimum Views --}}
                    <div class="col-md-3 mb-3">
                        <label><b><i class="fas fa-eye"></i> {{ __('Min Views') }}</b></label>
                        <input type="number" class="form-control filter-input" id="filter_min_views" name="min_views"
                            placeholder="0">
                    </div>

                    {{-- Maximum Views --}}
                    <div class="col-md-3 mb-3">
                        <label><b><i class="fas fa-eye-slash"></i> {{ __('Max Views') }}</b></label>
                        <input type="number" class="form-control filter-input" id="filter_max_views" name="max_views"
                            placeholder="∞">
                    </div>

                    {{-- Search Text --}}
                    <div class="col-md-3 mb-3">
                        <label><b><i class="fas fa-search"></i> {{ __('Search Title/Tags') }}</b></label>
                        <input type="text" class="form-control filter-input" id="filter_search" name="search_text"
                            placeholder="{{ __('Search...') }}">
                    </div>

                    {{-- Popular Posts Toggle --}}
                    <div class="col-md-3 mb-3">
                        <label><b><i class="fas fa-fire"></i> {{ __('Popular Posts') }}</b></label>
                        <select class="form-control filter-select" id="filter_popular" name="popular">
                            <option value="">{{ __('All Posts') }}</option>
                            <option value="true">{{ __('Most Popular') }}</option>
                        </select>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <button class="btn btn-primary" id="apply-filters">
                            <i class="fas fa-filter"></i> {{ __('Apply Filters') }}
                        </button>
                        <button class="btn btn-secondary" id="export-filtered">
                            <i class="fas fa-download"></i> {{ __('Export Filtered Data') }}
                        </button>
                        <button class="btn btn-info" id="save-filter-preset">
                            <i class="fas fa-save"></i> {{ __('Save Filter Preset') }}
                        </button>
                        <div class="float-right">
                            <span class="badge badge-info p-2" id="result-count">{{ __('0 results') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- BULK ACTIONS PANEL --}}
        <div class="product-area">
            <div class="row m-2 p-2 selectPost bg-light border rounded" style="display:none;">
                <div class="col-lg-12">
                    <strong><i class="fas fa-tasks"></i> {{ __('Bulk Actions:') }}</strong>
                    <button class="btn btn-sm btn-danger delete m-1" data-toggle="modal"
                        data-target="#confirm-delete-option">
                        <i class="fas fa-trash"></i> {{ __('Delete') }}
                    </button>
                    <button id="add-to-slider" class="btn btn-sm btn-secondary m-1">
                        <i class="fa fa-plus"></i> {{ __('Add to Slider') }}
                    </button>
                    <button id="add-to-breaking" class="btn btn-sm btn-secondary m-1">
                        <i class="fa fa-plus"></i> {{ __('Add to Breaking') }}
                    </button>
                    <button id="add-to-feature" class="btn btn-sm btn-secondary m-1">
                        <i class="fa fa-plus"></i> {{ __('Add to Feature') }}
                    </button>
                    <button id="add-to-slider-right" class="btn btn-sm btn-secondary m-1">
                        <i class="fa fa-plus"></i> {{ __('Add to Slider Right') }}
                    </button>
                    <button id="remove-to-slider" class="btn btn-sm btn-warning m-1">
                        <i class="fa fa-minus"></i> {{ __('Remove from Slider') }}
                    </button>
                    <button id="remove-to-breaking" class="btn btn-sm btn-warning m-1">
                        <i class="fa fa-minus"></i> {{ __('Remove from Breaking') }}
                    </button>
                    <button id="remove-to-feature" class="btn btn-sm btn-warning m-1">
                        <i class="fa fa-minus"></i> {{ __('Remove from Feature') }}
                    </button>
                    <button id="remove-to-slider-right" class="btn btn-sm btn-warning m-1">
                        <i class="fa fa-minus"></i> {{ __('Remove from Slider Right') }}
                    </button>
                    <span class="badge badge-dark p-2 ml-2" id="selected-count">0 {{ __('selected') }}</span>
                </div>
            </div>

            {{-- DATA TABLE --}}
            <div class="row">
                <div class="col-lg-12">
                    <div class="mr-table allproduct">
                        @include('includes.admin.form-success')
                        @include('includes.admin.flash-message')
                        <div class="table-responsive">
                            <table id="elitedesigntable" class="table table-hover dt-responsive" cellspacing="0"
                                width="100%">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" class="form-check-input m-0 p-0" id="headercheck"></th>
                                        <th>{{ __('Image') }}</th>
                                        <th>{{ __('Title') }}</th>
                                        <th>{{ __('Category') }}</th>
                                        <th>{{ __('Language') }}</th>
                                        <th>{{ __('Post Type') }}</th>
                                        <th>{{ __('Author') }}</th>
                                        <th>{{ __('Views') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Created At') }}</th>
                                        <th>{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- AUTHOR STATISTICS MODAL --}}
    <div class="modal fade" id="author-stats-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="fas fa-chart-line"></i> {{ __('Author Statistics') }}</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="author-stats-content">
                        <div class="text-center">
                            <i class="fas fa-spinner fa-spin fa-3x"></i>
                            <p>{{ __('Loading statistics...') }}</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                </div>
            </div>
        </div>
    </div>

    {{-- DELETE MODAL --}}
    <div class="modal fade-scale" id="confirm-delete-option" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header d-block text-center">
                    <h4 class="modal-title d-inline-block">{{ __('Confirm Delete') }}</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-center">{{ __('You are trying to delete selected posts.') }}</p>
                    <p class="text-center">{{ __('Do you want to proceed?') }}</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Cancel') }}</button>
                    <a class="btn btn-danger bulk-delete">{{ __('Delete') }}</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade-scale" id="confirm-delete" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header d-block text-center">
                    <h4 class="modal-title d-inline-block">{{ __('Confirm Delete') }}</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-center">{{ __('You are trying to delete this post.') }}</p>
                    <p class="text-center">{{ __('Do you want to proceed?') }}</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Cancel') }}</button>
                    <a class="btn btn-danger btn-ok">{{ __('Delete') }}</a>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript">
        "use strict";

        var table;
        var mainurl = "{{ url('/') }}/";

        $(document).ready(function () {

            // Initialize DataTable
            table = $('#elitedesigntable').DataTable({
                ordering: false,
                processing: true,
                serverSide: true,
                ajax: '{{ route('post.datatables') }}',
                columns: [
                    { data: 'checkbox', name: 'checkbox' },
                    { data: 'image_big', name: 'image_big' },
                    { data: 'title', name: 'title' },
                    { data: 'category_id', name: 'category_id' },
                    { data: 'language_id', name: 'language_id' },
                    { data: 'post_type', name: 'post_type' },
                    { data: 'admin_id', name: 'admin_id' },
                    { data: 'view_count', name: 'view_count' },
                    { data: 'is_approve', name: 'is_approve' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'action', searchable: false, orderable: false }
                ],
                language: {
                    processing: '<img src="{{asset('assets/images/' . $gs->admin_loader)}}">'
                },
                drawCallback: function (settings) {
                    $('.select').niceSelect();
                    updateResultCount();
                }
            });

            // Initialize filters
            filterLanguage();

            // Toggle filter panel
            $('#toggle-filters').click(function () {
                $('#filter-panel').slideToggle();
                $(this).find('i').toggleClass('fa-chevron-down fa-chevron-up');
            });

            // Apply filters
            $('#apply-filters').click(function () {
                applyFilters();
            });

            // Reset all filters
            $('#reset-filters').click(function () {
                $('.filter-select').val('').trigger('change');
                $('.filter-input').val('');
                $('#quick_date_filter').val('');
                applyFilters();
            });

            // Quick date filter
            $('#quick_date_filter').change(function () {
                var value = $(this).val();
                var today = new Date();
                var dateFrom, dateTo;

                switch (value) {
                    case 'today':
                        dateFrom = dateTo = formatDate(today);
                        break;
                    case 'yesterday':
                        var yesterday = new Date(today);
                        yesterday.setDate(yesterday.getDate() - 1);
                        dateFrom = dateTo = formatDate(yesterday);
                        break;
                    case 'last7days':
                        var last7 = new Date(today);
                        last7.setDate(last7.getDate() - 7);
                        dateFrom = formatDate(last7);
                        dateTo = formatDate(today);
                        break;
                    case 'last30days':
                        var last30 = new Date(today);
                        last30.setDate(last30.getDate() - 30);
                        dateFrom = formatDate(last30);
                        dateTo = formatDate(today);
                        break;
                    case 'thismonth':
                        dateFrom = formatDate(new Date(today.getFullYear(), today.getMonth(), 1));
                        dateTo = formatDate(today);
                        break;
                    case 'lastmonth':
                        var lastMonth = new Date(today.getFullYear(), today.getMonth() - 1, 1);
                        var lastMonthEnd = new Date(today.getFullYear(), today.getMonth(), 0);
                        dateFrom = formatDate(lastMonth);
                        dateTo = formatDate(lastMonthEnd);
                        break;
                }

                if (dateFrom && dateTo) {
                    $('#filter_date_from').val(dateFrom);
                    $('#filter_date_to').val(dateTo);
                }
            });

            // View author statistics
            $('#view-author-stats').click(function (e) {
                e.preventDefault();
                var authorId = $('#filter_author').val();

                if (!authorId) {
                    alert('{{ __("Please select an author first") }}');
                    return;
                }

                loadAuthorStats(authorId);
            });

            // Language filter change
            $('#filter_lang').change(function () {
                var langId = $(this).val();
                loadCategoriesByLanguage(langId);
            });

            // Category filter change
            $('#filter_category').change(function() {
                var categoryId = $(this).val();
                loadSubcategories(categoryId);
            });

            // Header checkbox
            $("#headercheck").click(function () {
                if (this.checked) {
                    $('.postCheck').prop('checked', true);
                } else {
                    $('.postCheck').prop('checked', false);
                }
                updateBulkActionsPanel();
            });

            // Individual checkbox change
            $(document).on('change', '.postCheck', function () {
                updateBulkActionsPanel();
            });
        });

        // Apply all filters
        function applyFilters() {
            var filters = {};

            // Collect all filter values
            $('.filter-select, .filter-input').each(function () {
                var name = $(this).attr('name');
                var value = $(this).val();
                if (value) {
                    filters[name] = value;
                }
            });

            // Build URL with query parameters
            var url = '{{ route('post.datatables') }}';
            var queryString = $.param(filters);

            if (queryString) {
                url += '?' + queryString;
            }

            // Reload table with new URL
            table.ajax.url(url).load();

            // Update filter summary
            updateFilterSummary(filters);
        }

        // Update filter summary
        function updateFilterSummary(filters) {
            var summary = [];
            var count = Object.keys(filters).length;

            if (count > 0) {
                summary.push(count + ' {{ __("filter(s) active") }}');
            }

            $('#filter-summary').html(summary.length > 0 ? '(' + summary.join(', ') + ')' : '');
        }

        // Load categories by language
        function loadCategoriesByLanguage(langId) {
            var url = mainurl + 'admin/category-filter/language/' + (langId || $('#filter_lang').val());

            $.ajax({
                type: 'GET',
                url: url,
                success: function (data) {
                    $("#filter_category").html(data);
                    $("#filter_subcategory").html('<option value="">{{ __("All Subcategories") }}</option>');
                }
            });
        }

        // Load subcategories
        function loadSubcategories(categoryId) {
            // If no category selected, clear the subcategory dropdown
            if (!categoryId) {
                $("#filter_subcategory").html('<option value="">All Subcategories</option>');
                return;
            }

            // Use the route we defined
            var url = '{{ route("post.subcategories", ":id") }}';
            url = url.replace(':id', categoryId);

            $.ajax({
                type: 'GET',
                url: url,
                success: function (response) {
                    // Since controller returns raw HTML string, put it directly into the select
                    $("#filter_subcategory").html(response);
                },
                error: function (xhr, status, error) {
                    console.log('Error loading subcategories: ' + error);
                }
            });
        }

        // Load author statistics
        function loadAuthorStats(authorId) {
            var dateFrom = $('#filter_date_from').val();
            var dateTo = $('#filter_date_to').val();

            $.ajax({
                type: 'GET',
                url: mainurl + 'admin/post/author-stats',
                data: {
                    author_id: authorId,
                    date_from: dateFrom,
                    date_to: dateTo
                },
                success: function (stats) {
                    var html = `
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card bg-primary text-white mb-3">
                                    <div class="card-body">
                                        <h3>${stats.total_posts}</h3>
                                        <p>{{ __('Total Posts') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-success text-white mb-3">
                                    <div class="card-body">
                                        <h3>${stats.approved_posts}</h3>
                                        <p>{{ __('Approved Posts') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-warning text-white mb-3">
                                    <div class="card-body">
                                        <h3>${stats.pending_posts}</h3>
                                        <p>{{ __('Pending Posts') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-info text-white mb-3">
                                    <div class="card-body">
                                        <h3>${stats.total_views}</h3>
                                        <p>{{ __('Total Views') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-secondary text-white mb-3">
                                    <div class="card-body">
                                        <h3>${stats.slider_posts}</h3>
                                        <p>{{ __('Slider Posts') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-danger text-white mb-3">
                                    <div class="card-body">
                                        <h3>${stats.breaking_posts}</h3>
                                        <p>{{ __('Breaking Posts') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h5 class="mt-4">{{ __('Posts by Type') }}</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>{{ __('Type') }}</th>
                                    <th>{{ __('Count') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                    `;

                    stats.posts_by_type.forEach(function (item) {
                        html += `<tr><td>${item.post_type}</td><td>${item.count}</td></tr>`;
                    });

                    html += `
                            </tbody>
                        </table>

                        <h5 class="mt-4">{{ __('Posts by Category') }}</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>{{ __('Category') }}</th>
                                    <th>{{ __('Count') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                    `;

                    stats.posts_by_category.forEach(function (item) {
                        html += `<tr><td>${item.title}</td><td>${item.count}</td></tr>`;
                    });

                    html += `
                            </tbody>
                        </table>

                        <div class="alert alert-info mt-3">
                            <strong>{{ __('Recent Activity:') }}</strong> 
                            ${stats.recent_posts_30_days} {{ __('posts in last 30 days') }}
                        </div>
                    `;

                    $('#author-stats-content').html(html);
                    $('#author-stats-modal').modal('show');
                },
                error: function () {
                    alert('{{ __("Error loading statistics") }}');
                }
            });
        }

        // Update bulk actions panel
        function updateBulkActionsPanel() {
            var checked = $(".postCheck:checked").length;

            if (checked > 0) {
                $('.selectPost').slideDown();
                $('#selected-count').text(checked + ' {{ __("selected") }}');
            } else {
                $('.selectPost').slideUp();
            }
        }

        // Update result count
        function updateResultCount() {
            var info = table.page.info();
            $('#result-count').text(info.recordsDisplay + ' {{ __("results") }}');
        }

        // Format date helper
        function formatDate(date) {
            var d = new Date(date),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();

            if (month.length < 2) month = '0' + month;
            if (day.length < 2) day = '0' + day;

            return [year, month, day].join('-');
        }

        // Initialize language filter on page load
        function filterLanguage() {
            loadCategoriesByLanguage();
        }

    </script>


    <script src="{{asset('assets/admin/js/bulk.js')}}"></script>

@endsection