<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan Desa</title>
    @include('layouts.guest.css')

</head>

<body>
    {{-- start header --}}
    @include('layouts.guest.header')
    {{-- end header --}}

    {{-- start content --}}
    @yield('content')
    {{-- end content --}}

    {{-- start footer --}}
    @include('layouts.guest.footer')
    {{-- end footer --}}

    {{-- start js --}}
    @include('layouts.guest.js')
    {{-- end js --}}

    <!-- add your custom CSS -->
<style>
body {
 font-family: sans-serif;
}

/* Add WA floating button CSS */
.floating {
 position: fixed;
 width: 60px;
 height: 60px;
 bottom: 40px;
 right: 40px;
 background-color: #25d366;
 color: #fff;
 border-radius: 50px;
 text-align: center;
 font-size: 30px;
 box-shadow: 2px 2px 3px #999;
 z-index: 100;
}
.fab-icon {
 margin-top: 16px;
}
</style>
<a href="https://wa.me/6281209874568?text=Hi%20Layanan Surat" class="floating" target="_blank">
<i class="fab fa-whatsapp fab-icon"></i>
</a>
</body>

{{-- Tambahkan di bagian bawah file resources/views/layouts/guest/css.blade.php --}}

<style>
    /* =========================================
       1. GLOBAL PAGE HEADER (Gradient)
       ========================================= */
    .page-header {
        background: linear-gradient(135deg, #0d6efd 0%, #0099ff 100%);
        padding: 5rem 0 3rem 0;
        border-radius: 0 0 50px 50px;
        box-shadow: 0 10px 30px rgba(13, 110, 253, 0.15);
        margin-bottom: 0;
        position: relative;
        z-index: 1;
    }

    /* =========================================
       2. CARDS & WIDGETS (Index Page)
       ========================================= */
    /* Statistik Card */
    .stats-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: pointer;
        border: none;
        border-radius: 15px;
    }
    .stats-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15) !important;
    }
    .stats-number {
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 0.5rem;
    }

    /* Item Card (Warga, User, Berkas, dll) */
    .widget-card, .user-card, .jenis-surat-card, .permohonan-card {
        transition: all 0.3s ease;
        border: none;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }
    .widget-card:hover, .user-card:hover, .jenis-surat-card:hover, .permohonan-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }
    .card-header {
        border-radius: 15px 15px 0 0 !important;
        padding: 1rem 1.25rem;
    }

    /* Empty State Card */
    .empty-state-card {
        border: 2px dashed #dee2e6;
        border-radius: 15px;
        transition: all 0.3s ease;
    }
    .empty-state-card:hover {
        border-color: var(--bs-primary);
        transform: translateY(-3px);
    }

    /* =========================================
       3. FORM STYLING (Create & Edit Page)
       ========================================= */
    /* Form Card Container */
    .form-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        margin-top: -50px; /* Efek overlap dengan header */
        background: white;
    }

    /* Header Form (Gradient) */
    .form-header {
        background: linear-gradient(135deg, var(--bs-primary), #4a6bdf);
        color: white;
        padding: 2.5rem 2rem;
        position: relative;
        overflow: hidden;
    }
    .form-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 100%;
        height: 200%;
        background: rgba(255,255,255,0.1);
        transform: rotate(30deg);
    }

    .form-icon-wrapper { margin-bottom: 1rem; }
    .form-main-icon {
        font-size: 3rem;
        background: rgba(255,255,255,0.2);
        padding: 1rem;
        border-radius: 50%;
        margin-bottom: 1rem;
    }

    .form-body { padding: 2.5rem 2rem; }

    /* Input Fields & Effects */
    .input-group-icon { position: relative; }

    .form-icon {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--bs-primary);
        transition: all 0.3s ease;
        pointer-events: none;
        z-index: 5;
    }

    /* Focus Effect pada Input (Index Search & Form Input) */
    .input-focus-effect {
        border: 2px solid #e9ecef;
        border-radius: 10px;
        padding: 12px 15px; /* Default padding */
        transition: all 0.3s ease;
    }
    /* Khusus untuk form create/edit agar teks tidak menabrak icon di kanan */
    .input-group-icon .input-focus-effect {
        padding-right: 40px;
    }

    .input-focus-effect:focus {
        border-color: var(--bs-primary);
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25); /* var(--bs-primary-rgb) */
        transform: translateY(-2px);
    }

    .input-focus-effect:focus + .form-icon {
        color: var(--bs-primary);
        transform: translateY(-50%) scale(1.1);
    }

    /* Label Styling */
    .form-label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
    }

    /* Search Container (Index) */
    .search-container {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }
    .search-container:focus-within {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
    }

    /* =========================================
       4. BUTTONS & ACTIONS
       ========================================= */
    /* Tombol Tambah Mengambang */
    .floating-action-btn {
        transition: all 0.3s ease;
        border-radius: 10px;
        padding: 10px 20px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    .floating-action-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    /* Tombol Submit & Back (Form) */
    .btn-submit {
        border-radius: 10px;
        padding: 10px 25px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }

    .btn-back {
        border-radius: 10px;
        padding: 10px 20px;
        transition: all 0.3s ease;
        border: 2px solid #6c757d;
    }
    .btn-back:hover {
        background-color: #6c757d;
        color: white;
        transform: translateX(-5px);
    }

    /* Action Buttons (Edit/Delete/View) */
    .action-btn, .filter-btn {
        transition: all 0.3s ease;
        border-radius: 8px;
    }
    .action-btn:hover {
        background-color: rgba(255, 255, 255, 0.2) !important;
        transform: scale(1.1);
    }

    /* Footer Links (Card) */
    .contact-link, .detail-link, .edit-link, .delete-footer-btn {
        transition: all 0.3s ease;
        padding: 0.5rem;
        border-radius: 8px;
        text-decoration: none;
        display: block;
    }
    .contact-link:hover, .detail-link:hover, .edit-link:hover {
        background-color: rgba(0, 0, 0, 0.05);
        transform: scale(1.1);
    }
    .delete-footer-btn:hover {
        background-color: rgba(220, 53, 69, 0.1);
        transform: scale(1.1);
    }

    /* =========================================
       5. BADGES & AVATARS
       ========================================= */
    .status-badge, .gender-badge, .role-badge, .kode-badge {
        transition: all 0.3s ease;
        font-size: 0.75rem;
        padding: 0.35em 0.65em;
        border-radius: 50rem;
    }
    .widget-card:hover .status-badge, .widget-card:hover .gender-badge {
        transform: scale(1.1);
    }

    /* User Avatar */
    .user-avatar {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, var(--bs-warning), var(--bs-orange));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        color: white;
        font-size: 1.2rem;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
    }
    .user-card:hover .user-avatar {
        transform: scale(1.1);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }

    /* =========================================
       6. UTILITIES (Alert, Modal, Animation)
       ========================================= */
    /* Alert */
    .alert {
        border: none;
        border-radius: 10px;
        border-left: 4px solid;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
    }
    .alert-success { border-left-color: var(--bs-success); }
    .alert-danger { border-left-color: var(--bs-danger); }

    /* Modal */
    .modal-content {
        border: none;
        border-radius: 15px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
    }
    .modal-header {
        border-radius: 15px 15px 0 0;
        background: linear-gradient(135deg, var(--bs-danger), #dc3545);
        color: white;
    }

    /* Counter Animation */
    .counter { transition: all 0.5s ease; }

    /* Pagination */
    .pagination .page-link {
        border-radius: 8px;
        margin: 0 2px;
        border: none;
        color: var(--bs-primary);
    }
    .pagination .page-item.active .page-link {
        background-color: var(--bs-primary);
        border-color: var(--bs-primary);
    }
    .pagination .page-link:hover { background-color: #e9ecef; }

    /* File Chip (Link File) */
    .file-chip { transition: all 0.2s ease; }
    .file-chip:hover {
        transform: translateY(-2px);
        box-shadow: 0 3px 8px rgba(0,0,0,0.1) !important;
        background-color: #f8f9fa;
        border-color: var(--bs-primary) !important;
    }
</style>
