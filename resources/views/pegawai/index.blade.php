<!-- resources/views/pegawai/index.blade.php -->
@extends('layouts.app')

@section('title', 'Kelola Pegawai')

@section('content')
    <div class="bg-violet-50 min-h-screen p-4 sm:p-6 lg:p-8">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800">Daftar Pegawai</h2>
                    <p class="mt-1 text-sm text-gray-500">Kelola, setujui, dan lihat detail akun pegawai.</p>
                </div>
                <a href="{{ route('pegawai.create') }}"
                    class="mt-4 sm:mt-0 inline-flex items-center justify-center bg-[#6750A4] text-white font-semibold py-3 px-5 rounded-xl hover:bg-violet-700 transition duration-300 shadow-md">
                    <span class="material-icons mr-2">add</span>
                    Tambah Pegawai
                </a>
            </div>

            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="overflow-x-auto">
                    @if($pegawais->count() > 0)
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="py-3 px-6">No</th>
                                    <th scope="col" class="py-3 px-6">NIK</th>
                                    <th scope="col" class="py-3 px-6">Nama</th>
                                    <th scope="col" class="py-3 px-6">Email</th>
                                    <th scope="col" class="py-3 px-6">Jabatan</th>
                                    <th scope="col" class="py-3 px-6">Departemen</th>
                                    <th scope="col" class="py-3 px-6">Status</th>
                                    <th scope="col" class="py-3 px-6 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pegawais as $index => $user)
                                    <tr class="bg-white border-b hover:bg-gray-50">
                                        <td class="py-4 px-6">{{ $index + 1 }}</td>
                                        <td class="py-4 px-6 font-medium text-gray-900">{{ $user->nik }}</td>
                                        <td class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">{{ $user->name }}</td>
                                        <td class="py-4 px-6">{{ $user->email }}</td>
                                        <td class="py-4 px-6">{{ $user->pegawai->jabatan }}</td>
                                        <td class="py-4 px-6">{{ $user->pegawai->departemen }}</td>
                                        <td class="py-4 px-6">
                                            @if($user->status == 'approved')
                                                <span
                                                    class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">Disetujui</span>
                                            @elseif($user->status == 'rejected')
                                                <span
                                                    class="px-2 py-1 text-xs font-semibold text-red-800 bg-red-100 rounded-full">Ditolak</span>
                                            @else
                                                <span
                                                    class="px-2 py-1 text-xs font-semibold text-yellow-800 bg-yellow-100 rounded-full">Menunggu</span>
                                            @endif
                                        </td>
                                        <td class="py-4 px-6">
                                            <div class="flex items-center justify-center space-x-2">
                                                <a href="{{ route('pegawai.show', $user->id) }}"
                                                    class="p-2 text-gray-500 hover:text-blue-600 hover:bg-gray-100 rounded-full"
                                                    title="Lihat">
                                                    <span class="material-icons">visibility</span>
                                                </a>
                                                <a href="{{ route('pegawai.edit', $user->id) }}"
                                                    class="p-2 text-gray-500 hover:text-yellow-600 hover:bg-gray-100 rounded-full"
                                                    title="Edit">
                                                    <span class="material-icons">edit</span>
                                                </a>
                                                @if($user->status === 'pending')
                                                    <form action="{{ route('pegawai.approve', $user->id) }}" method="POST"
                                                        class="inline-block">
                                                        @csrf
                                                        <button type="submit"
                                                            class="p-2 text-gray-500 hover:text-green-600 hover:bg-gray-100 rounded-full"
                                                            title="Setujui">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                                fill="currentColor">
                                                                <path fill-rule="evenodd"
                                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('pegawai.reject', $user->id) }}" method="POST"
                                                        class="inline-block">
                                                        @csrf
                                                        <button type="submit"
                                                            class="p-2 text-gray-500 hover:text-red-600 hover:bg-gray-100 rounded-full"
                                                            onclick="return confirm('Tolak akun pegawai ini?')" title="Tolak">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                                fill="currentColor">
                                                                <path fill-rule="evenodd"
                                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                @endif
                                                <form action="{{ route('pegawai.destroy', $user->id) }}" method="POST"
                                                    class="inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="p-2 text-gray-500 hover:text-red-600 hover:bg-gray-100 rounded-full"
                                                        onclick="return confirm('Hapus pegawai ini?')" title="Hapus">
                                                        <span class="material-icons">delete</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="text-center p-12">
                            <h3 class="text-lg font-medium text-gray-700">Belum Ada Pegawai</h3>
                            <p class="mt-1 text-sm text-gray-500">Anda belum menambahkan data pegawai. Silakan klik tombol di
                                atas untuk memulai.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection