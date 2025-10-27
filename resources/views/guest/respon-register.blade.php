<!-- Tambahkan bagian ini di dalam card body setelah data-item yang sudah ada -->

@if(isset($user))
<div class="data-item">
    <span class="data-label">
        <i class="fas fa-id-card me-2"></i>ID User:
    </span>
    <span class="data-value">{{ $user->id }}</span>
</div>

<div class="data-item">
    <span class="data-label">
        <i class="fas fa-signature me-2"></i>Nama User:
    </span>
    <span class="data-value">{{ $user->name }}</span>
</div>

<div class="data-item">
    <span class="data-label">
        <i class="fas fa-calendar me-2"></i>Tanggal Dibuat:
    </span>
    <span class="data-value">{{ $user->created_at->format('d M Y H:i:s') }}</span>
</div>
@endif

@if(isset($action))
<div class="data-item">
    <span class="data-label">
        <i class="fas fa-action me-2"></i>Aksi:
    </span>
    <span class="data-value">
        @if($action == 'register')
            <span class="badge bg-success">Registrasi Baru</span>
        @elseif($action == 'auto_register')
            <span class="badge bg-info">Registrasi Otomatis</span>
        @elseif($action == 'login')
            <span class="badge bg-primary">Login</span>
        @endif

        @if(isset($login_success))
            @if($login_success)
                <span class="badge bg-success ms-2">Berhasil</span>
            @else
                <span class="badge bg-danger ms-2">Gagal</span>
            @endif
        @endif
    </span>
</div>
@endif

@if(isset($error))
<div class="alert alert-warning">
    <i class="fas fa-exclamation-triangle me-2"></i>
    {{ $error }}
</div>
@endif
