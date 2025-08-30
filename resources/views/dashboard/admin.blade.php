<!-- resources/views/dashboard/admin.blade.php -->
@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
    <div class= min-h-screen p-4 sm:p-6 lg:p-8">
        <div class="max-w-7xl mx-auto">

            <h2 class="text-2xl font-bold text-[#6750A4] mb-6">Ringkasan</h2>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-12">
                <div class="bg-[#CCC2DC] p-5 rounded-2xl shadow-md flex flex-col justify-between">
                    <div>
                        <div class="text-sm font-medium text-[#6750A4]">Pengguna Menunggu</div>
                        <div class="text-3xl font-bold text-[#6750A4] mt-2">{{ $pendingUsers }}</div>
                    </div>
                    <a href="{{ route('pegawai.index') }}" class="text-sm font-semibold text-violet-600 hover:text-violet-800 mt-4">Lihat Detail &rarr;</a>
                </div>

                <div class="bg-[#CCC2DC] p-5 rounded-2xl shadow-md flex flex-col justify-between">
                    <div>
                        <div class="text-sm font-medium text-[#6750A4]">SPPD Menunggu</div>
                        <div class="text-3xl font-bold text-[#6750A4] mt-2">{{ $pendingSPPDs }}</div>
                    </div>
                    <a href="{{ route('sppd.index') }}" class="text-sm font-semibold text-violet-600 hover:text-violet-800 mt-4">Lihat Detail &rarr;</a>
                </div>

                <div class="bg-[#CCC2DC] p-5 rounded-2xl shadow-md">
                    <div class="text-sm font-medium text-[#6750A4]">Total SPPD</div>
                    <div class="text-3xl font-bold text-[#6750A4] mt-2">{{ $totalSPPDs }}</div>
                </div>

                <div class="bg-[#CCC2DC] p-5 rounded-2xl shadow-md">
                    <div class="text-sm font-medium text-[#6750A4]">Total Anggaran</div>
                    <div class="text-2xl font-bold text-[#6750A4] mt-2">Rp {{ number_format($totalAnggaran, 0, ',', '.') }}</div>
                </div>

                <div class="bg-[#CCC2DC] p-5 rounded-2xl shadow-md">
                    <div class="text-sm font-medium text-[#6750A4]">Anggaran Terpakai</div>
                    <div class="text-2xl font-bold text-red-600 mt-2">Rp {{ number_format($terpakaiAnggaran, 0, ',', '.') }}</div>
                </div>

                <div class="bg-[#CCC2DC] p-5 rounded-2xl shadow-md">
                    <div class="text-sm font-medium text-[#6750A4]">Sisa Anggaran</div>
                    <div class="text-2xl font-bold text-green-800 mt-2">Rp {{ number_format($totalAnggaran - $terpakaiAnggaran, 0, ',', '.') }}</div>
                </div>
            </div>

            <h3 class="text-2xl font-bold text-[#6750A4] mb-6">Menu Admin</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-violet-200 p-6 rounded-2xl shadow-lg flex flex-col">
                    <div class="flex-grow">
                        <h2 class="text-xl font-bold text-[#6750A4]">Kelola Pegawai</h2>
                        <p class="mt-2 text-[#6750A4]">
                            Kelola data pegawai dan persetujuan akun.
                        </p>
                    </div>
                    <div class="mt-6">
                        <a href="{{ route('pegawai.index') }}"
                           class="inline-block w-full text-center bg-violet-600 text-white font-semibold py-3 px-5 rounded-xl hover:bg-[#6750A4] transition duration-300 shadow-md">
                            Buka
                        </a>
                    </div>
                </div>

                <div class="bg-violet-200 p-6 rounded-2xl shadow-lg flex flex-col">
                    <div class="flex-grow">
                        <h2 class="text-xl font-bold text-[#6750A4]">Kelola SPPD</h2>
                        <p class="mt-2 text-[#6750A4]">
                            Kelola pengajuan dan persetujuan SPPD.
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
                        <h2 class="text-xl font-bold text-[#6750A4]">Kelola Biaya</h2>
                        <p class="mt-2 text-[#6750A4]">
                            Kelola pengajuan dan persetujuan biaya perjalanan.
                        </p>
                    </div>
                    <div class="mt-6">
                        <a href="{{ route('biaya.index') }}"
                           class="inline-block w-full text-center bg-violet-600 text-white font-semibold py-3 px-5 rounded-xl hover:bg-[#6750A4] transition duration-300 shadow-md">
                            Buka
                        </a>
                    </div>
                </div>

                <div class="bg-violet-200 p-6 rounded-2xl shadow-lg flex flex-col">
                    <div class="flex-grow">
                        <h2 class="text-xl font-bold text-[#6750A4]">Kelola Anggaran</h2>
                        <p class="mt-2 text-[#6750A4]">
                            Kelola anggaran perjalanan dinas.
                        </p>
                    </div>
                    <div class="mt-6">
                        <a href="{{ route('anggaran.index') }}"
                           class="inline-block w-full text-center bg-violet-600 text-white font-semibold py-3 px-5 rounded-xl hover:bg-[#6750A4] transition duration-300 shadow-md">
                            Buka
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection