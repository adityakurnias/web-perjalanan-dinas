@extends('layouts.app')

@section('title', 'Edit Anggaran')

@section('content')
<div class="min-h-screen bg-violet-50 flex items-center justify-center p-4">
    <div class="max-w-lg w-full bg-white rounded-2xl shadow-lg p-8 space-y-6">
        <h2 class="text-3xl font-bold text-center text-[#6750A4]">Edit Anggaran</h2>

        <form method="POST" action="{{ route('anggaran.update', $anggaran->id) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="tahun" class="block text-sm font-medium text-[#6750A4]">Tahun</label>
                <div class="mt-1 relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <span class="material-icons text-gray-400">event</span>
                    </div>
                    <input id="tahun" name="tahun" type="number" value="{{ old('tahun', $anggaran->tahun) }}" min="2020" max="2100" required
                           class="appearance-none rounded-xl relative block w-full px-3 py-3 pl-10 border {{ $errors->has('tahun') ? 'border-red-500' : 'border-gray-300' }} placeholder-gray-500 text-[#6750A4] focus:outline-none focus:ring-violet-500 focus:border-violet-500 sm:text-sm"
                           placeholder="Tahun">
                </div>
                @error('tahun')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="bulan" class="block text-sm font-medium text-[#6750A4]">Bulan</label>
                <div class="mt-1 relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <span class="material-icons text-gray-400">calendar_today</span>
                    </div>
                    <select id="bulan" name="bulan" required
                            class="appearance-none rounded-xl relative block w-full px-3 py-3 pl-10 border {{ $errors->has('bulan') ? 'border-red-500' : 'border-gray-300' }} bg-white text-[#6750A4] focus:outline-none focus:ring-violet-500 focus:border-violet-500 sm:text-sm">
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
                </div>
                 @error('bulan')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="jumlah" class="block text-sm font-medium text-[#6750A4]">Jumlah Anggaran (Rp)</label>
                <div class="mt-1 relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <span class="material-icons text-gray-400">attach_money</span>
                    </div>
                    <input id="jumlah" name="jumlah" type="number" step="1000" min="0" required value="{{ old('jumlah', $anggaran->jumlah) }}"
                           class="appearance-none rounded-xl relative block w-full px-3 py-3 pl-10 border {{ $errors->has('jumlah') ? 'border-red-500' : 'border-gray-300' }} placeholder-gray-500 text-[#6750A4] focus:outline-none focus:ring-violet-500 focus:border-violet-500 sm:text-sm"
                           placeholder="Jumlah Anggaran">
                </div>
                @error('jumlah')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end space-x-4 pt-4">
                <a href="{{ route('anggaran.index') }}"
                   class="bg-gray-200 text-gray-700 font-semibold py-2 px-5 rounded-xl hover:bg-gray-300 transition duration-300">
                    Batal
                </a>
                <button type="submit"
                        class="inline-flex items-center bg-violet-600 text-white font-semibold py-2 px-5 rounded-xl hover:bg-violet-700 transition duration-300 shadow-md">
                    <span class="material-icons mr-2">save</span>
                    Update Anggaran
                </button>
            </div>
        </form>
    </div>
</div>
@endsection