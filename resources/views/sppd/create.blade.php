@extends('layouts.app')

@section('title', 'Buat SPPD')

@section('content')
<div class="min-h-screen bg-violet-50 flex items-center justify-center p-4 sm:p-6 lg:p-8">
    <div class="max-w-2xl w-full bg-white rounded-2xl shadow-lg p-8 space-y-6">
        <h2 class="text-3xl font-bold text-center text-[#6750A4]">Ajukan SPPD Baru</h2>

        <form method="POST" action="{{ route('sppd.store') }}" class="space-y-6">
            @csrf

            <div>
                <label for="tujuan" class="block text-sm font-medium text-[#6750A4]">Tujuan Perjalanan</label>
                <input type="text" id="tujuan" name="tujuan" value="{{ old('tujuan') }}" required
                       class="mt-1 appearance-none rounded-xl relative block w-full px-3 py-3 border {{ $errors->has('tujuan') ? 'border-red-500' : 'border-gray-300' }} placeholder-gray-500 text-[#6750A4] focus:outline-none focus:ring-violet-500 focus:border-violet-500 sm:text-sm"
                       placeholder="Contoh: Jakarta">
                @error('tujuan')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="tanggal_berangkat" class="block text-sm font-medium text-[#6750A4]">Tanggal Berangkat</label>
                    <input type="date" id="tanggal_berangkat" name="tanggal_berangkat" value="{{ old('tanggal_berangkat') }}" required
                           class="mt-1 appearance-none rounded-xl relative block w-full px-3 py-3 border {{ $errors->has('tanggal_berangkat') ? 'border-red-500' : 'border-gray-300' }} placeholder-gray-500 text-[#6750A4] focus:outline-none focus:ring-violet-500 focus:border-violet-500 sm:text-sm">
                    @error('tanggal_berangkat')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="tanggal_kembali" class="block text-sm font-medium text-[#6750A4]">Tanggal Kembali</label>
                    <input type="date" id="tanggal_kembali" name="tanggal_kembali" value="{{ old('tanggal_kembali') }}" required
                           class="mt-1 appearance-none rounded-xl relative block w-full px-3 py-3 border {{ $errors->has('tanggal_kembali') ? 'border-red-500' : 'border-gray-300' }} placeholder-gray-500 text-[#6750A4] focus:outline-none focus:ring-violet-500 focus:border-violet-500 sm:text-sm">
                    @error('tanggal_kembali')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="keperluan" class="block text-sm font-medium text-[#6750A4]">Keperluan Perjalanan</label>
                <textarea id="keperluan" name="keperluan" rows="4" required
                          class="mt-1 appearance-none rounded-xl relative block w-full px-3 py-2 border {{ $errors->has('keperluan') ? 'border-red-500' : 'border-gray-300' }} placeholder-gray-500 text-[#6750A4] focus:outline-none focus:ring-violet-500 focus:border-violet-500 sm:text-sm"
                          placeholder="Jelaskan keperluan perjalanan dinas Anda...">{{ old('keperluan') }}</textarea>
                @error('keperluan')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end space-x-4 pt-4">
                <a href="{{ route('sppd.index') }}"
                   class="bg-gray-200 text-gray-700 font-semibold py-2 px-5 rounded-xl hover:bg-gray-300 transition duration-300">
                    Batal
                </a>
                <button type="submit"
                        class="inline-flex items-center bg-violet-600 text-white font-semibold py-2 px-5 rounded-xl hover:bg-violet-700 transition duration-300 shadow-md">
                    <span class="material-icons mr-2">send</span>
                    Ajukan SPPD
                </button>
            </div>
        </form>
    </div>
</div>
@endsection