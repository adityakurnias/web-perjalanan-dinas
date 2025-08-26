<!-- resources/views/laporan/show.blade.php -->
@extends('layouts.app')

@section('title', 'Detail Laporan')

@section('content')
<div class="mdl-grid">
    <div class="mdl-cell mdl-cell--10-col mdl-cell--1-offset">
        <div class="mdl-card mdl-shadow--2dp card-wide">
            <div class="mdl-card__title">
                <h2 class="mdl-card__title-text">Detail Laporan Perjalanan</h2>
            </div>
            <div class="mdl-card__supporting-text">
                <div class="mdl-grid">
                    <div class="mdl-cell mdl-cell--6-col">
                        <strong>Pegawai:</strong> {{ $laporan->sppd->user->name }}
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <strong>NIK:</strong> {{ $laporan->sppd->user->nik }}
                    </div>
                    
                    <div class="mdl-cell mdl-cell--6-col">
                        <strong>Tujuan:</strong> {{ $laporan->sppd->tujuan }}
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <strong>Periode:</strong> 
                        {{ $laporan->sppd->tanggal_berangkat->format('d/m/Y') }} - 
                        {{ $laporan->sppd->tanggal_kembali->format('d/m/Y') }}
                    </div>
                    
                    <div class="mdl-cell mdl-cell--12-col">
                        <strong>Kegiatan:</strong><br>
                        {{ $laporan->kegiatan }}
                    </div>
                    
                    <div class="mdl-cell mdl-cell--12-col">
                        <strong>Hasil:</strong><br>
                        {{ $laporan->hasil }}
                    </div>
                    
                    <div class="mdl-cell mdl-cell--12-col">
                        <strong>Total Biaya:</strong> Rp {{ number_format($laporan->total_biaya, 0, ',', '.') }}
                    </div>
                </div>
                
                <h4>Detail Biaya</h4>
                <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="width: 100%;">
                    <thead>
                        <tr>
                            <th class="mdl-data-table__cell--non-numeric">Jenis Biaya</th>
                            <th class="mdl-data-table__cell--non-numeric">Jumlah</th>
                            <th class="mdl-data-table__cell--non-numeric">Keterangan</th>
                            <th class="mdl-data-table__cell--non-numeric">Status</th>
                            @if(auth()->user()->role === 'admin')
                            <th class="mdl-data-table__cell--non-numeric">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($laporan->biayas as $biaya)
                        <tr>
                            <td class="mdl-data-table__cell--non-numeric">{{ $biaya->jenis_biaya }}</td>
                            <td class="mdl-data-table__cell--non-numeric">Rp {{ number_format($biaya->jumlah, 0, ',', '.') }}</td>
                            <td class="mdl-data-table__cell--non-numeric">{{ $biaya->keterangan ?? '-' }}</td>
                            <td class="mdl-data-table__cell--non-numeric">
                                <span class="status-{{ $biaya->status }}">
                                    @if($biaya->status == 'approved')
                                        Disetujui
                                    @elseif($biaya->status == 'rejected')
                                        Ditolak
                                    @else
                                        Menunggu
                                    @endif
                                </span>
                            </td>
                            @if(auth()->user()->role === 'admin')
                            <td class="mdl-data-table__cell--non-numeric">
                                @if($biaya->status === 'pending')
                                <form action="{{ route('biaya.approve', $biaya->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="mdl-button mdl-js-button mdl-button--icon">
                                        <i class="material-icons" style="color: #4CAF50;">check_circle</i>
                                    </button>
                                </form>
                                
                                <button class="mdl-button mdl-js-button mdl-button--icon reject-btn" data-biaya-id="{{ $biaya->id }}">
                                    <i class="material-icons" style="color: #F44336;">cancel</i>
                                </button>
                                
                                <form id="reject-form-{{ $biaya->id }}" action="{{ route('biaya.reject', $biaya->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                        <textarea class="mdl-textfield__input" name="keterangan" rows="2" required></textarea>
                                        <label class="mdl-textfield__label">Alasan Penolakan</label>
                                    </div>
                                    <button type="submit" class="mdl-button mdl-js-button mdl-button--raised" style="background-color: #F44336; color: white;">
                                        Submit Penolakan
                                    </button>
                                </form>
                                @endif
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <div style="margin-top: 20px;">
                    <a href="{{ route('laporan.export', $laporan->id) }}" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                        <i class="material-icons">picture_as_pdf</i> Export PDF
                    </a>
                    
                    @if(auth()->user()->role === 'admin' || auth()->user()->id === $laporan->sppd->user_id)
                    <a href="{{ route('laporan.edit', $laporan->id) }}" class="mdl-button mdl-js-button mdl-button--raised">
                        <i class="material-icons">edit</i> Edit
                    </a>
                    @endif
                    
                    <a href="{{ route('laporan.index') }}" class="mdl-button mdl-js-button">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@if(auth()->user()->role === 'admin')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const rejectButtons = document.querySelectorAll('.reject-btn');
        
        rejectButtons.forEach(button => {
            button.addEventListener('click', function() {
                const biayaId = this.getAttribute('data-biaya-id');
                const rejectForm = document.getElementById('reject-form-' + biayaId);
                
                if (rejectForm.style.display === 'none') {
                    rejectForm.style.display = 'block';
                } else {
                    rejectForm.style.display = 'none';
                }
            });
        });
    });
</script>
@endif
@endsection