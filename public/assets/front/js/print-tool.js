jQuery(document).ready(function($) {

    // --- 1. Main "Print Post" Click ---
    $('body').on('click', '#upg-print-trigger', function() {
        const postId = $(this).data('postid');
        const url = $(this).data('url'); // We will pass the route in the button

        showLoader();

        $.ajax({
            url: url,
            type: 'GET',
            success: function(response) {
                $('#upg-modal-overlay').html(response);
            },
            error: function() {
                alert('Error loading print view.');
                $('#upg-modal-overlay').remove();
            }
        });
    });

    // --- 2. "Photocard" Click ---
    $('body').on('click', '#upg-photocard-trigger', function() {
        const postId = $(this).data('postid');
        const url = $(this).data('url'); 

        showLoader();

        $.ajax({
            url: url,
            type: 'GET',
            success: function(response) {
                $('#upg-modal-overlay').html(response).addClass('photocard-mode');
            },
            error: function() {
                alert('Error loading photocard.');
                $('#upg-modal-overlay').remove();
            }
        });
    });

    // Helper: Show SVG Loader
    function showLoader() {
        const loader_html = `
            <div id="upg-modal-overlay">
                <div class="upg-loader" style="color:#ea580c">
                   <svg width="50px" height="50px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                        <circle cx="50" cy="50" fill="none" stroke="currentColor" stroke-width="10" r="35" stroke-dasharray="164.93361431346415 56.97787143782138">
                          <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform>
                        </circle>
                    </svg>
                </div>
            </div>`;
        $('body').append(loader_html);
    }

    // --- 3. Save as JPG (Print Modal) ---
    $('body').on('click', '#upg-save-jpg', function() {
        const printArea = document.getElementById('upg-print-area');
        const title = $('.upg-title').text().trim() || 'post';

        html2canvas(printArea, { scale: 2 }).then(canvas => {
            downloadCanvas(canvas, title + '.jpg');
        });
    });

    // --- 4. Save as PDF ---
    $('body').on('click', '#upg-print-pdf', function() {
        const printArea = document.getElementById('upg-print-area');
        const title = $('.upg-title').text().trim() || 'post';
        const btn = $(this);
        
        btn.text('Generating PDF...').prop('disabled', true);

        html2canvas(printArea, { 
            scale: 2,
            useCORS: true,
            backgroundColor: '#ffffff'
        }).then(canvas => {
            const imgData = canvas.toDataURL('image/jpeg', 0.95);
            const imgWidth = 210; // A4 width in mm
            const pageHeight = 297; // A4 height in mm
            const imgHeight = (canvas.height * imgWidth) / canvas.width;
            
            const { jsPDF } = window.jspdf;
            const pdf = new jsPDF('p', 'mm', 'a4');
            
            let heightLeft = imgHeight;
            let position = 0;

            // Add first page
            pdf.addImage(imgData, 'JPEG', 0, position, imgWidth, imgHeight);
            heightLeft -= pageHeight;

            // Add additional pages if content is longer
            while (heightLeft > 0) {
                position = heightLeft - imgHeight;
                pdf.addPage();
                pdf.addImage(imgData, 'JPEG', 0, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;
            }

            pdf.save(title + '.pdf');
        }).finally(() => {
            btn.text('Print / PDF').prop('disabled', false);
        });
    });

    // --- 5. Close Modal ---
    $('body').on('click', '#upg-modal-overlay, #upg-photocard-back', function(e) {
        if (e.target.id === 'upg-modal-overlay' || e.target.id === 'upg-photocard-back') {
            $('#upg-modal-overlay').remove();
        }
    });

    // --- 6. Photocard Logic ---
    $('body').on('input', '#font-size-slider', function() {
        $('#photocard-headline-text').css('font-size', $(this).val() + 'px');
    });

    $('body').on('input', '#line-height-slider', function() {
        $('#photocard-headline-text').css('line-height', $(this).val());
    });

    $('body').on('click', '.frame-thumb', function() {
        var newFrameUrl = $(this).data('frame-url');
        $('#photocard-base-frame').attr('src', newFrameUrl);
        $('.frame-thumb').removeClass('active');
        $(this).addClass('active');
    });

    $('body').on('click', '#upg-photocard-download', function(e) {
        e.preventDefault();
        const btn = $(this);
        const area = document.getElementById('upg-photocard-preview');
        
        btn.text('Generating...').prop('disabled', true);

        html2canvas(area, { scale: 1, useCORS: true }).then(canvas => {
            downloadCanvas(canvas, 'photocard.jpg');
        }).finally(() => {
            btn.text('Download').prop('disabled', false);
        });
    });

    function downloadCanvas(canvas, filename) {
        const link = document.createElement('a');
        link.href = canvas.toDataURL('image/jpeg', 0.95);
        link.download = filename;
        link.click();
    }
});