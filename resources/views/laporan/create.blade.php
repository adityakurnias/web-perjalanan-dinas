<!-- resources/views/laporan/create.blade.php -->
@extends('layouts.app')

@section('title', 'Buat Laporan')

@section('content')
<div class="mdl-grid">
    <div class="mdl-cell mdl-cell--10-col mdl-cell--1-offset">
        <div class="mdl-card mdl-shadow--2dp card-wide">
            <div class="mdl-card__title">
                <h2 class="mdl-card__title-text">Buat Laporan Perjalanan</h2>
            </div>
            <div class="mdl-card__supporting-text">
                <form method="POST" action="{{ route('laporan.store') }}">
                    @csrf
                    
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <select class="mdl-textfield__input" id="sppd_id" name="sppd_id" required>
                            <option value="">Pilih SPPD</option>
                            @foreach($sppds as $sppd)
                                <option value="{{ $sppd->id }}" {{ old('sppd_id') == $sppd->id ? 'selected' : '' }}>
                                    {{ $sppd->tujuan }} ({{ $sppd->tanggal_berangkat->format('d/m/Y') }} - {{ $sppd->tanggal_kembali->format('d/m/Y') }})
                                </option>
                            @endforeach
                        </select>
                        <label class="mdl-textfield__label" for="sppd_id">SPPD</label>
                        @error('sppd_id')
                            <span class="mdl-textfield__error">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <textarea class="mdl-textfield__input" type="text" id="kegiatan" name="kegiatan" rows="3" required>{{ old('kegiatan') }}</textarea>
                        <label class="mdl-textfield__label" for="kegiatan">Kegiatan yang Dilakukan</label>
                        @error('kegiatan')
                            <span class="mdl-textfield__error">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <textarea class="mdl-textfield__input" type="text" id="hasil" name="hasil" rows="3" required>{{ old('hasil') }}</textarea>
                        <label class="mdl-textfield__label" for="hasil">Hasil yang Dicapai</label>
                        @error('hasil')
                            <span class="mdl-textfield__error">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <h4>Detail Biaya</h4>
                    <div id="biaya-container">
                        <div class="biaya-row">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" type="text" name="jenis_biaya[]" required>
                                <label class="mdl-textfield__label">Jenis Biaya</label>
                            </div>
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" type="number" name="jumlah_biaya[]" step="0.01" required>
                                <label class="mdl-textfield__label">Jumlah Biaya</label>
                            </div>
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <textarea class="mdl-textfield__input" name="keterangan_biaya[]" rows="2"></textarea>
                                <label class="mdl-textfield__label">Keterangan</label>
                            </div>
                        </div>
                    </div>
                    
                    <button type="button" id="add-biaya" class="mdl-button mdl-js-button mdl-button--icon">
                        <i class="material-icons">add_circle</i> Tambah Biaya
                    </button>
                    
                    <div style="margin-top: 20px;">
                        <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                            Simpan Laporan
                        </button>
                        
                        <a href="{{ route('laporan.index') }}" class="mdl-button mdl-js-button">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const addButton = document.getElementById('add-biaya');
        const biayaContainer = document.getElementById('biaya-container');
        
        addButton.addEventListener('click', function() {
            const newRow = document.createElement('div');
            newRow.className = 'biaya-row';
            newRow.innerHTML = `
                <span class="remove-biaya" onclick="this.parentElement.remove()">×</span>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="text" name="jenis_biaya[]" required>
                    <label class="mdl-textfield__label">Jenis Biaya</label>
                </div>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="number" name="jumlah_biaya[]" step="0.01" required>
                    <label class="mdl-textfield__label">Jumlah Biaya</label>
                </div>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <textarea class="mdl-textfield__input" name="keterangan_biaya[]" rows="2"></textarea>
                    <label class="mdl-textfield__label">Keterangan</label>
                </div>
            `;
            
            biayaContainer.appendChild(newRow);
            
            // Re-initialize MDL components
            componentHandler.upgradeAllRegistered();
        });
    });
</script>
@endsection