<!-- resources/views/laporan/edit.blade.php -->
@extends('layouts.app')

@section('title', 'Edit Laporan')

@section('content')
<div class="mdl-grid">
    <div class="mdl-cell mdl-cell--10-col mdl-cell--1-offset">
        <div class="mdl-card mdl-shadow--2dp card-wide">
            <div class="mdl-card__title">
                <h2 class="mdl-card__title-text">Edit Laporan Perjalanan</h2>
            </div>
            <div class="mdl-card__supporting-text">
                <form method="POST" action="{{ route('laporan.update', $laporan->id) }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" value="{{ $laporan->sppd->tujuan }} ({{ $laporan->sppd->tanggal_berangkat->format('d/m/Y') }} - {{ $laporan->sppd->tanggal_kembali->format('d/m/Y') }})" disabled>
                        <label class="mdl-textfield__label">SPPD</label>
                    </div>
                    
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <textarea class="mdl-textfield__input" type="text" id="kegiatan" name="kegiatan" rows="3" required>{{ old('kegiatan', $laporan->kegiatan) }}</textarea>
                        <label class="mdl-textfield__label" for="kegiatan">Kegiatan yang Dilakukan</label>
                        @error('kegiatan')
                            <span class="mdl-textfield__error">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <textarea class="mdl-textfield__input" type="text" id="hasil" name="hasil" rows="3" required>{{ old('hasil', $laporan->hasil) }}</textarea>
                        <label class="mdl-textfield__label" for="hasil">Hasil yang Dicapai</label>
                        @error('hasil')
                            <span class="mdl-textfield__error">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                        Update Laporan
                    </button>
                    
                    <a href="{{ route('laporan.show', $laporan->id) }}" class="mdl-button mdl-js-button">
                        Batal
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection