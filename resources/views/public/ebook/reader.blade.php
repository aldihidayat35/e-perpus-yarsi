<!DOCTYPE html>
<html lang="id" data-bs-theme="light">
<head>
    <base href="{{ url('/') }}/"/>
    <title>{{ $book->title }} - Pembaca E-Book</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <link rel="shortcut icon" href="{{ app_setting('favicon') ? asset('storage/' . app_setting('favicon')) : asset('assets/media/logos/favicon.ico') }}"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700"/>
    <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css"/>
    <style>
        * { -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none; }
        body { margin: 0; overflow: hidden; background: #1a1a2e; }

        .reader-toolbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 56px;
            background: rgba(30, 30, 46, 0.95);
            backdrop-filter: blur(10px);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            z-index: 1000;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }
        .reader-toolbar .book-title {
            color: #fff;
            font-size: 14px;
            font-weight: 600;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            max-width: 300px;
        }
        .reader-toolbar .book-author {
            color: rgba(255,255,255,0.5);
            font-size: 12px;
        }
        .toolbar-controls {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .toolbar-btn {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            border: 1px solid rgba(255,255,255,0.1);
            background: rgba(255,255,255,0.05);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
            font-size: 16px;
        }
        .toolbar-btn:hover {
            background: rgba(255,255,255,0.15);
            border-color: rgba(255,255,255,0.2);
        }
        .toolbar-btn:active { transform: scale(0.95); }
        .toolbar-btn.active { background: #3699ff; border-color: #3699ff; }

        .page-indicator {
            color: rgba(255,255,255,0.7);
            font-size: 13px;
            font-weight: 500;
            padding: 6px 14px;
            background: rgba(255,255,255,0.08);
            border-radius: 6px;
            min-width: 100px;
            text-align: center;
        }
        .page-input {
            width: 50px;
            text-align: center;
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 4px;
            color: #fff;
            font-size: 13px;
            padding: 4px;
            outline: none;
        }
        .page-input:focus { border-color: #3699ff; }

        .reader-container {
            position: fixed;
            top: 56px;
            left: 0;
            right: 0;
            bottom: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: auto;
            background: #16213e;
        }

        #pdf-canvas {
            max-width: 100%;
            max-height: 100%;
            box-shadow: 0 8px 40px rgba(0,0,0,0.5);
            background: #fff;
        }

        .nav-btn {
            position: fixed;
            top: 50%;
            transform: translateY(-50%);
            width: 48px;
            height: 80px;
            background: rgba(0,0,0,0.4);
            border: none;
            color: #fff;
            font-size: 24px;
            cursor: pointer;
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
            border-radius: 0;
        }
        .nav-btn:hover { background: rgba(54,153,255,0.6); }
        .nav-btn.prev { left: 0; border-radius: 0 8px 8px 0; }
        .nav-btn.next { right: 0; border-radius: 8px 0 0 8px; }
        .nav-btn:disabled { opacity: 0.3; cursor: not-allowed; }

        .loading-overlay {
            position: fixed;
            top: 56px;
            left: 0;
            right: 0;
            bottom: 0;
            background: #16213e;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 500;
            color: #fff;
        }
        .loading-overlay .spinner-border { width: 3rem; height: 3rem; }

        .zoom-display {
            color: rgba(255,255,255,0.6);
            font-size: 12px;
            min-width: 45px;
            text-align: center;
        }

        @media (max-width: 768px) {
            .reader-toolbar { padding: 0 10px; }
            .reader-toolbar .book-title { max-width: 150px; font-size: 12px; }
            .toolbar-btn { width: 32px; height: 32px; font-size: 14px; }
            .nav-btn { width: 36px; height: 60px; font-size: 18px; }
            .hide-mobile { display: none !important; }
        }
    </style>
</head>
<body>
    <!--begin::Toolbar-->
    <div class="reader-toolbar">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('catalog.show', $book) }}" class="toolbar-btn" title="Kembali">
                <i class="ki-duotone ki-arrow-left"><span class="path1"></span><span class="path2"></span></i>
            </a>
            <div class="hide-mobile">
                <div class="book-title">{{ $book->title }}</div>
                <div class="book-author">{{ $book->author }}</div>
            </div>
        </div>

        <div class="toolbar-controls">
            <button class="toolbar-btn" id="btn-zoom-out" title="Perkecil">
                <i class="ki-duotone ki-minus"><span class="path1"></span><span class="path2"></span></i>
            </button>
            <span class="zoom-display" id="zoom-level">100%</span>
            <button class="toolbar-btn" id="btn-zoom-in" title="Perbesar">
                <i class="ki-duotone ki-plus"><span class="path1"></span><span class="path2"></span></i>
            </button>

            <div class="page-indicator">
                <input type="number" id="page-input" class="page-input" value="1" min="1"/> /
                <span id="total-pages">-</span>
            </div>

            <button class="toolbar-btn" id="btn-fullscreen" title="Layar Penuh">
                <i class="ki-duotone ki-maximize fs-4"><span class="path1"></span><span class="path2"></span></i>
            </button>
        </div>
    </div>
    <!--end::Toolbar-->

    <!--begin::Loading-->
    <div class="loading-overlay" id="loading">
        <div class="spinner-border text-primary mb-4" role="status"></div>
        <p>Memuat e-book...</p>
    </div>
    <!--end::Loading-->

    <!--begin::Navigation Buttons-->
    <button class="nav-btn prev" id="btn-prev" title="Halaman Sebelumnya" disabled>
        <i class="ki-duotone ki-left"><span class="path1"></span><span class="path2"></span></i>
    </button>
    <button class="nav-btn next" id="btn-next" title="Halaman Berikutnya">
        <i class="ki-duotone ki-right"><span class="path1"></span><span class="path2"></span></i>
    </button>
    <!--end::Navigation Buttons-->

    <!--begin::Reader Container-->
    <div class="reader-container" id="reader-container">
        <canvas id="pdf-canvas"></canvas>
    </div>
    <!--end::Reader Container-->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
    <script>
        // Security: Disable right-click
        document.addEventListener('contextmenu', e => e.preventDefault());

        // Security: Disable keyboard shortcuts for print/save
        document.addEventListener('keydown', e => {
            if ((e.ctrlKey || e.metaKey) && ['p', 's', 'P', 'S'].includes(e.key)) {
                e.preventDefault();
                return false;
            }
            // Disable F12
            if (e.key === 'F12') {
                e.preventDefault();
                return false;
            }
        });

        // Security: Disable drag
        document.addEventListener('dragstart', e => e.preventDefault());

        // PDF.js Configuration
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

        const STREAM_URL = "{{ route('ebook.stream', $book) }}";
        const canvas = document.getElementById('pdf-canvas');
        const ctx = canvas.getContext('2d');
        const container = document.getElementById('reader-container');

        let pdfDoc = null;
        let currentPage = 1;
        let totalPages = 0;
        let scale = 1.0;
        let rendering = false;

        // Load PDF
        async function loadPDF() {
            try {
                pdfDoc = await pdfjsLib.getDocument({
                    url: STREAM_URL,
                    disableAutoFetch: false,
                    disableStream: false,
                }).promise;

                totalPages = pdfDoc.numPages;
                document.getElementById('total-pages').textContent = totalPages;
                document.getElementById('page-input').max = totalPages;
                document.getElementById('loading').style.display = 'none';

                // Auto-fit first page
                await autoFitPage();
                renderPage(currentPage);
            } catch (error) {
                document.getElementById('loading').innerHTML =
                    '<div class="text-danger mb-3"><i class="ki-duotone ki-cross-circle fs-5x"><span class="path1"></span><span class="path2"></span></i></div>' +
                    '<p class="text-white">Gagal memuat e-book.</p>' +
                    '<a href="{{ route("catalog.show", $book) }}" class="btn btn-sm btn-primary mt-3">Kembali</a>';
            }
        }

        async function autoFitPage() {
            const page = await pdfDoc.getPage(1);
            const viewport = page.getViewport({ scale: 1.0 });
            const containerHeight = container.clientHeight - 40;
            const containerWidth = container.clientWidth - 40;
            const scaleH = containerHeight / viewport.height;
            const scaleW = containerWidth / viewport.width;
            scale = Math.min(scaleH, scaleW, 2.0);
            updateZoomDisplay();
        }

        async function renderPage(num) {
            if (rendering) return;
            rendering = true;

            const page = await pdfDoc.getPage(num);
            const viewport = page.getViewport({ scale });

            canvas.height = viewport.height;
            canvas.width = viewport.width;

            await page.render({
                canvasContext: ctx,
                viewport: viewport,
            }).promise;

            rendering = false;
            currentPage = num;
            document.getElementById('page-input').value = num;

            // Update nav buttons
            document.getElementById('btn-prev').disabled = (num <= 1);
            document.getElementById('btn-next').disabled = (num >= totalPages);
        }

        function updateZoomDisplay() {
            document.getElementById('zoom-level').textContent = Math.round(scale * 100) + '%';
        }

        // Navigation
        document.getElementById('btn-prev').addEventListener('click', () => {
            if (currentPage > 1) renderPage(currentPage - 1);
        });

        document.getElementById('btn-next').addEventListener('click', () => {
            if (currentPage < totalPages) renderPage(currentPage + 1);
        });

        // Page input
        document.getElementById('page-input').addEventListener('change', function() {
            let num = parseInt(this.value);
            if (num >= 1 && num <= totalPages) {
                renderPage(num);
            } else {
                this.value = currentPage;
            }
        });

        // Zoom
        document.getElementById('btn-zoom-in').addEventListener('click', () => {
            if (scale < 3.0) {
                scale += 0.25;
                updateZoomDisplay();
                renderPage(currentPage);
            }
        });

        document.getElementById('btn-zoom-out').addEventListener('click', () => {
            if (scale > 0.5) {
                scale -= 0.25;
                updateZoomDisplay();
                renderPage(currentPage);
            }
        });

        // Fullscreen
        document.getElementById('btn-fullscreen').addEventListener('click', () => {
            if (!document.fullscreenElement) {
                document.documentElement.requestFullscreen().catch(() => {});
            } else {
                document.exitFullscreen().catch(() => {});
            }
        });

        // Keyboard navigation
        document.addEventListener('keydown', e => {
            if (e.target.tagName === 'INPUT') return;
            switch(e.key) {
                case 'ArrowLeft':
                case 'ArrowUp':
                    e.preventDefault();
                    if (currentPage > 1) renderPage(currentPage - 1);
                    break;
                case 'ArrowRight':
                case 'ArrowDown':
                case ' ':
                    e.preventDefault();
                    if (currentPage < totalPages) renderPage(currentPage + 1);
                    break;
                case '+':
                case '=':
                    document.getElementById('btn-zoom-in').click();
                    break;
                case '-':
                    document.getElementById('btn-zoom-out').click();
                    break;
                case 'f':
                case 'F':
                    document.getElementById('btn-fullscreen').click();
                    break;
            }
        });

        // Touch swipe support
        let touchStartX = 0;
        container.addEventListener('touchstart', e => {
            touchStartX = e.changedTouches[0].screenX;
        }, { passive: true });

        container.addEventListener('touchend', e => {
            const diff = touchStartX - e.changedTouches[0].screenX;
            if (Math.abs(diff) > 50) {
                if (diff > 0 && currentPage < totalPages) {
                    renderPage(currentPage + 1);
                } else if (diff < 0 && currentPage > 1) {
                    renderPage(currentPage - 1);
                }
            }
        }, { passive: true });

        // Mouse wheel zoom
        container.addEventListener('wheel', e => {
            if (e.ctrlKey) {
                e.preventDefault();
                if (e.deltaY < 0 && scale < 3.0) {
                    scale += 0.1;
                } else if (e.deltaY > 0 && scale > 0.5) {
                    scale -= 0.1;
                }
                updateZoomDisplay();
                renderPage(currentPage);
            }
        }, { passive: false });

        // Window resize
        let resizeTimeout;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(() => {
                if (pdfDoc) renderPage(currentPage);
            }, 250);
        });

        // Security: Disable print via CSS
        const style = document.createElement('style');
        style.textContent = '@media print { body { display: none !important; } }';
        document.head.appendChild(style);

        // Init
        loadPDF();
    </script>
</body>
</html>
