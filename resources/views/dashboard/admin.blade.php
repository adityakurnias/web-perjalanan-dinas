<!-- resources/views/dashboard/admin.blade.php -->
@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="dashboard-stats">
    <div class="stat-card">
        <div class="stat-label">Pengguna Menunggu</div>
        <div class="stat-number">{{ $pendingUsers }}</div>
        <a href="{{ route('pegawai.index') }}">Lihat Detail</a>
    </div>
    
    <div class="stat-card">
        <div class="stat-label">SPPD Menunggu</div>
        <div class="stat-number">{{ $pendingSPPDs }}</div>
        <a href="{{ route('sppd.index') }}">Lihat Detail</a>
    </div>
    
    <div class="stat-card">
        <div class="stat-label">Total SPPD</div>
        <div class="stat-number">{{ $totalSPPDs }}</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-label">Total Anggaran</div>
        <div class="stat-number">Rp {{ number_format($totalAnggaran, 0, ',', '.') }}</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-label">Anggaran Terpakai</div>
        <div class="stat-number">Rp {{ number_format($terpakaiAnggaran, 0, ',', '.') }}</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-label">Sisa Anggaran</div>
        <div class="stat-number">Rp {{ number_format($totalAnggaran - $terpakaiAnggaran, 0, ',', '.') }}</div>
    </div>
</div>

<h3>Menu Admin</h3>
<div class="mdl-grid">
    <div class="mdl-cell mdl-cell--4-col">
        <div class="mdl-card mdl-shadow--2dp card-wide">
            <div class="mdl-card__title" style="background: #3f51b5;">
                <h2 class="mdl-card__title-text" style="color: white;">Kelola Pegawai</h2>
            </div>
            <div class="mdl-card__supporting-text">
                Kelola data pegawai dan persetujuan akun.
            </div>
            <div class="mdl-card__actions mdl-card--border">
                <a href="{{ route('pegawai.index') }}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                    Buka
                </a>
            </div>
        </div>
    </div>
    
    <div class="mdl-cell mdl-cell--4-col">
        <div class="mdl-card mdl-shadow--2dp card-wide">
            <div class="mdl-card__title" style="background: #3f51b5;">
                <h2 class="mdl-card__title-text" style="color: white;">Kelola SPPD</h2>
            </div>
            <div class="mdl-card__supporting-text">
                Kelola pengajuan dan persetujuan SPPD.
            </div>
            <div class="mdl-card__actions mdl-card--border">
                <a href="{{ route('sppd.index') }}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                    Buka
                </a>
            </div>
        </div>
    </div>
    
    <div class="mdl-cell mdl-cell--4-col">
        <div class="mdl-card mdl-shadow--2dp card-wide">
            <div class="mdl-card__title" style="background: #3f51b5;">
                <h2 class="mdl-card__title-text" style="color: white;">Kelola Biaya</h2>
            </div>
            <div class="mdl-card__supporting-text">
                Kelola pengajuan dan persetujuan biaya perjalanan.
            </div>
            <div class="mdl-card__actions mdl-card--border">
                <a href="{{ route('biaya.index') }}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                    Buka
                </a>
            </div>
        </div>
    </div>
    
    <div class="mdl-cell mdl-cell--4-col">
        <div class="mdl-card mdl-shadow--2dp card-wide">
            <div class="mdl-card__title" style="background: #3f51b5;">
                <h2 class="mdl-card__title-text" style="color: white;">Kelola Anggaran</h2>
            </div>
            <div class="mdl-card__supporting-text">
                Kelola anggaran perjalanan dinas.
            </div>
            <div class="mdl-card__actions mdl-card--border">
                <a href="{{ route('anggaran.index') }}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                    Buka
                </a>
            </div>
        </div>
    </div>
</div>
@endsection