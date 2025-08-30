@extends('layouts.app')

@section('title', 'Edit Laporan')

@section('content')
<div class="min-h-screen bg-violet-50 flex items-center justify-center p-4 sm:p-6 lg:p-8">
    <div class="max-w-4xl w-full bg-white rounded-2xl shadow-lg p-8 space-y-6">
        <h2 class="text-3xl font-bold text-center text-[#6750A4]">Edit Laporan Perjalanan</h2>

        <form method="POST" action="{{ route('laporan.update', $laporan->id) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-[#6750A4]">SPPD</label>
                <div class="mt-1 bg-gray-100 rounded-xl p-3 text-gray-600">
                    {{ $laporan->sppd->tujuan }} ({{ $laporan->sppd->tanggal_berangkat->format('d/m/Y') }} - {{ $laporan->sppd->tanggal_kembali->format('d/m/Y') }})
                </div>
            </div>

            <div>
                <label for="kegiatan" class="block text-sm font-medium text-[#6750A4]">Kegiatan yang Dilakukan</label>
                <textarea id="kegiatan" name="kegiatan" rows="4" required
                          class="mt-1 appearance-none rounded-xl relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-[#6750A4] focus:outline-none focus:ring-violet-500 focus:border-violet-500 sm:text-sm">{{ old('kegiatan', $laporan->kegiatan) }}</textarea>
                @error('kegiatan')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="hasil" class="block text-sm font-medium text-[#6750A4]">Hasil yang Dicapai</label>
                <textarea id="hasil" name="hasil" rows="4" required
                          class="mt-1 appearance-none rounded-xl relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-[#6750A4] focus:outline-none focus:ring-violet-500 focus:border-violet-500 sm:text-sm">{{ old('hasil', $laporan->hasil) }}</textarea>
                @error('hasil')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end space-x-4 pt-4">
                <a href="{{ route('laporan.show', $laporan->id) }}"
                   class="bg-gray-200 text-gray-700 font-semibold py-2 px-5 rounded-xl hover:bg-gray-300 transition duration-300">
                    Batal
                </a>
                <button type="submit"
                        class="inline-flex items-center bg-violet-600 text-white font-semibold py-2 px-5 rounded-xl hover:bg-violet-700 transition duration-300 shadow-md">
                    <span class="material-icons mr-2">save</span>
                    Update Laporan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection