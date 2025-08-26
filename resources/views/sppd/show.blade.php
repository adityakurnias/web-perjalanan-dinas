<!-- resources/views/sppd/show.blade.php -->
@extends('layouts.app')

@section('title', 'Detail SPPD')

@section('content')
<div class="mdl-grid">
    <div class="mdl-cell mdl-cell--8-col mdl-cell--2-offset">
        <div class="mdl-card mdl-shadow--2dp card-wide">
            <div class="mdl-card__title">
                <h2 class="mdl-card__title-text">Detail SPPD</h2>
            </div>
            <div class="mdl-card__supporting-text">
                <div class="mdl-grid">
                    <div class="mdl-cell mdl-cell--6-col">
                        <strong>Pegawai:</strong> {{ $sppd->user->name }}
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <strong>NIK:</strong> {{ $sppd->user->nik }}
                    </div>
                    
                    <div class="mdl-cell mdl-cell--6-col">
                        <strong>Tujuan:</strong> {{ $sppd->tujuan }}
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <strong>Status:</strong>
                        <span class="status-{{ $sppd->status }}">
                            @if($sppd->status == 'approved')
                                Disetujui
                            @elseif($sppd->status == 'rejected')
                                Ditolak
                            @else
                                Menunggu
                            @endif
                        </span>
                    </div>
                    
                    <div class="mdl-cell mdl-cell--6-col">
                        <strong>Tanggal Berangkat:</strong> {{ $sppd->tanggal_berangkat->format('d/m/Y') }}
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <strong>Tanggal Kembali:</strong> {{ $sppd->tanggal_kembali->format('d/m/Y') }}
                    </div>
                    
                    <div class="mdl-cell mdl-cell--12-col">
                        <strong>Keperluan:</strong><br>
                        {{ $sppd->keperluan }}
                    </div>
                    
                    @if($sppd->status == 'rejected' && $sppd->catatan_admin)
                    <div class="mdl-cell mdl-cell--12-col">
                        <strong>Catatan Admin:</strong><br>
                        {{ $sppd->catatan_admin }}
                    </div>
                    @endif
                </div>
                
                @if(auth()->user()->role === 'admin' && $sppd->status === 'pending')
                <div style="margin-top: 20px; padding-top: 20px; border-top: 1px solid #eee;">
                    <h4>Persetujuan Admin</h4>
                    
                    <form action="{{ route('sppd.approve', $sppd->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" style="background-color: #4CAF50;">
                            Setujui
                        </button>
                    </form>
                    
                    <button id="reject-btn" class="mdl-button mdl-js-button mdl-button--raised" style="background-color: #F44336; color: white;">
                        Tolak
                    </button>
                    
                    <form id="reject-form" action="{{ route('sppd.reject', $sppd->id) }}" method="POST" style="display: none;">
                        @csrf
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width: 100%; margin-top: 15px;">
                            <textarea class="mdl-textfield__input" type="text" id="catatan_admin" name="catatan_admin" rows="3" required></textarea>
                            <label class="mdl-textfield__label" for="catatan_admin">Alasan Penolakan</label>
                        </div>
                        <button type="submit" class="mdl-button mdl-js-button mdl-button--raised" style="background-color: #F44336; color: white;">
                            Submit Penolakan
                        </button>
                    </form>
                </div>
                @endif
                
                @if($sppd->status === 'approved' && !$sppd->laporan && auth()->user()->id === $sppd->user_id)
                <div style="margin-top: 20px; padding-top: 20px; border-top: 1px solid #eee;">
                    <a href="{{ route('laporan.create') }}?sppd_id={{ $sppd->id }}" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                        Buat Laporan Perjalanan
                    </a>
                </div>
                @endif
                
                @if($sppd->laporan)
                <div style="margin-top: 20px; padding-top: 20px; border-top: 1px solid #eee;">
                    <h4>Laporan Perjalanan</h4>
                    <p><strong>Status:</strong> Laporan telah dibuat</p>
                    <a href="{{ route('laporan.show', $sppd->laporan->id) }}" class="mdl-button mdl-js-button mdl-button--primary">
                        Lihat Laporan
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@if(auth()->user()->role === 'admin' && $sppd->status === 'pending')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const rejectBtn = document.getElementById('reject-btn');
        const rejectForm = document.getElementById('reject-form');
        
        rejectBtn.addEventListener('click', function() {
            if (rejectForm.style.display === 'none') {
                rejectForm.style.display = 'block';
            } else {
                rejectForm.style.display = 'none';
            }
        });
    });
</script>
@endif
@endsection