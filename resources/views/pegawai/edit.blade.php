{{-- resources/views/pegawai/edit.blade.php --}}
@extends('layouts.app')

@section('title', 'Edit Pegawai')

@section('content')
<div class="min-h-screen flex items-center justify-center p-4 sm:p-6 lg:p-8">
    <div class="max-w-4xl w-full bg-[#CCC2DC] rounded-2xl shadow-lg p-8 space-y-8">
        <div>
            <h2 class="text-center text-3xl font-bold text-[#6750A4]">Edit Data Pegawai</h2>
            <p class="mt-2 text-center text-sm text-[#6750A4]">
                Perbarui detail untuk {{ $user->name }}.
            </p>
        </div>
        <form method="POST" action="{{ route('pegawai.update', $user->id) }}">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">

                <div class="space-y-6">
                    <h4 class="text-lg font-semibold text-[#6750A4] border-b border-gray-400 pb-2">Data Akun</h4>

                    <div>
                        <label for="nik" class="block text-sm font-medium text-[#6750A4]">NIK</label>
                        <input type="text" id="nik" name="nik" value="{{ old('nik', $user->nik) }}" required
                               class="mt-1 block w-full px-4 py-3 bg-gray-50/50 border {{ $errors->has('nik') ? 'border-red-500' : 'border-gray-300' }} rounded-xl shadow-sm focus:outline-none focus:ring-violet-500 focus:border-violet-500 sm:text-sm">
                        @error('nik')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="name" class="block text-sm font-medium text-[#6750A4]">Nama Lengkap</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                               class="mt-1 block w-full px-4 py-3 bg-gray-50/50 border {{ $errors->has('name') ? 'border-red-500' : 'border-gray-300' }} rounded-xl shadow-sm focus:outline-none focus:ring-violet-500 focus:border-violet-500 sm:text-sm">
                        @error('name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-[#6750A4]">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                               class="mt-1 block w-full px-4 py-3 bg-gray-50/50 border {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }} rounded-xl shadow-sm focus:outline-none focus:ring-violet-500 focus:border-violet-500 sm:text-sm">
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="space-y-6">
                    <h4 class="text-lg font-semibold text-[#6750A4] border-b border-gray-400 pb-2">Data Pegawai</h4>

                    <div>
                        <label for="jabatan" class="block text-sm font-medium text-[#6750A4]">Jabatan</label>
                        <input type="text" id="jabatan" name="jabatan" value="{{ old('jabatan', $user->pegawai->jabatan) }}" required
                               class="mt-1 block w-full px-4 py-3 bg-gray-50/50 border {{ $errors->has('jabatan') ? 'border-red-500' : 'border-gray-300' }} rounded-xl shadow-sm focus:outline-none focus:ring-violet-500 focus:border-violet-500 sm:text-sm">
                        @error('jabatan')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="departemen" class="block text-sm font-medium text-[#6750A4]">Departemen</label>
                        <input type="text" id="departemen" name="departemen" value="{{ old('departemen', $user->pegawai->departemen) }}" required
                               class="mt-1 block w-full px-4 py-3 bg-gray-50/50 border {{ $errors->has('departemen') ? 'border-red-500' : 'border-gray-300' }} rounded-xl shadow-sm focus:outline-none focus:ring-violet-500 focus:border-violet-500 sm:text-sm">
                        @error('departemen')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="no_telp" class="block text-sm font-medium text-[#6750A4]">No. Telepon</label>
                        <input type="text" id="no_telp" name="no_telp" value="{{ old('no_telp', $user->pegawai->no_telp) }}" required
                               class="mt-1 block w-full px-4 py-3 bg-gray-50/50 border {{ $errors->has('no_telp') ? 'border-red-500' : 'border-gray-300' }} rounded-xl shadow-sm focus:outline-none focus:ring-violet-500 focus:border-violet-500 sm:text-sm">
                        @error('no_telp')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="alamat" class="block text-sm font-medium text-[#6750A4]">Alamat</label>
                        <textarea id="alamat" name="alamat" rows="3" required
                                  class="mt-1 block w-full px-4 py-3 bg-gray-50/50 border {{ $errors->has('alamat') ? 'border-red-500' : 'border-gray-300' }} rounded-xl shadow-sm focus:outline-none focus:ring-violet-500 focus:border-violet-500 sm:text-sm">{{ old('alamat', $user->pegawai->alamat) }}</textarea>
                        @error('alamat')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end pt-8 mt-8 border-t border-gray-400">
                <a href="{{ route('pegawai.index') }}" class="bg-gray-200 text-[#6750A4] font-semibold py-3 px-6 rounded-xl hover:bg-gray-300 transition duration-300 mr-4">
                    Batal
                </a>
                <button type="submit" class="bg-[#6750A4] cursor-pointer text-white font-semibold py-3 px-6 rounded-xl hover:bg-violet-700 transition duration-300 shadow-md">
                    Update Pegawai
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
