<div id="upg-photocard-modal-content">
    
    {{-- The Preview Area (1080x1080) --}}
    <div id="upg-photocard-preview-wrapper">
    <div id="upg-photocard-preview" style="width: 1080px; height: 1080px; position: relative; overflow: hidden; background-color: #ffffff;">
        
        {{-- Base Frame --}}
        @php 
            $default_frame = isset($frames[0]) ? $frames[0] : asset('assets/images/noimage.png'); 
        @endphp
        <img id="photocard-base-frame" src="{{ $default_frame }}" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 5;">

        {{-- Dynamic Image --}}
        @if($post->image_big)
        <div class="photocard-dynamic-image-area" style="position: absolute; top: 130px; left: 42px; width: 1001px; height: 565px; overflow: hidden; z-index: 2;">
            <img src="{{ asset('assets/images/post/'.$post->image_big) }}" style="position: absolute; width: 104%; height: 104%; top: -2%; left: -2%; object-fit: cover;">
        </div>
        @endif

        {{-- Dynamic Date (Bengali) --}}
        {{-- UPDATED: Increased width (500px) and moved left (550px) to keep it on one line --}}
        <div class="photocard-dynamic-date" style="position: absolute; top: 40px; left: 550px; width: 500px; text-align: right; color: white; font-size: 45px; font-weight: 600; font-family: 'solaiman-lipi', sans-serif; line-height: 1.2; display: flex; align-items: center; justify-content: flex-end; z-index: 10; padding-right: 30px;">
            {{ $bengali_date }}
        </div>

        {{-- Headline --}}
        <div class="photocard-headline-container" style="position: absolute; bottom: 160px; left: 50px; right: 50px; height: 150px; display: flex; align-items: center; justify-content: center; text-align: center; z-index: 10;">
            <h1 id="photocard-headline-text" style="text-align: center; font-family: 'Hind Siliguri', sans-serif; font-weight: 700; color: black; font-size: 60px; line-height: 1.3; padding: 0; margin: 0;">
                {{ $post->title }}
            </h1>
        </div>
        
    </div>
</div>

    {{-- Controls Sidebar --}}
    <div id="upg-photocard-controls">
        <h3>Customize Photocard</h3>
        
        <div class="control-group">
            <label>Adjust Font Size</label>
            <input type="range" id="font-size-slider" min="30" max="100" value="60">
        </div>
        
        <div class="control-group">
            <label>Adjust Line Height</label>
            <input type="range" id="line-height-slider" min="1.0" max="2.0" value="1.3" step="0.1">
        </div>

        @if(count($frames) > 1)
        <div class="control-group">
            <label>Change Frame</label>
            <div class="frame-selector" style="display: flex; flex-wrap: wrap;">
                @foreach($frames as $index => $frameUrl)
                    <img src="{{ $frameUrl }}" 
                         class="frame-thumb" 
                         onclick="changeFrame('{{ $frameUrl }}', this)" 
                         style="width: 50px; height: 50px; margin: 5px; cursor: pointer; object-fit: cover; border: 2px solid {{ $index == 0 ? '#0e61d4' : '#ddd' }}; border-radius: 4px;">
                @endforeach
            </div>
            
            <script>
                function changeFrame(url, element) {
                    // 1. Change the Main Frame Image
                    document.getElementById('photocard-base-frame').src = url;

                    // 2. Visual Feedback: Reset border for all thumbnails
                    const thumbs = document.querySelectorAll('.frame-thumb');
                    thumbs.forEach(thumb => {
                        thumb.style.border = '2px solid #ddd';
                    });

                    // 3. Set Blue Border for the clicked thumbnail
                    element.style.border = '2px solid #0e61d4';
                }
            </script>
        </div>
        @endif

        <div class="control-buttons">
            <button id="upg-photocard-back">Close</button>
            <button id="upg-photocard-download">Download</button>
        </div>
        <div class="developer-credit">Developed by <a href="https://jisan.technomenia.com" target="_blank">Jisan Sheikh</a></div>
    </div>
</div>