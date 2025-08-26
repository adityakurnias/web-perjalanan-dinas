<!-- resources/views/sppd/edit.blade.php -->
@extends('layouts.app')

@section('title', 'Edit SPPD')

@section('content')
<div class="mdl-grid">
    <div class="mdl-cell mdl-cell--8-col mdl-cell--2-offset">
        <div class="mdl-card mdl-shadow--2dp card-wide">
            <div class="mdl-card__title">
                <h2 class="mdl-card__title-text">Edit SPPD</h2>
            </div>
            <div class="mdl-card__supporting-text">
                <form method="POST" action="{{ route('sppd.update', $sppd->id) }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" id="tujuan" name="tujuan" value="{{ old('tujuan', $sppd->tujuan) }}" required>
                        <label class="mdl-textfield__label" for="tujuan">Tujuan Perjalanan</label>
                        @error('tujuan')
                            <span class="mdl-textfield__error">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="date" id="tanggal_berangkat" name="tanggal_berangkat" value="{{ old('tanggal_berangkat', $sppd->tanggal_berangkat->format('Y-m-d')) }}" required>
                        <label class="mdl-textfield__label" for="tanggal_berangkat">Tanggal Berangkat</label>
                        @error('tanggal_berangkat')
                            <span class="mdl-textfield__error">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="date" id="tanggal_kembali" name="tanggal_kembali" value="{{ old('tanggal_kembali', $sppd->tanggal_kembali->format('Y-m-d')) }}" required>
                        <label class="mdl-textfield__label" for="tanggal_kembali">Tanggal Kembali</label>
                        @error('tanggal_kembali')
                            <span class="mdl-textfield__error">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <textarea class="mdl-textfield__input" type="text" id="keperluan" name="keperluan" rows="3" required>{{ old('keperluan', $sppd->keperluan) }}</textarea>
                        <label class="mdl-textfield__label" for="keperluan">Keperluan Perjalanan</label>
                        @error('keperluan')
                            <span class="mdl-textfield__error">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                        Update SPPD
                    </button>
                    
                    <a href="{{ route('sppd.index') }}" class="mdl-button mdl-js-button">
                        Batal
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection