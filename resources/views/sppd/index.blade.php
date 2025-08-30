@extends('layouts.app')

@section('title', 'Kelola SPPD')

@section('content')
<div class="min-h-screen bg-violet-50 p-4 sm:p-6 lg:p-8">
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold text-[#6750A4]">Daftar SPPD</h2>
            @if(auth()->user()->role === 'pegawai')
                <a href="{{ route('sppd.create') }}"
                   class="inline-flex items-center bg-violet-600 text-white font-semibold py-2 px-5 rounded-xl hover:bg-violet-700 transition duration-300 shadow-md">
                    <span class="material-icons mr-2">add</span>
                    Ajukan SPPD Baru
                </a>
            @endif
        </div>

        @if($sppds->count() > 0)
            <div class="bg-white rounded-2xl shadow-lg overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pegawai</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tujuan</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tgl Berangkat</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tgl Kembali</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($sppds as $index => $sppd)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $sppd->user->name }}</td>
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
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('sppd.show', $sppd->id) }}" class="text-blue-600 hover:text-blue-900">
                                        <span class="material-icons">visibility</span>
                                    </a>
                                    @if(auth()->user()->role === 'admin' || (auth()->user()->role === 'pegawai' && $sppd->status === 'pending'))
                                        <a href="{{ route('sppd.edit', $sppd->id) }}" class="text-yellow-600 hover:text-yellow-900">
                                            <span class="material-icons">edit</span>
                                        </a>
                                    @endif
                                    @if(auth()->user()->role === 'admin')
                                        <form action="{{ route('sppd.destroy', $sppd->id) }}" method="POST" onsubmit="return confirm('Hapus SPPD ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">
                                                <span class="material-icons">delete</span>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="bg-white rounded-2xl shadow-lg p-8 text-center">
                <p class="text-lg text-[#6750A4]">Belum ada SPPD yang diajukan.</p>
            </div>
        @endif
    </div>
</div>
@endsection