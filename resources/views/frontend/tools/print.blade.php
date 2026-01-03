<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $post->title }}</title>
    {{-- Load Newspaper Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;1,400&family=Playfair+Display:wght@400;700;900&display=swap" rel="stylesheet">
    
    <style>
        /* --- Reset & Base --- */
        body { margin: 0; padding: 0; background: #e0e0e0; font-family: 'Merriweather', serif; }
        
        /* --- Main Paper Container --- */
        #upg-print-area {
            width: 800px;
            max-width: 800px;
            margin: 40px auto;
            background: #ffffffff;
            padding: 20px 25px;
            box-sizing: border-box;
            box-shadow: 0 0 20px rgba(0,0,0,0.5);
            color: #1a1a1a;
            position: relative;
        }

        /* --- Compact Header --- */
        .upg-header-section {
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
            text-align: center;
        }
        
        /* Logo styling - Full Width & Colored */
        .upg-logo img { 
            max-width: 100%; 
            height: auto; 
            width: auto;
            max-height: 120px; 
            filter: none; 
            margin-bottom: 10px;
        }

        /* Date Line (Bangla Font Support) */
        .upg-meta-info {
            font-family: 'SolaimanLipi', 'Merriweather', sans-serif; /* Fallback for Bangla */
            font-size: 16px;
            color: #555;
            margin-top: 5px;
        }
        .upg-meta-info span { margin: 0 8px; }

        /* --- Headline --- */
        .upg-title {
            text-align: center;
            font-family: 'Playfair Display', serif;
            font-weight: 900;
            font-size: 32px; 
            line-height: 1.2;
            margin: 20px 0;
            color: #000;
        }

        /* --- Content Layout (Columns) --- */
        .upg-content {
            column-count: 2;
            column-gap: 30px;
            column-rule: 1px solid #eee;
            text-align: justify;
        }

        /* --- Featured Image (Inside Column) --- */
        .upg-feature-image {
            width: 100%; 
            margin-bottom: 15px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
            break-inside: avoid; 
        }
        
        /* Featured Image Styling - Natural Color */
        .upg-feature-image img {
            width: 100%;
            height: auto;
            display: block;
            filter: none;
        }
        .image-caption {
            font-size: 10px;
            color: #666;
            font-style: italic;
            margin-top: 3px;
            text-align: center;
            font-family: sans-serif;
        }

        /* --- Text Styling --- */
        .upg-text-content {
            font-size: 13px; 
            line-height: 1.7;
            color: #2c2c2c;
        }
        
        .upg-text-content p { margin-top: 0; margin-bottom: 15px; }

        /* Drop Cap */
        .upg-text-content > p:first-of-type::first-letter {
            float: left;
            font-family: 'Playfair Display', serif;
            font-size: 48px;
            line-height: 40px;
            padding-top: 2px;
            padding-right: 6px;
            padding-left: 2px;
            color: #000;
        }

        /* Footer */
        .upg-footer {
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #ccc;
            text-align: center;
            font-size: 12px;
            color: #888;
            font-family: 'SolaimanLipi', sans-serif;
        }

        /* --- Buttons --- */
        .upg-action-buttons {
            width: 800px;
            margin: 0 auto 50px auto;
            text-align: center;
        }
        .upg-action-buttons button {
            padding: 10px 25px;
            font-size: 14px;
            cursor: pointer;
            margin: 0 10px;
            border-radius: 4px;
            border: none;
            font-weight: bold;
            box-shadow: 0 4px 6px rgba(0,0,0,0.3);
        }
        #upg-save-jpg { background-color: #2ea44f; color: white; }
        #upg-print-pdf { background-color: #0e61d4; color: white; }
        
        .upg-print-credit { text-align: center; color: #aaa; font-size: 12px; margin-top: -30px; margin-bottom: 30px; font-family: sans-serif; }
        .upg-print-credit a { color: #fff; text-decoration: none; }

        /*@media print {
            body { background: #fff; }
            #upg-print-area { margin: 0; box-shadow: none; width: 100%; max-width: 100%; padding: 0; }
            .upg-action-buttons, .upg-print-credit { display: none; }
        }*/
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
</head>
<body>

    {{-- PHP Block to Convert Dates to Bangla --}}
    @php
        $eng = ['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 
                'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December', 
                '0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $ban = ['শনিবার', 'রবিবার', 'সোমবার', 'মঙ্গলবার', 'বুধবার', 'বৃহস্পতিবার', 'শুক্রবার', 
                'জানুয়ারি', 'ফেব্রুয়ারি', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'আগস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর', 
                '০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];

        // Convert Print Date (Today)
        $print_date = str_replace($eng, $ban, date('l, d F, Y'));

        // Convert Publish Date
        $publish_date = str_replace($eng, $ban, date('d F, Y', strtotime($post->created_at)));

        // Convert Current Year for Footer
        $current_year = str_replace($eng, $ban, date('Y'));
    @endphp

    <div id="upg-print-area">
        
        {{-- COMPACT HEADER --}}
        <div class="upg-header-section">
            
            {{-- LOGO LOGIC --}}
            @if($gs->print_logo)
                <div class="upg-logo">
                    <img src="{{ asset('assets/images/'.$gs->print_logo) }}" alt="Print Logo">
                </div>
            @elseif($gs->logo)
                <div class="upg-logo">
                    <img src="{{ asset('assets/images/'.$gs->logo) }}" alt="{{ $gs->title }}">
                </div>
            @endif
            
            {{-- HEADER META (With Bangla Date) --}}
            <div class="upg-meta-info">
                <span>প্রিন্ট তারিখ: {{ $print_date }}</span>
                |
                <span>{{ $gs->print_header_text ?? $gs->title }}</span>
                |
                <span>প্রকাশের তারিখ: {{ $publish_date }}</span>
            </div>
        </div>
        
        {{-- HEADLINE --}}
        <h1 class="upg-title">{{ $post->title }}</h1>

        {{-- CONTENT FLOW --}}
        <div class="upg-content">
            
            {{-- IMAGE --}}
            @if($post->image_big)
            <div class="upg-feature-image">
                <img src="{{ asset('assets/images/post/'.$post->image_big) }}" alt="{{ $post->title }}">
                @if($post->image_caption)
                <div class="image-caption">{{ $post->image_caption }}</div>
                @endif
            </div>
            @endif

            <div class="upg-text-content">
                {!! $post->description !!}
            </div>
        </div>
        
        <div class="upg-footer">
             &copy; {{ $current_year }} <strong>{{ $gs->title }}</strong>. সর্বস্বত্ব সংরক্ষিত।
        </div>
    </div>

    <div class="upg-action-buttons">
        <button id="upg-save-jpg"><i class="fa fa-image"></i> Save Image</button>
        <button id="upg-print-pdf"><i class="fa fa-file-pdf"></i> Download PDF</button>
    </div>

    <div class='upg-print-credit'>
        Developed By: <a href='https://jisan.technomenia.com' target='_blank'>Md Jisan Sheikh</a>
    </div>

</body>
</html>