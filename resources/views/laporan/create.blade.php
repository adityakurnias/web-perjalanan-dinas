@extends('layouts.app')

@section('title', 'Buat Laporan')

@section('content')
<div class="min-h-screen bg-violet-50 flex items-center justify-center p-4 sm:p-6 lg:p-8">
    <div class="max-w-4xl w-full bg-white rounded-2xl shadow-lg p-8 space-y-6">
        <h2 class="text-3xl font-bold text-center text-[#6750A4]">Buat Laporan Perjalanan</h2>

        <form method="POST" action="{{ route('laporan.store') }}" class="space-y-6">
            @csrf

            <div>
                <label for="sppd_id" class="block text-sm font-medium text-[#6750A4]">SPPD</label>
                <select id="sppd_id" name="sppd_id" required
                        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-violet-500 focus:border-violet-500 sm:text-sm rounded-xl">
                    <option value="">Pilih SPPD</option>
                    @foreach($sppds as $sppd)
                        <option value="{{ $sppd->id }}" {{ old('sppd_id') == $sppd->id ? 'selected' : '' }}>
                            {{ $sppd->tujuan }} ({{ $sppd->tanggal_berangkat->format('d/m/Y') }} - {{ $sppd->tanggal_kembali->format('d/m/Y') }})
                        </option>
                    @endforeach
                </select>
                @error('sppd_id')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="kegiatan" class="block text-sm font-medium text-[#6750A4]">Kegiatan yang Dilakukan</label>
                <textarea id="kegiatan" name="kegiatan" rows="4" required
                          class="mt-1 appearance-none rounded-xl relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-[#6750A4] focus:outline-none focus:ring-violet-500 focus:border-violet-500 sm:text-sm">{{ old('kegiatan') }}</textarea>
                @error('kegiatan')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="hasil" class="block text-sm font-medium text-[#6750A4]">Hasil yang Dicapai</label>
                <textarea id="hasil" name="hasil" rows="4" required
                          class="mt-1 appearance-none rounded-xl relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-[#6750A4] focus:outline-none focus:ring-violet-500 focus:border-violet-500 sm:text-sm">{{ old('hasil') }}</textarea>
                @error('hasil')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <h3 class="text-xl font-bold text-[#6750A4] mb-4">Detail Biaya</h3>
                <div id="biaya-container" class="space-y-4">
                    <!-- Dynamic rows will be inserted here -->
                </div>
                <button type="button" id="add-biaya" class="mt-4 inline-flex items-center bg-gray-200 text-gray-700 font-semibold py-2 px-4 rounded-xl hover:bg-gray-300 transition duration-300">
                    <span class="material-icons mr-2">add_circle</span>
                    Tambah Biaya
                </button>
            </div>

            <div class="flex items-center justify-end space-x-4 pt-4">
                <a href="{{ route('laporan.index') }}"
                   class="bg-gray-200 text-gray-700 font-semibold py-2 px-5 rounded-xl hover:bg-gray-300 transition duration-300">
                    Batal
                </a>
                <button type="submit"
                        class="inline-flex items-center bg-violet-600 text-white font-semibold py-2 px-5 rounded-xl hover:bg-violet-700 transition duration-300 shadow-md">
                    <span class="material-icons mr-2">save</span>
                    Simpan Laporan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const addButton = document.getElementById('add-biaya');
        const biayaContainer = document.getElementById('biaya-container');

        const createBiayaRow = () => {
            const newRow = document.createElement('div');
            newRow.className = 'p-4 border rounded-xl relative grid grid-cols-1 md:grid-cols-3 gap-4 items-start';
            newRow.innerHTML = `
                <button type="button" class="absolute top-2 right-2 text-red-500 hover:text-red-700 remove-biaya">
                    <span class="material-icons">close</span>
                </button>
                <div class="md:col-span-1">
                    <label class="block text-sm font-medium text-[#6750A4]">Jenis Biaya</label>
                    <input type="text" name="jenis_biaya[]" required
                           class="mt-1 appearance-none rounded-xl relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-[#6750A4] focus:outline-none focus:ring-violet-500 focus:border-violet-500 sm:text-sm">
                </div>
                <div class="md:col-span-1">
                    <label class="block text-sm font-medium text-[#6750A4]">Jumlah Biaya</label>
                    <input type="number" name="jumlah_biaya[]" step="1000" required
                           class="mt-1 appearance-none rounded-xl relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-[#6750A4] focus:outline-none focus:ring-violet-500 focus:border-violet-500 sm:text-sm">
                </div>
                <div class="md:col-span-1">
                    <label class="block text-sm font-medium text-[#6750A4]">Keterangan</label>
                    <textarea name="keterangan_biaya[]" rows="2"
                              class="mt-1 appearance-none rounded-xl relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-[#6750A4] focus:outline-none focus:ring-violet-500 focus:border-violet-500 sm:text-sm"></textarea>
                </div>
            `;
            
            biayaContainer.appendChild(newRow);

            newRow.querySelector('.remove-biaya').addEventListener('click', function() {
                newRow.remove();
            });
        };

        addButton.addEventListener('click', createBiayaRow);

        // Add one row by default
        createBiayaRow();
    });
</script>
@endsection