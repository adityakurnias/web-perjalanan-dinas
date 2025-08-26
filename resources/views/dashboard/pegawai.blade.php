<!-- resources/views/dashboard/pegawai.blade.php -->
@extends('layouts.app')

@section('title', 'Dashboard Pegawai')

@section('content')
<div class="dashboard-stats">
    <div class="stat-card">
        <div class="stat-label">Total SPPD</div>
        <div class="stat-number">{{ $totalSPPDs }}</div>
        <a href="{{ route('sppd.index') }}">Lihat Detail</a>
    </div>
    
    <div class="stat-card">
        <div class="stat-label">SPPD Disetujui</div>
        <div class="stat-number">{{ $approvedSPPDs }}</div>
    </div>
</div>

<h3>SPPD Terbaru</h3>
@if($sppds->count() > 0)
    <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="width: 100%;">
        <thead>
            <tr>
                <th class="mdl-data-table__cell--non-numeric">Tujuan</th>
                <th>Tanggal Berangkat</th>
                <th>Tanggal Kembali</th>
                <th class="mdl-data-table__cell--non-numeric">Status</th>
                <th class="mdl-data-table__cell--non-numeric">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sppds as $sppd)
            <tr>
                <td class="mdl-data-table__cell--non-numeric">{{ $sppd->tujuan }}</td>
                <td>{{ $sppd->tanggal_berangkat->format('d/m/Y') }}</td>
                <td>{{ $sppd->tanggal_kembali->format('d/m/Y') }}</td>
                <td class="mdl-data-table__cell--non-numeric">
                    <span class="status-{{ $sppd->status }}">
                        @if($sppd->status == 'approved')
                            Disetujui
                        @elseif($sppd->status == 'rejected')
                            Ditolak
                        @else
                            Menunggu
                        @endif
                    </span>
                </td>
                <td class="mdl-data-table__cell--non-numeric">
                    <a href="{{ route('sppd.show', $sppd->id) }}" class="mdl-button mdl-js-button mdl-button--icon">
                        <i class="material-icons">visibility</i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>Belum ada SPPD. <a href="{{ route('sppd.create') }}">Ajukan SPPD pertama Anda</a>.</p>
@endif

<h3>Menu Pegawai</h3>
<div class="mdl-grid">
    <div class="mdl-cell mdl-cell--4-col">
        <div class="mdl-card mdl-shadow--2dp card-wide">
            <div class="mdl-card__title" style="background: #3f51b5;">
                <h2 class="mdl-card__title-text" style="color: white;">Buat SPPD</h2>
            </div>
            <div class="mdl-card__supporting-text">
                Ajukan Surat Perintah Perjalanan Dinas.
            </div>
            <div class="mdl-card__actions mdl-card--border">
                <a href="{{ route('sppd.create') }}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                    Buka
                </a>
            </div>
        </div>
    </div>
    
    <div class="mdl-cell mdl-cell--4-col">
        <div class="mdl-card mdl-shadow--2dp card-wide">
            <div class="mdl-card__title" style="background: #3f51b5;">
                <h2 class="mdl-card__title-text" style="color: white;">Status SPPD</h2>
            </div>
            <div class="mdl-card__supporting-text">
                Lihat status pengajuan SPPD Anda.
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
                <h2 class="mdl-card__title-text" style="color: white;">Buat Laporan</h2>
            </div>
            <div class="mdl-card__supporting-text">
                Buat laporan perjalanan dinas.
            </div>
            <div class="mdl-card__actions mdl-card--border">
                <a href="{{ route('laporan.create') }}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                    Buka
                </a>
            </div>
        </div>
    </div>
</div>
@endsection