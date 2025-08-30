@extends('layouts.app')

@section('title', 'Kelola Biaya')

@section('content')
<div class="min-h-screen bg-violet-50 p-4 sm:p-6 lg:p-8">
    <div class="max-w-7xl mx-auto">
        <h2 class="text-3xl font-bold text-[#6750A4] mb-6">Daftar Pengajuan Biaya</h2>

        @if($biayas->count() > 0)
            <div class="bg-white rounded-2xl shadow-lg overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pegawai</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Biaya</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($biayas as $index => $biaya)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $biaya->laporan->sppd->user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $biaya->jenis_biaya }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Rp {{ number_format($biaya->jumlah, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $biaya->keterangan ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                @if($biaya->status == 'approved')
                                    <span class="px-3 py-1 text-sm font-semibold text-green-800 bg-green-100 rounded-full">Disetujui</span>
                                @elseif($biaya->status == 'rejected')
                                    <span class="px-3 py-1 text-sm font-semibold text-red-800 bg-red-100 rounded-full">Ditolak</span>
                                @else
                                    <span class="px-3 py-1 text-sm font-semibold text-yellow-800 bg-yellow-100 rounded-full">Menunggu</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('biaya.show', $biaya->id) }}" class="text-blue-600 hover:text-blue-900">
                                        <span class="material-icons">visibility</span>
                                    </a>
                                    @if($biaya->status === 'pending')
                                        <form action="{{ route('biaya.approve', $biaya->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            <button type="submit" class="text-green-600 hover:text-green-900">
                                                <span class="material-icons">check_circle</span>
                                            </button>
                                        </form>
                                        <button class="text-red-600 hover:text-red-900 reject-btn" data-biaya-id="{{ $biaya->id }}">
                                            <span class="material-icons">cancel</span>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @if($biaya->status === 'pending')
                        <tr id="reject-form-{{ $biaya->id }}" class="hidden">
                            <td colspan="7" class="p-4 bg-gray-50">
                                <form action="{{ route('biaya.reject', $biaya->id) }}" method="POST">
                                    @csrf
                                    <h4 class="text-lg font-medium text-[#6750A4] mb-2">Alasan Penolakan</h4>
                                    <textarea name="keterangan" rows="3" required
                                              class="appearance-none rounded-xl relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-[#6750A4] focus:outline-none focus:ring-violet-500 focus:border-violet-500 sm:text-sm"
                                              placeholder="Masukkan alasan penolakan..."></textarea>
                                    <div class="flex justify-end mt-2">
                                        <button type="submit" class="inline-flex items-center bg-red-600 text-white font-semibold py-2 px-4 rounded-xl hover:bg-red-700 transition duration-300">
                                            Submit Penolakan
                                        </button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="bg-white rounded-2xl shadow-lg p-8 text-center">
                <p class="text-lg text-[#6750A4]">Belum ada pengajuan biaya.</p>
            </div>
        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const rejectButtons = document.querySelectorAll('.reject-btn');
        
        rejectButtons.forEach(button => {
            button.addEventListener('click', function() {
                const biayaId = this.getAttribute('data-biaya-id');
                const rejectForm = document.getElementById('reject-form-' + biayaId);
                
                rejectForm.classList.toggle('hidden');
            });
        });
    });
</script>
@endsection