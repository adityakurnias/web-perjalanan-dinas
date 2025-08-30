@extends('layouts.app')

@section('title', 'Detail SPPD')

@section('content')
<div class="min-h-screen bg-violet-50 p-4 sm:p-6 lg:p-8">
    <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="p-8">
            <h2 class="text-3xl font-bold text-[#6750A4]">Detail SPPD</h2>
        </div>

        <div class="border-t border-gray-200 px-8 py-6">
            <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Pegawai</dt>
                    <dd class="mt-1 text-base font-semibold text-[#6750A4]">{{ $sppd->user->name }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">NIK</dt>
                    <dd class="mt-1 text-base font-semibold text-[#6750A4]">{{ $sppd->user->nik }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Tujuan</dt>
                    <dd class="mt-1 text-base font-semibold text-[#6750A4]">{{ $sppd->tujuan }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Status</dt>
                    <dd class="mt-1 text-base font-semibold">
                        @if($sppd->status == 'approved')
                            <span class="px-3 py-1 text-sm font-semibold text-green-800 bg-green-100 rounded-full">Disetujui</span>
                        @elseif($sppd->status == 'rejected')
                            <span class="px-3 py-1 text-sm font-semibold text-red-800 bg-red-100 rounded-full">Ditolak</span>
                        @else
                            <span class="px-3 py-1 text-sm font-semibold text-yellow-800 bg-yellow-100 rounded-full">Menunggu</span>
                        @endif
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Tanggal Berangkat</dt>
                    <dd class="mt-1 text-base font-semibold text-[#6750A4]">{{ $sppd->tanggal_berangkat->format('d/m/Y') }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Tanggal Kembali</dt>
                    <dd class="mt-1 text-base font-semibold text-[#6750A4]">{{ $sppd->tanggal_kembali->format('d/m/Y') }}</dd>
                </div>
                <div class="md:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">Keperluan</dt>
                    <dd class="mt-1 text-base text-[#6750A4] prose max-w-none">{{ $sppd->keperluan }}</dd>
                </div>
                @if($sppd->status == 'rejected' && $sppd->catatan_admin)
                <div class="md:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">Catatan Admin</dt>
                    <dd class="mt-1 text-base text-red-600 prose max-w-none">{{ $sppd->catatan_admin }}</dd>
                </div>
                @endif
            </dl>
        </div>

        @if(auth()->user()->role === 'admin' && $sppd->status === 'pending')
        <div class="border-t border-gray-200 bg-gray-50 px-8 py-6">
            <h3 class="text-xl font-bold text-[#6750A4] mb-4">Persetujuan Admin</h3>
            <div class="flex items-center space-x-4">
                <form action="{{ route('sppd.approve', $sppd->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="inline-flex items-center bg-green-600 text-white font-semibold py-2 px-4 rounded-xl hover:bg-green-700 transition duration-300">
                        <span class="material-icons mr-2">check_circle</span>
                        Setujui
                    </button>
                </form>
                <button id="reject-btn" class="inline-flex items-center bg-red-600 text-white font-semibold py-2 px-4 rounded-xl hover:bg-red-700 transition duration-300">
                    <span class="material-icons mr-2">cancel</span>
                    Tolak
                </button>
            </div>
            <form id="reject-form" action="{{ route('sppd.reject', $sppd->id) }}" method="POST" class="hidden mt-4">
                @csrf
                <div>
                    <label for="catatan_admin" class="block text-sm font-medium text-[#6750A4] mb-1">Alasan Penolakan</label>
                    <textarea id="catatan_admin" name="catatan_admin" rows="3" required
                              class="appearance-none rounded-xl relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-[#6750A4] focus:outline-none focus:ring-violet-500 focus:border-violet-500 sm:text-sm"
                              placeholder="Masukkan alasan penolakan..."></textarea>
                </div>
                <div class="flex justify-end mt-2">
                    <button type="submit" class="inline-flex items-center bg-red-600 text-white font-semibold py-2 px-4 rounded-xl hover:bg-red-700 transition duration-300">
                        Submit Penolakan
                    </button>
                </div>
            </form>
        </div>
        @endif

        @if($sppd->status === 'approved' && !$sppd->laporan && auth()->user()->id === $sppd->user_id)
        <div class="border-t border-gray-200 bg-gray-50 px-8 py-6">
            <a href="{{ route('laporan.create') }}?sppd_id={{ $sppd->id }}" class="inline-flex items-center bg-blue-600 text-white font-semibold py-2 px-5 rounded-xl hover:bg-blue-700 transition duration-300 shadow-md">
                <span class="material-icons mr-2">post_add</span>
                Buat Laporan Perjalanan
            </a>
        </div>
        @endif

        @if($sppd->laporan)
        <div class="border-t border-gray-200 bg-gray-50 px-8 py-6">
            <h3 class="text-xl font-bold text-[#6750A4] mb-4">Laporan Perjalanan</h3>
            <p class="text-sm text-[#6750A4] mb-4">Laporan untuk SPPD ini telah dibuat.</p>
            <a href="{{ route('laporan.show', $sppd->laporan->id) }}" class="inline-flex items-center bg-violet-600 text-white font-semibold py-2 px-5 rounded-xl hover:bg-violet-700 transition duration-300 shadow-md">
                <span class="material-icons mr-2">visibility</span>
                Lihat Laporan
            </a>
        </div>
        @endif

        <div class="bg-gray-50 px-8 py-4 flex items-center justify-end">
            <a href="{{ route('sppd.index') }}"
               class="bg-gray-200 text-gray-700 font-semibold py-2 px-5 rounded-xl hover:bg-gray-300 transition duration-300">
                Kembali
            </a>
        </div>
    </div>
</div>
@endsection

@if(auth()->user()->role === 'admin' && $sppd->status === 'pending')
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const rejectBtn = document.getElementById('reject-btn');
        const rejectForm = document.getElementById('reject-form');
        
        rejectBtn.addEventListener('click', function() {
            rejectForm.classList.toggle('hidden');
        });
    });
</script>
@endsection
@endif