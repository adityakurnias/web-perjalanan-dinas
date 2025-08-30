@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="min-h-screen bg-violet-50 flex flex-col justify-center items-center p-4">
    <div class="max-w-4xl w-full mx-auto bg-white rounded-2xl shadow-lg p-8 space-y-8">
        <div class="text-center">
            <h2 class="text-4xl font-bold text-[#6750A4]">Registrasi Akun</h2>
            <p class="mt-2 text-sm text-[#6750A4]">Buat akun baru untuk memulai.</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-6">
                    <h3 class="text-2xl font-bold text-[#6750A4]">Data Akun</h3>
                    <div>
                        <label for="nik" class="sr-only">NIK</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="material-icons text-gray-400">badge</span>
                            </div>
                            <input id="nik" name="nik" type="text" required value="{{ old('nik') }}"
                                   class="appearance-none rounded-xl relative block w-full px-3 py-3 pl-10 border {{ $errors->has('nik') ? 'border-red-500' : 'border-gray-300' }} placeholder-gray-500 text-[#6750A4] focus:outline-none focus:ring-violet-500 focus:border-violet-500 sm:text-sm"
                                   placeholder="NIK">
                        </div>
                        @error('nik')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="name" class="sr-only">Nama Lengkap</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="material-icons text-gray-400">person</span>
                            </div>
                            <input id="name" name="name" type="text" required value="{{ old('name') }}"
                                   class="appearance-none rounded-xl relative block w-full px-3 py-3 pl-10 border {{ $errors->has('name') ? 'border-red-500' : 'border-gray-300' }} placeholder-gray-500 text-[#6750A4] focus:outline-none focus:ring-violet-500 focus:border-violet-500 sm:text-sm"
                                   placeholder="Nama Lengkap">
                        </div>
                        @error('name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="sr-only">Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="material-icons text-gray-400">mail</span>
                            </div>
                            <input id="email" name="email" type="email" autocomplete="email" required value="{{ old('email') }}"
                                   class="appearance-none rounded-xl relative block w-full px-3 py-3 pl-10 border {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }} placeholder-gray-500 text-[#6750A4] focus:outline-none focus:ring-violet-500 focus:border-violet-500 sm:text-sm"
                                   placeholder="Alamat Email">
                        </div>
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="sr-only">Password</label>
                        <div class="relative">
                             <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="material-icons text-gray-400">lock</span>
                            </div>
                            <input id="password" name="password" type="password" autocomplete="new-password" required
                                   class="appearance-none rounded-xl relative block w-full px-3 py-3 pl-10 border {{ $errors->has('password') ? 'border-red-500' : 'border-gray-300' }} placeholder-gray-500 text-[#6750A4] focus:outline-none focus:ring-violet-500 focus:border-violet-500 sm:text-sm"
                                   placeholder="Password">
                        </div>
                         @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="sr-only">Konfirmasi Password</label>
                        <div class="relative">
                             <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="material-icons text-gray-400">lock</span>
                            </div>
                            <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required
                                   class="appearance-none rounded-xl relative block w-full px-3 py-3 pl-10 border border-gray-300 placeholder-gray-500 text-[#6750A4] focus:outline-none focus:ring-violet-500 focus:border-violet-500 sm:text-sm"
                                   placeholder="Konfirmasi Password">
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <h3 class="text-2xl font-bold text-[#6750A4]">Data Pegawai</h3>
                    <div>
                        <label for="jabatan" class="sr-only">Jabatan</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="material-icons text-gray-400">work</span>
                            </div>
                            <input id="jabatan" name="jabatan" type="text" required value="{{ old('jabatan') }}"
                                   class="appearance-none rounded-xl relative block w-full px-3 py-3 pl-10 border {{ $errors->has('jabatan') ? 'border-red-500' : 'border-gray-300' }} placeholder-gray-500 text-[#6750A4] focus:outline-none focus:ring-violet-500 focus:border-violet-500 sm:text-sm"
                                   placeholder="Jabatan">
                        </div>
                        @error('jabatan')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="departemen" class="sr-only">Departemen</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="material-icons text-gray-400">business</span>
                            </div>
                            <input id="departemen" name="departemen" type="text" required value="{{ old('departemen') }}"
                                   class="appearance-none rounded-xl relative block w-full px-3 py-3 pl-10 border {{ $errors->has('departemen') ? 'border-red-500' : 'border-gray-300' }} placeholder-gray-500 text-[#6750A4] focus:outline-none focus:ring-violet-500 focus:border-violet-500 sm:text-sm"
                                   placeholder="Departemen">
                        </div>
                        @error('departemen')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="no_telp" class="sr-only">No. Telepon</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="material-icons text-gray-400">phone</span>
                            </div>
                            <input id="no_telp" name="no_telp" type="text" required value="{{ old('no_telp') }}"
                                   class="appearance-none rounded-xl relative block w-full px-3 py-3 pl-10 border {{ $errors->has('no_telp') ? 'border-red-500' : 'border-gray-300' }} placeholder-gray-500 text-[#6750A4] focus:outline-none focus:ring-violet-500 focus:border-violet-500 sm:text-sm"
                                   placeholder="No. Telepon">
                        </div>
                        @error('no_telp')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="alamat" class="sr-only">Alamat</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 top-3 pl-3 flex items-center pointer-events-none">
                                <span class="material-icons text-gray-400">home</span>
                            </div>
                            <textarea id="alamat" name="alamat" rows="3" required
                                      class="appearance-none rounded-xl relative block w-full px-3 py-3 pl-10 border {{ $errors->has('alamat') ? 'border-red-500' : 'border-gray-300' }} placeholder-gray-500 text-[#6750A4] focus:outline-none focus:ring-violet-500 focus:border-violet-500 sm:text-sm"
                                      placeholder="Alamat">{{ old('alamat') }}</textarea>
                        </div>
                        @error('alamat')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div>
                <button type="submit"
                        class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-semibold rounded-xl text-white bg-violet-600 hover:bg-violet-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-violet-500 transition duration-300">
                    Daftar
                </button>
            </div>
        </form>

        <div class="text-center text-sm text-[#6750A4]">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="font-medium text-violet-600 hover:text-violet-500">
                Login di sini
            </a>
        </div>
    </div>
</div>
@endsection