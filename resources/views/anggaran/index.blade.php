<!-- resources/views/anggaran/index.blade.php -->
@extends('layouts.app')

@section('title', 'Kelola Anggaran')

@section('content')
<div class="mdl-grid">
    <div class="mdl-cell mdl-cell--12-col">
        <h3>Daftar Anggaran</h3>
        
        <a href="{{ route('anggaran.create') }}" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
            <i class="material-icons">add</i> Tambah Anggaran
        </a>
        
        @if($anggarans->count() > 0)
            <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="width: 100%; margin-top: 20px;">
                <thead>
                    <tr>
                        <th class="mdl-data-table__cell--non-numeric">No</th>
                        <th class="mdl-data-table__cell--non-numeric">Tahun</th>
                        <th class="mdl-data-table__cell--non-numeric">Bulan</th>
                        <th class="mdl-data-table__cell--non-numeric">Jumlah Anggaran</th>
                        <th class="mdl-data-table__cell--non-numeric">Terpakai</th>
                        <th class="mdl-data-table__cell--non-numeric">Sisa</th>
                        <th class="mdl-data-table__cell--non-numeric">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($anggarans as $index => $anggaran)
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">{{ $index + 1 }}</td>
                        <td class="mdl-data-table__cell--non-numeric">{{ $anggaran->tahun }}</td>
                        <td class="mdl-data-table__cell--non-numeric">
                            @php
                                $months = [
                                    1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                                    5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                                    9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                                ];
                            @endphp
                            {{ $months[$anggaran->bulan] }}
                        </td>
                        <td class="mdl-data-table__cell--non-numeric">Rp {{ number_format($anggaran->jumlah, 0, ',', '.') }}</td>
                        <td class="mdl-data-table__cell--non-numeric">Rp {{ number_format($anggaran->terpakai, 0, ',', '.') }}</td>
                        <td class="mdl-data-table__cell--non-numeric">Rp {{ number_format($anggaran->sisa, 0, ',', '.') }}</td>
                        <td class="mdl-data-table__cell--non-numeric">
                            <a href="{{ route('anggaran.show', $anggaran->id) }}" class="mdl-button mdl-js-button mdl-button--icon">
                                <i class="material-icons">visibility</i>
                            </a>
                            <a href="{{ route('anggaran.edit', $anggaran->id) }}" class="mdl-button mdl-js-button mdl-button--icon">
                                <i class="material-icons">edit</i>
                            </a>
                            <form action="{{ route('anggaran.destroy', $anggaran->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="mdl-button mdl-js-button mdl-button--icon" onclick="return confirm('Hapus anggaran ini?')">
                                    <i class="material-icons">delete</i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Belum ada anggaran.</p>
        @endif
    </div>
</div>
@endsection