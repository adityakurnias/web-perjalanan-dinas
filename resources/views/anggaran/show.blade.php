@extends('layouts.app')

@section('title', 'Detail Anggaran')

@section('content')
<div class="min-h-screen bg-violet-50 flex items-center justify-center p-4 sm:p-6 lg:p-8">
    <div class="max-w-2xl w-full bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="p-8">
            <h2 class="text-3xl font-bold text-[#6750A4]">Detail Anggaran</h2>
            <p class="mt-2 text-sm text-[#6750A4]">
                Informasi lengkap untuk anggaran bulan 
                @php
                    $months = [
                        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                        5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                    ];
                @endphp
                {{ $months[$anggaran->bulan] }} {{ $anggaran->tahun }}.
            </p>
        </div>

        <div class="border-t border-gray-200 px-8 py-6" >
            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-8">
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Tahun</dt>
                    <dd class="mt-1 text-base font-semibold text-[#6750A4]">{{ $anggaran->tahun }}</dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Bulan</dt>
                    <dd class="mt-1 text-base font-semibold text-[#6750A4]">{{ $months[$anggaran->bulan] }}</dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Jumlah Anggaran</dt>
                    <dd class="mt-1 text-base font-semibold text-[#6750A4]">Rp {{ number_format($anggaran->jumlah, 0, ',', '.') }}</dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Terpakai</dt>
                    <dd class="mt-1 text-base font-semibold text-[#6750A4]">Rp {{ number_format($anggaran->terpakai, 0, ',', '.') }}</dd>
                </div>
                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">Sisa Anggaran</dt>
                    <dd class="mt-1 text-2xl font-bold {{ $anggaran->sisa < 0 ? 'text-red-600' : 'text-green-600' }}">
                        Rp {{ number_format($anggaran->sisa, 0, ',', '.') }}
                    </dd>
                </div>
            </dl>
        </div>

        <div class="bg-gray-50 px-8 py-4 flex items-center justify-end space-x-4">
            <a href="{{ route('anggaran.index') }}"
               class="bg-gray-200 text-gray-700 font-semibold py-2 px-5 rounded-xl hover:bg-gray-300 transition duration-300">
                Kembali
            </a>
            <a href="{{ route('anggaran.edit', $anggaran->id) }}"
               class="inline-flex items-center bg-violet-600 text-white font-semibold py-2 px-5 rounded-xl hover:bg-violet-700 transition duration-300 shadow-md">
                <span class="material-icons mr-2">edit</span>
                Edit
            </a>
        </div>
    </div>
</div>
@endsection