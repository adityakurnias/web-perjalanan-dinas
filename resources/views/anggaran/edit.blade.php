<!-- resources/views/anggaran/edit.blade.php -->
@extends('layouts.app')

@section('title', 'Edit Anggaran')

@section('content')
<div class="mdl-grid">
    <div class="mdl-cell mdl-cell--6-col mdl-cell--3-offset">
        <div class="mdl-card mdl-shadow--2dp card-wide">
            <div class="mdl-card__title">
                <h2 class="mdl-card__title-text">Edit Anggaran</h2>
            </div>
            <div class="mdl-card__supporting-text">
                <form method="POST" action="{{ route('anggaran.update', $anggaran->id) }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="number" id="tahun" name="tahun" value="{{ old('tahun', $anggaran->tahun) }}" min="2020" max="2100" required>
                        <label class="mdl-textfield__label" for="tahun">Tahun</label>
                        @error('tahun')
                            <span class="mdl-textfield__error">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <select class="mdl-textfield__input" id="bulan" name="bulan" required>
                            <option value="">Pilih Bulan</option>
                            @php
                                $months = [
                                    1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                                    5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                                    9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                                ];
                            @endphp
                            @foreach($months as $key => $month)
                                <option value="{{ $key }}" {{ old('bulan', $anggaran->bulan) == $key ? 'selected' : '' }}>{{ $month }}</option>
                            @endforeach
                        </select>
                        <label class="mdl-textfield__label" for="bulan">Bulan</label>
                        @error('bulan')
                            <span class="mdl-textfield__error">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="number" id="jumlah" name="jumlah" value="{{ old('jumlah', $anggaran->jumlah) }}" step="0.01" min="0" required>
                        <label class="mdl-textfield__label" for="jumlah">Jumlah Anggaran (Rp)</label>
                        @error('jumlah')
                            <span class="mdl-textfield__error">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                        Update Anggaran
                    </button>
                    
                    <a href="{{ route('anggaran.index') }}" class="mdl-button mdl-js-button">
                        Batal
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection