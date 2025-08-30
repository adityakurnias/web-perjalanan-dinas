@extends('layouts.app')

@section('title', 'Selamat Datang')

@section('content')
<div class="min-h-screen bg-violet-50 flex flex-col items-center justify-center p-4 sm:p-6 lg:p-8">
    <div class="max-w-4xl w-full text-center">
        <h1 class="text-5xl font-bold text-[#6750A4]">
            Sistem Perjalanan Dinas
        </h1>
        <p class="mt-4 text-lg text-[#6750A4]">
            Solusi terintegrasi untuk mengelola perjalanan dinas pegawai dengan efisien.
        </p>
        <div class="mt-10 flex justify-center gap-4">
            @guest
                <a href="{{ route('login') }}"
                   class="inline-flex items-center bg-violet-600 text-white font-semibold py-3 px-8 rounded-xl hover:bg-violet-700 transition duration-300 shadow-lg">
                    <span class="material-icons mr-2">login</span>
                    Login
                </a>
                <a href="{{ route('register') }}"
                   class="inline-flex items-center bg-white text-violet-600 font-semibold py-3 px-8 rounded-xl hover:bg-gray-100 transition duration-300 shadow-lg">
                    <span class="material-icons mr-2">person_add</span>
                    Register
                </a>
            @endguest
            @auth
                <a href="{{ route('dashboard') }}"
                   class="inline-flex items-center bg-violet-600 text-white font-semibold py-3 px-8 rounded-xl hover:bg-violet-700 transition duration-300 shadow-lg">
                    <span class="material-icons mr-2">dashboard</span>
                    Dashboard
                </a>
            @endauth
        </div>
    </div>
</div>
@endsection