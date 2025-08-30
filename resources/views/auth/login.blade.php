@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="min-h-screen bg-violet-50 flex flex-col justify-center items-center p-4">
    <div class="max-w-md w-full mx-auto bg-white rounded-2xl shadow-lg p-8 space-y-8">
        <div class="text-center">
            <h2 class="text-4xl font-bold text-[#6750A4]">Login</h2>
            <p class="mt-2 text-sm text-[#6750A4]">Selamat datang kembali!</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

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
                    <input id="password" name="password" type="password" autocomplete="current-password" required
                           class="appearance-none rounded-xl relative block w-full px-3 py-3 pl-10 border {{ $errors->has('password') ? 'border-red-500' : 'border-gray-300' }} placeholder-gray-500 text-[#6750A4] focus:outline-none focus:ring-violet-500 focus:border-violet-500 sm:text-sm"
                           placeholder="Password">
                </div>
                 @error('password')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <button type="submit"
                        class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-semibold rounded-xl text-white bg-violet-600 hover:bg-violet-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-violet-500 transition duration-300">
                    Login
                </button>
            </div>
        </form>

        <div class="text-center text-sm text-[#6750A4]">
            Belum punya akun?
            <a href="{{ route('register') }}" class="font-medium text-violet-600 hover:text-violet-500">
                Daftar di sini
            </a>
        </div>
    </div>
</div>
@endsection