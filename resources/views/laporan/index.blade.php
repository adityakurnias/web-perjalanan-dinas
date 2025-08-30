@extends('layouts.app')

@section('title', 'Daftar Laporan')

@section('content')
    <div class="min-h-screen bg-violet-50 p-4 sm:p-6 lg:p-8">
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-3xl font-bold text-[#6750A4]">Daftar Laporan Perjalanan</h2>
                <a href="{{ route('laporan.create') }}"
                    class="inline-flex items-center bg-violet-600 text-white font-semibold py-2 px-5 rounded-xl hover:bg-violet-700 transition duration-300 shadow-md">
                    <span class="material-icons mr-2">post_add</span>
                    Buat Laporan Baru
                </a>
            </div>

            @if($laporans->count() > 0)
                <div class="bg-white rounded-2xl shadow-lg overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Pegawai</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tujuan</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tanggal</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total
                                    Biaya</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($laporans as $index => $laporan)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $laporan->sppd->user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $laporan->sppd->tujuan }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $laporan->created_at->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Rp
                                        {{ number_format($laporan->total_biaya, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('laporan.show', $laporan->id) }}"
                                                class="text-blue-600 hover:text-blue-900">
                                                <span class="material-icons">visibility</span>
                                            </a>
                                            @if(auth()->user()->role === 'admin' || auth()->user()->id === $laporan->sppd->user_id)
                                                <a href="{{ route('laporan.edit', $laporan->id) }}"
                                                    class="text-yellow-600 hover:text-yellow-900">
                                                    <span class="material-icons">edit</span>
                                                </a>
                                            @endif
                                            <form action="{{ route('laporan.destroy', $laporan->id) }}" method="POST"
                                                onsubmit="return confirm('Hapus laporan ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 cursor-pointer">
                                                    <span class="material-icons">delete</span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="bg-white rounded-2xl shadow-lg p-8 text-center">
                    <p class="text-lg text-[#6750A4]">Belum ada laporan yang dibuat.</p>
                </div>
            @endif
        </div>
    </div>
@endsection