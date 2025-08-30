<!-- resources/views/pegawai/show.blade.php -->
@extends('layouts.app')

@section('title', 'Detail Pegawai')

@section('content')
    <div class="bg-violet-50 min-h-screen flex items-center justify-center p-4 sm:p-6 lg:p-8">
        <div class="max-w-3xl w-full bg-white/50 rounded-2xl shadow-lg overflow-hidden">
            <div class="p-8">
                <h2 class="text-3xl font-bold text-[#6750A4]">Detail Pegawai</h2>
                <p class="mt-2 text-sm text-[#6750A4]">Informasi lengkap untuk {{ $user->name }}.</p>
            </div>

            <div class="border-t border-gray-200 px-8 py-6">
                <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-8">
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-[#6750A4]">NIK</dt>
                        <dd class="mt-1 text-base font-semibold text-[#6750A4]">{{ $user->nik }}</dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-[#6750A4]">Nama Lengkap</dt>
                        <dd class="mt-1 text-base font-semibold text-[#6750A4]">{{ $user->name }}</dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-[#6750A4]">Email</dt>
                        <dd class="mt-1 text-base font-semibold text-[#6750A4]">{{ $user->email }}</dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-[#6750A4]">Jabatan</dt>
                        <dd class="mt-1 text-base font-semibold text-[#6750A4]">{{ $user->pegawai->jabatan }}</dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-[#6750A4]">Departemen</dt>
                        <dd class="mt-1 text-base font-semibold text-[#6750A4]">{{ $user->pegawai->departemen }}</dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-[#6750A4]">No. Telepon</dt>
                        <dd class="mt-1 text-base font-semibold text-[#6750A4]">{{ $user->pegawai->no_telp }}</dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-[#6750A4]">Alamat</dt>
                        <dd class="mt-1 text-base font-semibold text-[#6750A4]">{{ $user->pegawai->alamat }}</dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-[#6750A4]">Status Akun</dt>
                        <dd class="mt-1 text-base font-semibold text-[#6750A4]">
                            @if($user->status == 'approved')
                                <span
                                    class="px-3 py-1 text-sm font-semibold text-green-800 bg-green-100 rounded-full">Disetujui</span>
                            @elseif($user->status == 'rejected')
                                <span
                                    class="px-3 py-1 text-sm font-semibold text-red-800 bg-red-100 rounded-full">Ditolak</span>
                            @else
                                <span
                                    class="px-3 py-1 text-sm font-semibold text-yellow-800 bg-yellow-100 rounded-full">Menunggu</span>
                            @endif
                        </dd>
                    </div>
                </dl>
            </div>

            <div class="bg-gray-50 px-8 py-4 flex items-center justify-end space-x-4">
                <a href="{{ route('pegawai.index') }}"
                    class="bg-gray-200 text-[#6750A4] font-semibold py-2 px-5 rounded-xl hover:bg-gray-300 transition duration-300">
                    Kembali
                </a>
                <a href="{{ route('pegawai.edit', $user->id) }}"
                    class="inline-flex items-center bg-violet-600 text-white font-semibold py-2 px-5 rounded-xl hover:bg-violet-700 transition duration-300 shadow-md">
                    <span class="material-icons mr-2"">edit</span>
                        Edit
                    </a>
                </div>
            </div>
        </div>

@endsection