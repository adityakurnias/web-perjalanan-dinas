@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<div class="min-h-screen bg-violet-50 p-4 sm:p-6 lg:p-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="p-8">
                <h2 class="text-3xl font-bold text-[#6750A4]">Profil Saya</h2>
                <p class="mt-2 text-sm text-[#6750A4]">Lihat dan perbarui informasi profil Anda.</p>
            </div>

            <div class="border-t border-gray-200 px-8 py-6">
                <h3 class="text-xl font-bold text-[#6750A4] mb-6">Informasi Akun</h3>
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="nik" class="block text-sm font-medium text-gray-500">NIK</label>
                            <input type="text" id="nik" name="nik" value="{{ old('nik', $user->nik) }}" required
                                   class="mt-1 block w-full px-4 py-3 bg-gray-100 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-violet-500 focus:border-violet-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-500">Nama Lengkap</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                                   class="mt-1 block w-full px-4 py-3 bg-gray-100 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-violet-500 focus:border-violet-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-500">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                                   class="mt-1 block w-full px-4 py-3 bg-gray-100 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-violet-500 focus:border-violet-500 sm:text-sm">
                        </div>
                    </div>

                    <h3 class="text-xl font-bold text-[#6750A4] mt-10 mb-6">Informasi Pegawai</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="jabatan" class="block text-sm font-medium text-gray-500">Jabatan</label>
                            <input type="text" id="jabatan" name="jabatan" value="{{ old('jabatan', $user->pegawai->jabatan) }}" required
                                   class="mt-1 block w-full px-4 py-3 bg-gray-100 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-violet-500 focus:border-violet-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="departemen" class="block text-sm font-medium text-gray-500">Departemen</label>
                            <input type="text" id="departemen" name="departemen" value="{{ old('departemen', $user->pegawai->departemen) }}" required
                                   class="mt-1 block w-full px-4 py-3 bg-gray-100 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-violet-500 focus:border-violet-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="no_telp" class="block text-sm font-medium text-gray-500">No. Telepon</label>
                            <input type="text" id="no_telp" name="no_telp" value="{{ old('no_telp', $user->pegawai->no_telp) }}" required
                                   class="mt-1 block w-full px-4 py-3 bg-gray-100 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-violet-500 focus:border-violet-500 sm:text-sm">
                        </div>
                        <div class="md:col-span-2">
                            <label for="alamat" class="block text-sm font-medium text-gray-500">Alamat</label>
                            <textarea id="alamat" name="alamat" rows="3" required
                                      class="mt-1 block w-full px-4 py-3 bg-gray-100 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-violet-500 focus:border-violet-500 sm:text-sm">{{ old('alamat', $user->pegawai->alamat) }}</textarea>
                        </div>
                    </div>

                    <div class="flex justify-end mt-8">
                        <button type="submit" class="inline-flex items-center bg-violet-600 text-white font-semibold py-2 px-5 rounded-xl hover:bg-violet-700 transition duration-300 shadow-md">
                            <span class="material-icons mr-2">save</span>
                            Update Profil
                        </button>
                    </div>
                </form>
            </div>

            <div class="border-t border-gray-200 px-8 py-6">
                <h3 class="text-xl font-bold text-[#6750A4] mb-6">Ubah Password</h3>
                <form method="POST" action="{{ route('profile.password') }}">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="current_password" class="block text-sm font-medium text-gray-500">Password Saat Ini</label>
                            <input type="password" id="current_password" name="current_password" required
                                   class="mt-1 block w-full px-4 py-3 bg-gray-100 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-violet-500 focus:border-violet-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="new_password" class="block text-sm font-medium text-gray-500">Password Baru</label>
                            <input type="password" id="new_password" name="new_password" required
                                   class="mt-1 block w-full px-4 py-3 bg-gray-100 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-violet-500 focus:border-violet-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="new_password_confirmation" class="block text-sm font-medium text-gray-500">Konfirmasi Password Baru</label>
                            <input type="password" id="new_password_confirmation" name="new_password_confirmation" required
                                   class="mt-1 block w-full px-4 py-3 bg-gray-100 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-violet-500 focus:border-violet-500 sm:text-sm">
                        </div>
                    </div>

                    <div class="flex justify-end mt-8">
                        <button type="submit" class="inline-flex items-center bg-violet-600 text-white font-semibold py-2 px-5 rounded-xl hover:bg-violet-700 transition duration-300 shadow-md">
                            <span class="material-icons mr-2">lock</span>
                            Ubah Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection