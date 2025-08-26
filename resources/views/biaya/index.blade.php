<!-- resources/views/biaya/index.blade.php -->
@extends('layouts.app')

@section('title', 'Kelola Biaya')

@section('content')
<div class="mdl-grid">
    <div class="mdl-cell mdl-cell--12-col">
        <h3>Daftar Pengajuan Biaya</h3>
        
        @if($biayas->count() > 0)
            <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="width: 100%; margin-top: 20px;">
                <thead>
                    <tr>
                        <th class="mdl-data-table__cell--non-numeric">No</th>
                        <th class="mdl-data-table__cell--non-numeric">Pegawai</th>
                        <th class="mdl-data-table__cell--non-numeric">Jenis Biaya</th>
                        <th class="mdl-data-table__cell--non-numeric">Jumlah</th>
                        <th class="mdl-data-table__cell--non-numeric">Keterangan</th>
                        <th class="mdl-data-table__cell--non-numeric">Status</th>
                        <th class="mdl-data-table__cell--non-numeric">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($biayas as $index => $biaya)
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">{{ $index + 1 }}</td>
                        <td class="mdl-data-table__cell--non-numeric">{{ $biaya->laporan->sppd->user->name }}</td>
                        <td class="mdl-data-table__cell--non-numeric">{{ $biaya->jenis_biaya }}</td>
                        <td class="mdl-data-table__cell--non-numeric">Rp {{ number_format($biaya->jumlah, 0, ',', '.') }}</td>
                        <td class="mdl-data-table__cell--non-numeric">{{ $biaya->keterangan ?? '-' }}</td>
                        <td class="mdl-data-table__cell--non-numeric">
                            <span class="status-{{ $biaya->status }}">
                                @if($biaya->status == 'approved')
                                    Disetujui
                                @elseif($biaya->status == 'rejected')
                                    Ditolak
                                @else
                                    Menunggu
                                @endif
                            </span>
                        </td>
                        <td class="mdl-data-table__cell--non-numeric">
                            <a href="{{ route('biaya.show', $biaya->id) }}" class="mdl-button mdl-js-button mdl-button--icon">
                                <i class="material-icons">visibility</i>
                            </a>
                            @if($biaya->status === 'pending')
                                <form action="{{ route('biaya.approve', $biaya->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="mdl-button mdl-js-button mdl-button--icon">
                                        <i class="material-icons" style="color: #4CAF50;">check_circle</i>
                                    </button>
                                </form>
                                
                                <button class="mdl-button mdl-js-button mdl-button--icon reject-btn" data-biaya-id="{{ $biaya->id }}">
                                    <i class="material-icons" style="color: #F44336;">cancel</i>
                                </button>
                                
                                <form id="reject-form-{{ $biaya->id }}" action="{{ route('biaya.reject', $biaya->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                        <textarea class="mdl-textfield__input" name="keterangan" rows="2" required></textarea>
                                        <label class="mdl-textfield__label">Alasan Penolakan</label>
                                    </div>
                                    <button type="submit" class="mdl-button mdl-js-button mdl-button--raised" style="background-color: #F44336; color: white;">
                                        Submit Penolakan
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Belum ada pengajuan biaya.</p>
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
                
                if (rejectForm.style.display === 'none') {
                    rejectForm.style.display = 'block';
                } else {
                    rejectForm.style.display = 'none';
                }
            });
        });
    });
</script>
@endsection