@extends('layouts.app')

@section('title', 'Dashboard Pegawai')

@section('content')
<div class="min-h-screen bg-violet-50 p-4 sm:p-6 lg:p-8">
    <div class="max-w-7xl mx-auto">

        <h2 class="text-2xl font-bold text-[#6750A4] mb-6">Ringkasan</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-12">
            <div class="bg-[#CCC2DC] p-5 rounded-2xl shadow-md flex flex-col justify-between">
                <div>
                    <div class="text-sm font-medium text-[#6750A4]">Total SPPD</div>
                    <div class="text-3xl font-bold text-[#6750A4] mt-2">{{ $totalSPPDs }}</div>
                </div>
                <a href="{{ route('sppd.index') }}" class="text-sm font-semibold text-violet-600 hover:text-violet-800 mt-4">Lihat Detail &rarr;</a>
            </div>

            <div class="bg-[#CCC2DC] p-5 rounded-2xl shadow-md flex flex-col justify-between">
                <div>
                    <div class="text-sm font-medium text-[#6750A4]">SPPD Disetujui</div>
                    <div class="text-3xl font-bold text-green-600 mt-2">{{ $approvedSPPDs }}</div>
                </div>
            </div>
        </div>

        <h3 class="text-2xl font-bold text-[#6750A4] mb-6">SPPD Terbaru</h3>
        @if($sppds->count() > 0)
            <div class="bg-white rounded-2xl shadow-lg overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tujuan</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tgl Berangkat</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tgl Kembali</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($sppds as $sppd)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $sppd->tujuan }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $sppd->tanggal_berangkat->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $sppd->tanggal_kembali->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                @if($sppd->status == 'approved')
                                    <span class="px-3 py-1 text-sm font-semibold text-green-800 bg-green-100 rounded-full">Disetujui</span>
                                @elseif($sppd->status == 'rejected')
                                    <span class="px-3 py-1 text-sm font-semibold text-red-800 bg-red-100 rounded-full">Ditolak</span>
                                @else
                                    <span class="px-3 py-1 text-sm font-semibold text-yellow-800 bg-yellow-100 rounded-full">Menunggu</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('sppd.show', $sppd->id) }}" class="text-blue-600 hover:text-blue-900">
                                    <span class="material-icons">visibility</span>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="bg-white rounded-2xl shadow-lg p-8 text-center">
                <p class="text-lg text-[#6750A4]">Belum ada SPPD. <a href="{{ route('sppd.create') }}" class="font-medium text-violet-600 hover:text-violet-500">Ajukan SPPD pertama Anda</a>.</p>
            </div>
        @endif

        <h3 class="text-2xl font-bold text-[#6750A4] mt-12 mb-6">Menu Pegawai</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="bg-violet-200 p-6 rounded-2xl shadow-lg flex flex-col">
                <div class="flex-grow">
                    <h2 class="text-xl font-bold text-[#6750A4]">Buat SPPD</h2>
                    <p class="mt-2 text-[#6750A4]">
                        Ajukan Surat Perintah Perjalanan Dinas.
                    </p>
                </div>
                <div class="mt-6">
                    <a href="{{ route('sppd.create') }}"
                       class="inline-block w-full text-center bg-violet-600 text-white font-semibold py-3 px-5 rounded-xl hover:bg-[#6750A4] transition duration-300 shadow-md">
                        Buka
                    </a>
                </div>
            </div>

            <div class="bg-violet-200 p-6 rounded-2xl shadow-lg flex flex-col">
                <div class="flex-grow">
                    <h2 class="text-xl font-bold text-[#6750A4]">Status SPPD</h2>
                    <p class="mt-2 text-[#6750A4]">
                        Lihat status pengajuan SPPD Anda.
                    </p>
                </div>
                <div class="mt-6">
                    <a href="{{ route('sppd.index') }}"
                       class="inline-block w-full text-center bg-violet-600 text-white font-semibold py-3 px-5 rounded-xl hover:bg-[#6750A4] transition duration-300 shadow-md">
                        Buka
                    </a>
                </div>
            </div>

            <div class="bg-violet-200 p-6 rounded-2xl shadow-lg flex flex-col">
                <div class="flex-grow">
                    <h2 class="text-xl font-bold text-[#6750A4]">Buat Laporan</h2>
                    <p class="mt-2 text-[#6750A4]">
                        Buat laporan perjalanan dinas.
                    </p>
                </div>
                <div class="mt-6">
                    <a href="{{ route('laporan.create') }}"
                       class="inline-block w-full text-center bg-violet-600 text-white font-semibold py-3 px-5 rounded-xl hover:bg-[#6750A4] transition duration-300 shadow-md">
                        Buka
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection