<!-- resources/views/sppd/index.blade.php -->
@extends('layouts.app')

@section('title', 'Kelola SPPD')

@section('content')
<div class="mdl-grid">
    <div class="mdl-cell mdl-cell--12-col">
        <h3>Daftar SPPD</h3>
        
        @if(auth()->user()->role === 'pegawai')
            <a href="{{ route('sppd.create') }}" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                <i class="material-icons">add</i> Ajukan SPPD Baru
            </a>
        @endif
        
        @if($sppds->count() > 0)
            <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="width: 100%; margin-top: 20px;">
                <thead>
                    <tr>
                        <th class="mdl-data-table__cell--non-numeric">No</th>
                        <th class="mdl-data-table__cell--non-numeric">Pegawai</th>
                        <th class="mdl-data-table__cell--non-numeric">Tujuan</th>
                        <th>Tanggal Berangkat</th>
                        <th>Tanggal Kembali</th>
                        <th class="mdl-data-table__cell--non-numeric">Status</th>
                        <th class="mdl-data-table__cell--non-numeric">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sppds as $index => $sppd)
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">{{ $index + 1 }}</td>
                        <td class="mdl-data-table__cell--non-numeric">{{ $sppd->user->name }}</td>
                        <td class="mdl-data-table__cell--non-numeric">{{ $sppd->tujuan }}</td>
                        <td>{{ $sppd->tanggal_berangkat->format('d/m/Y') }}</td>
                        <td>{{ $sppd->tanggal_kembali->format('d/m/Y') }}</td>
                        <td class="mdl-data-table__cell--non-numeric">
                            <span class="status-{{ $sppd->status }}">
                                @if($sppd->status == 'approved')
                                    Disetujui
                                @elseif($sppd->status == 'rejected')
                                    Ditolak
                                @else
                                    Menunggu
                                @endif
                            </span>
                        </td>
                        <td class="mdl-data-table__cell--non-numeric">
                            <a href="{{ route('sppd.show', $sppd->id) }}" class="mdl-button mdl-js-button mdl-button--icon">
                                <i class="material-icons">visibility</i>
                            </a>
                            @if(auth()->user()->role === 'admin' || (auth()->user()->role === 'pegawai' && $sppd->status === 'pending'))
                                <a href="{{ route('sppd.edit', $sppd->id) }}" class="mdl-button mdl-js-button mdl-button--icon">
                                    <i class="material-icons">edit</i>
                                </a>
                            @endif
                            @if(auth()->user()->role === 'admin')
                                <form action="{{ route('sppd.destroy', $sppd->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="mdl-button mdl-js-button mdl-button--icon" onclick="return confirm('Hapus SPPD ini?')">
                                        <i class="material-icons">delete</i>
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Belum ada SPPD.</p>
        @endif
    </div>
</div>
@endsection