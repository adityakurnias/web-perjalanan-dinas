<!-- resources/views/sppd/create.blade.php -->
@extends('layouts.app')

@section('title', 'Buat SPPD')

@section('content')
<div class="mdl-grid">
    <div class="mdl-cell mdl-cell--8-col mdl-cell--2-offset">
        <div class="mdl-card mdl-shadow--2dp card-wide">
            <div class="mdl-card__title">
                <h2 class="mdl-card__title-text">Ajukan SPPD Baru</h2>
            </div>
            <div class="mdl-card__supporting-text">
                <form method="POST" action="{{ route('sppd.store') }}">
                    @csrf
                    
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" id="tujuan" name="tujuan" value="{{ old('tujuan') }}" required>
                        <label class="mdl-textfield__label" for="tujuan">Tujuan Perjalanan</label>
                        @error('tujuan')
                            <span class="mdl-textfield__error">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="date" id="tanggal_berangkat" name="tanggal_berangkat" value="{{ old('tanggal_berangkat') }}" required>
                        <label class="mdl-textfield__label" for="tanggal_berangkat">Tanggal Berangkat</label>
                        @error('tanggal_berangkat')
                            <span class="mdl-textfield__error">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="date" id="tanggal_kembali" name="tanggal_kembali" value="{{ old('tanggal_kembali') }}" required>
                        <label class="mdl-textfield__label" for="tanggal_kembali">Tanggal Kembali</label>
                        @error('tanggal_kembali')
                            <span class="mdl-textfield__error">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <textarea class="mdl-textfield__input" type="text" id="keperluan" name="keperluan" rows="3" required>{{ old('keperluan') }}</textarea>
                        <label class="mdl-textfield__label" for="keperluan">Keperluan Perjalanan</label>
                        @error('keperluan')
                            <span class="mdl-textfield__error">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                        Ajukan SPPD
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