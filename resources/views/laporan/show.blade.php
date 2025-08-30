@extends('layouts.app')

@section('title', 'Detail Laporan')

@section('content')
<div class="min-h-screen bg-violet-50 p-4 sm:p-6 lg:p-8">
    <div class="max-w-6xl mx-auto bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="p-8">
            <h2 class="text-3xl font-bold text-[#6750A4]">Detail Laporan Perjalanan</h2>
        </div>

        <div class="border-t border-gray-200 px-8 py-6">
            <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Pegawai</dt>
                    <dd class="mt-1 text-base font-semibold text-[#6750A4]">{{ $laporan->sppd->user->name }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">NIK</dt>
                    <dd class="mt-1 text-base font-semibold text-[#6750A4]">{{ $laporan->sppd->user->nik }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Tujuan</dt>
                    <dd class="mt-1 text-base font-semibold text-[#6750A4]">{{ $laporan->sppd->tujuan }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Periode</dt>
                    <dd class="mt-1 text-base font-semibold text-[#6750A4]">
                        {{ $laporan->sppd->tanggal_berangkat->format('d/m/Y') }} - {{ $laporan->sppd->tanggal_kembali->format('d/m/Y') }}
                    </dd>
                </div>
                <div class="md:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">Kegiatan</dt>
                    <dd class="mt-1 text-base text-[#6750A4] prose max-w-none">{{ $laporan->kegiatan }}</dd>
                </div>
                <div class="md:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">Hasil</dt>
                    <dd class="mt-1 text-base text-[#6750A4] prose max-w-none">{{ $laporan->hasil }}</dd>
                </div>
                <div class="md:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">Total Biaya</dt>
                    <dd class="mt-1 text-xl font-bold text-green-600">Rp {{ number_format($laporan->total_biaya, 0, ',', '.') }}</dd>
                </div>
            </dl>
        </div>

        <div class="border-t border-gray-200 px-8 py-6">
            <h3 class="text-xl font-bold text-[#6750A4] mb-4">Detail Biaya</h3>
            <div class="bg-white rounded-2xl shadow-lg overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Biaya</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            @if(auth()->user()->role === 'admin')
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($laporan->biayas as $biaya)
                        <tr>
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
                            @if(auth()->user()->role === 'admin')
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                @if($biaya->status === 'pending')
                                <div class="flex items-center space-x-2">
                                    <form action="{{ route('biaya.approve', $biaya->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-green-600 hover:text-green-900">
                                            <span class="material-icons">check_circle</span>
                                        </button>
                                    </form>
                                    <button class="text-red-600 hover:text-red-900 reject-btn" data-biaya-id="{{ $biaya->id }}">
                                        <span class="material-icons">cancel</span>
                                    </button>
                                </div>
                                @endif
                            </td>
                            @endif
                        </tr>
                        @if(auth()->user()->role === 'admin' && $biaya->status === 'pending')
                        <tr id="reject-form-{{ $biaya->id }}" class="hidden">
                            <td colspan="5" class="p-4 bg-gray-50">
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
        </div>

        <div class="bg-gray-50 px-8 py-4 flex items-center justify-end space-x-4">
            <a href="{{ route('laporan.index') }}"
               class="bg-gray-200 text-gray-700 font-semibold py-2 px-5 rounded-xl hover:bg-gray-300 transition duration-300">
                Kembali
            </a>
            <a href="{{ route('laporan.export', $laporan->id) }}" target="_blank"
               class="inline-flex items-center bg-blue-600 text-white font-semibold py-2 px-5 rounded-xl hover:bg-blue-700 transition duration-300 shadow-md">
                <span class="material-icons mr-2">picture_as_pdf</span>
                Export PDF
            </a>
            @if(auth()->user()->role === 'admin' || auth()->user()->id === $laporan->sppd->user_id)
            <a href="{{ route('laporan.edit', $laporan->id) }}"
               class="inline-flex items-center bg-violet-600 text-white font-semibold py-2 px-5 rounded-xl hover:bg-violet-700 transition duration-300 shadow-md">
                <span class="material-icons mr-2">edit</span>
                Edit
            </a>
            @endif
        </div>
    </div>
</div>
@endsection

@if(auth()->user()->role === 'admin')
@section('scripts')
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
@endif