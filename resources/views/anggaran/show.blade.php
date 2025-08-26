<!-- resources/views/anggaran/show.blade.php -->
@extends('layouts.app')

@section('title', 'Detail Anggaran')

@section('content')
<div class="mdl-grid">
    <div class="mdl-cell mdl-cell--6-col mdl-cell--3-offset">
        <div class="mdl-card mdl-shadow--2dp card-wide">
            <div class="mdl-card__title">
                <h2 class="mdl-card__title-text">Detail Anggaran</h2>
            </div>
            <div class="mdl-card__supporting-text">
                <div class="mdl-grid">
                    <div class="mdl-cell mdl-cell--6-col">
                        <strong>Tahun:</strong> {{ $anggaran->tahun }}
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <strong>Bulan:</strong>
                        @php
                            $months = [
                                1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                                5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                                9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                            ];
                        @endphp
                        {{ $months[$anggaran->bulan] }}
                    </div>
                    
                    <div class="mdl-cell mdl-cell--6-col">
                        <strong>Jumlah Anggaran:</strong><br>
                        Rp {{ number_format($anggaran->jumlah, 0, ',', '.') }}
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <strong>Terpakai:</strong><br>
                        Rp {{ number_format($anggaran->terpakai, 0, ',', '.') }}
                    </div>
                    
                    <div class="mdl-cell mdl-cell--12-col">
                        <strong>Sisa Anggaran:</strong><br>
                        <span style="font-size: 18px; font-weight: bold; color: {{ $anggaran->sisa < 0 ? '#F44336' : '#4CAF50' }};">
                            Rp {{ number_format($anggaran->sisa, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
                
                <div style="margin-top: 20px;">
                    <a href="{{ route('anggaran.edit', $anggaran->id) }}" class="mdl-button mdl-js-button mdl-button--raised">
                        <i class="material-icons">edit</i> Edit
                    </a>
                    
                    <a href="{{ route('anggaran.index') }}" class="mdl-button mdl-js-button">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection