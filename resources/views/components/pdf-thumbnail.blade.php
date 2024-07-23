@php
    $pdfFileUrl = $pdfUrl;
@endphp
<canvas id="pdf-canvas-{{ $attributes->get('id') }}" style="display: none;"></canvas>
<img id="thumbnail-{{ $attributes->get('id') }}" src="" alt="PDF Thumbnail"
    style="max-width: {{ $width }}; max-height: {{ $height }};">

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const url = '{{ $pdfFileUrl }}';
        const canvas = document.getElementById('pdf-canvas-{{ $attributes->get('id') }}');
        const img = document.getElementById('thumbnail-{{ $attributes->get('id') }}');

        pdfjsLib.getDocument(url).promise.then(pdf => {
            pdf.getPage(1).then(page => {
                const scale = 1.5; // Tỉ lệ phóng to
                const viewport = page.getViewport({ scale });

                const context = canvas.getContext('2d');
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                const renderContext = {
                    canvasContext: context,
                    viewport: viewport
                };
                page.render(renderContext).promise.then(() => {
                    img.src = canvas.toDataURL('image/jpeg');
                });
            });
        }).catch(error => {
            console.error('Error loading PDF:', error);
        });
    });
</script>
