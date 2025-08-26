<!-- resources/views/biaya/show.blade.php -->
@extends('layouts.app')

@section('title', 'Detail Biaya')

@section('content')
<div class="mdl-grid">
    <div class="mdl-cell mdl-cell--8-col mdl-cell--2-offset">
        <div class="mdl-card mdl-shadow--2dp card-wide">
            <div class="mdl-card__title">
                <h2 class="mdl-card__title-text">Detail Pengajuan Biaya</h2>
            </div>
            <div class="mdl-card__supporting-text">
                <div class="mdl-grid">
                    <div class="mdl-cell mdl-cell--6-col">
                        <strong>Pegawai:</strong> {{ $biaya->laporan->sppd->user->name }}
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <strong>NIK:</strong> {{ $biaya->laporan->sppd->user->nik }}
                    </div>
                    
                    <div class="mdl-cell mdl-cell--6-col">
                        <strong>Tujuan Perjalanan:</strong> {{ $biaya->laporan->sppd->tujuan }}
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <strong>Periode:</strong> 
                        {{ $biaya->laporan->sppd->tanggal_berangkat->format('d/m/Y') }} - 
                        {{ $biaya->laporan->sppd->tanggal_kembali->format('d/m/Y') }}
                    </div>
                    
                    <div class="mdl-cell mdl-cell--6-col">
                        <strong>Jenis Biaya:</strong> {{ $biaya->jenis_biaya }}
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <strong>Jumlah:</strong> Rp {{ number_format($biaya->jumlah, 0, ',', '.') }}
                    </div>
                    
                    <div class="mdl-cell mdl-cell--12-col">
                        <strong>Keterangan:</strong><br>
                        {{ $biaya->keterangan ?? '-' }}
                    </div>
                    
                    <div class="mdl-cell mdl-cell--6-col">
                        <strong>Status:</strong>
                        <span class="status-{{ $biaya->status }}">
                            @if($biaya->status == 'approved')
                                Disetujui
                            @elseif($biaya->status == 'rejected')
                                Ditolak
                            @else
                                Menunggu
                            @endif
                        </span>
                    </div>
                </div>
                
                @if(auth()->user()->role === 'admin' && $biaya->status === 'pending')
                <div style="margin-top: 20px; padding-top: 20px; border-top: 1px solid #eee;">
                    <h4>Persetujuan Admin</h4>
                    
                    <form action="{{ route('biaya.approve', $biaya->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" style="background-color: #4CAF50;">
                            Setujui
                        </button>
                    </form>
                    
                    <button id="reject-btn" class="mdl-button mdl-js-button mdl-button--raised" style="background-color: #F44336; color: white;">
                        Tolak
                    </button>
                    
                    <form id="reject-form" action="{{ route('biaya.reject', $biaya->id) }}" method="POST" style="display: none;">
                        @csrf
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width: 100%; margin-top: 15px;">
                            <textarea class="mdl-textfield__input" type="text" name="keterangan" rows="3" required></textarea>
                            <label class="mdl-textfield__label">Alasan Penolakan</label>
                        </div>
                        <button type="submit" class="mdl-button mdl-js-button mdl-button--raised" style="background-color: #F44336; color: white;">
                            Submit Penolakan
                        </button>
                    </form>
                </div>
                @endif
                
                <div style="margin-top: 20px;">
                    <a href="{{ route('biaya.index') }}" class="mdl-button mdl-js-button">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@if(auth()->user()->role === 'admin' && $biaya->status === 'pending')
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