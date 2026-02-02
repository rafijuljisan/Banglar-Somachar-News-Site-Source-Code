@extends('layouts.front')

@section('contents')

<style>
    
</style>

<div id="error-page">
    <div class="error-content">
        <h1>404</h1>
        <h2>Page Not Found</h2>
        
        <h3>দুঃখিত, পেইজটি খুঁজে পাওয়া যায়নি</h3>
        
        <div class="divider"></div>

        <p>
            The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.<br>
            আপনার কাঙ্ক্ষিত পাতাটি সম্ভবত মুছে ফেলা হয়েছে অথবা সাময়িকভাবে বন্ধ আছে।
        </p>

        <a href="{{ route('frontend.index') }}" class="btn-news">
            <i class="fas fa-arrow-left"></i> Back to Homepage
        </a>
    </div>
</div>

@endsection