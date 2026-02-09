@extends('layouts.admin')

@section('content')
<div class="content-area">
    <div class="mr-breadcrumb">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="heading">{{ __('Post Analytics') }}</h4>
                <ul class="links">
                    <li><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
                    <li><a href="{{ route('post.index') }}">{{ __('Posts') }}</a></li>
                    <li>{{ __('Analytics') }}</li>
                </ul>
            </div>
        </div>
    </div>

    {{-- Individual Post Analytics --}}
    @if(isset($post))
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                <i class="fas fa-chart-line"></i> {{ $post->title }}
            </h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="info-box bg-info">
                        <div class="info-box-content">
                            <span class="info-box-number">{{ $analytics['total_views'] }}</span>
                            <span class="info-box-text">{{ __('Total Views') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="info-box bg-success">
                        <div class="info-box-content">
                            <span class="info-box-number">{{ $analytics['unique_views'] }}</span>
                            <span class="info-box-text">{{ __('Unique Views') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="info-box bg-warning">
                        <div class="info-box-content">
                            <span class="info-box-number">{{ number_format($analytics['avg_views_per_day'], 1) }}</span>
                            <span class="info-box-text">{{ __('Avg Views/Day') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="info-box bg-danger">
                        <div class="info-box-content">
                            <span class="info-box-number">{{ $post->created_at->diffForHumans() }}</span>
                            <span class="info-box-text">{{ __('Published') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-6">
                    <h6><i class="fas fa-info-circle"></i> {{ __('Post Details') }}</h6>
                    <table class="table table-bordered">
                        <tr>
                            <th>{{ __('Author') }}</th>
                            <td>{{ $post->admin->name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Category') }}</th>
                            <td>{{ $post->category->title ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Language') }}</th>
                            <td>{{ $post->language->language ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Post Type') }}</th>
                            <td><span class="badge badge-secondary">{{ $post->post_type }}</span></td>
                        </tr>
                        <tr>
                            <th>{{ __('Status') }}</th>
                            <td>
                                @if($post->is_pending == 0)
                                    <span class="badge badge-success">{{ __('Approved') }}</span>
                                @else
                                    <span class="badge badge-warning">{{ __('Pending') }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>{{ __('Featured') }}</th>
                            <td>
                                @if($post->is_slider) <span class="badge badge-info">{{ __('Slider') }}</span> @endif
                                @if($post->is_trending) <span class="badge badge-danger">{{ __('Breaking') }}</span> @endif
                                @if($post->is_feature) <span class="badge badge-success">{{ __('Featured') }}</span> @endif
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="col-md-6">
                    <h6><i class="fas fa-chart-bar"></i> {{ __('Views by Date (Last 30 Days)') }}</h6>
                    <canvas id="viewsChart" height="250"></canvas>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <h6><i class="fas fa-history"></i> {{ __('Recent Views History') }}</h6>
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>{{ __('Date') }}</th>
                                <th>{{ __('View Count') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($analytics['views_by_date'] as $viewData)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($viewData->date)->format('M d, Y') }}</td>
                                <td><span class="badge badge-primary">{{ $viewData->count }}</span></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <a href="{{ route('post.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> {{ __('Back to Posts') }}
                    </a>
                    <a href="{{ route('frontend.details', [$post->id, $post->slug]) }}" target="_blank" class="btn btn-primary">
                        <i class="fas fa-external-link-alt"></i> {{ __('View on Frontend') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Overall Analytics Dashboard --}}
    @if(!isset($post))
    <div class="row">
        <div class="col-md-12 mb-3">
            <div class="card">
                <div class="card-header">
                    <h6><i class="fas fa-calendar"></i> {{ __('Date Range') }}</h6>
                </div>
                <div class="card-body">
                    <form id="analytics-date-form">
                        <div class="row">
                            <div class="col-md-4">
                                <label>{{ __('From Date') }}</label>
                                <input type="date" class="form-control" id="analytics_date_from" name="date_from" value="{{ \Carbon\Carbon::now()->subDays(30)->format('Y-m-d') }}">
                            </div>
                            <div class="col-md-4">
                                <label>{{ __('To Date') }}</label>
                                <input type="date" class="form-control" id="analytics_date_to" name="date_to" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                            </div>
                            <div class="col-md-4">
                                <label>&nbsp;</label><br>
                                <button type="button" class="btn btn-primary" id="load-analytics">
                                    <i class="fas fa-sync"></i> {{ __('Load Data') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="analytics-dashboard">
        <div class="text-center p-5">
            <i class="fas fa-spinner fa-spin fa-3x"></i>
            <p>{{ __('Loading analytics...') }}</p>
        </div>
    </div>
    @endif
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>

<script>
"use strict";

@if(isset($post))
// Individual post analytics chart
var ctx = document.getElementById('viewsChart').getContext('2d');
var viewsData = @json($analytics['views_by_date']);

var labels = viewsData.map(item => item.date);
var data = viewsData.map(item => item.count);

var chart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: labels.reverse(),
        datasets: [{
            label: '{{ __("Views") }}',
            data: data.reverse(),
            borderColor: 'rgb(75, 192, 192)',
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            tension: 0.1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1
                }
            }
        }
    }
});
@else
// Dashboard analytics
$(document).ready(function() {
    loadAnalyticsDashboard();

    $('#load-analytics').click(function() {
        loadAnalyticsDashboard();
    });
});

function loadAnalyticsDashboard() {
    var dateFrom = $('#analytics_date_from').val();
    var dateTo = $('#analytics_date_to').val();

    $.ajax({
        url: '{{ route('post.analytics.dashboard') }}',
        type: 'GET',
        data: {
            date_from: dateFrom,
            date_to: dateTo
        },
        success: function(data) {
            renderDashboard(data);
        },
        error: function() {
            alert('{{ __("Error loading analytics") }}');
        }
    });
}

function renderDashboard(data) {
    var html = `
        <div class="row">
            <div class="col-md-3">
                <div class="card bg-primary text-white mb-3">
                    <div class="card-body">
                        <h2>${data.total_posts}</h2>
                        <p>{{ __('Total Posts') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white mb-3">
                    <div class="card-body">
                        <h2>${data.total_views}</h2>
                        <p>{{ __('Total Views') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-info text-white mb-3">
                    <div class="card-body">
                        <h2>${data.approved_posts}</h2>
                        <p>{{ __('Approved Posts') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-white mb-3">
                    <div class="card-body">
                        <h2>${data.pending_posts}</h2>
                        <p>{{ __('Pending Posts') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h6><i class="fas fa-users"></i> {{ __('Top 10 Authors') }}</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>{{ __('Author') }}</th>
                                    <th>{{ __('Posts') }}</th>
                                </tr>
                            </thead>
                            <tbody>
    `;

    data.top_authors.forEach(function(author) {
        html += `<tr><td>${author.admin ? author.admin.name : 'Unknown'}</td><td><span class="badge badge-primary">${author.post_count}</span></td></tr>`;
    });

    html += `
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h6><i class="fas fa-folder"></i> {{ __('Top 10 Categories') }}</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>{{ __('Category') }}</th>
                                    <th>{{ __('Posts') }}</th>
                                </tr>
                            </thead>
                            <tbody>
    `;

    data.top_categories.forEach(function(category) {
        html += `<tr><td>${category.category ? category.category.title : 'Unknown'}</td><td><span class="badge badge-primary">${category.post_count}</span></td></tr>`;
    });

    html += `
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h6><i class="fas fa-chart-line"></i> {{ __('Daily Post Trend') }}</h6>
                    </div>
                    <div class="card-body">
                        <canvas id="dailyTrendChart" height="100"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h6><i class="fas fa-file-alt"></i> {{ __('Posts by Type') }}</h6>
                    </div>
                    <div class="card-body">
                        <canvas id="postTypeChart" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
    `;

    $('#analytics-dashboard').html(html);

    // Render charts
    renderDailyTrendChart(data.daily_posts);
    renderPostTypeChart(data.posts_by_type);
}

function renderDailyTrendChart(dailyPosts) {
    var ctx = document.getElementById('dailyTrendChart').getContext('2d');
    var labels = dailyPosts.map(item => item.date);
    var data = dailyPosts.map(item => item.count);

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: '{{ __("Posts per Day") }}',
                data: data,
                borderColor: 'rgb(54, 162, 235)',
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true
        }
    });
}

function renderPostTypeChart(postsByType) {
    var ctx = document.getElementById('postTypeChart').getContext('2d');
    var labels = postsByType.map(item => item.post_type);
    var data = postsByType.map(item => item.count);

    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                data: data,
                backgroundColor: [
                    'rgb(255, 199, 211)',
                    'rgb(186, 228, 255)',
                    'rgb(255, 236, 192)',
                    'rgb(188, 255, 255)',
                    'rgb(207, 183, 255)',
                    'rgb(255, 228, 202)'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true
        }
    });
}
@endif
</script>

@endsection

<style>
.info-box {
    padding: 20px;
    border-radius: 8px;
    margin-bottom: 20px;
    color: white;
}

.info-box-content {
    text-align: center;
}

.info-box-number {
    display: block;
    font-size: 32px;
    font-weight: bold;
    margin-bottom: 10px;
}

.info-box-text {
    display: block;
    font-size: 14px;
    text-transform: uppercase;
}
</style>