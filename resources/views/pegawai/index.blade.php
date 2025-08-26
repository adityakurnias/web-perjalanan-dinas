<!-- resources/views/pegawai/index.blade.php -->
@extends('layouts.app')

@section('title', 'Kelola Pegawai')

@section('content')
<div class="mdl-grid">
    <div class="mdl-cell mdl-cell--12-col">
        <h3>Daftar Pegawai</h3>
        
        <a href="{{ route('pegawai.create') }}" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
            <i class="material-icons">add</i> Tambah Pegawai
        </a>
        
        @if($pegawais->count() > 0)
            <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="width: 100%; margin-top: 20px;">
                <thead>
                    <tr>
                        <th class="mdl-data-table__cell--non-numeric">No</th>
                        <th class="mdl-data-table__cell--non-numeric">NIK</th>
                        <th class="mdl-data-table__cell--non-numeric">Nama</th>
                        <th class="mdl-data-table__cell--non-numeric">Email</th>
                        <th class="mdl-data-table__cell--non-numeric">Jabatan</th>
                        <th class="mdl-data-table__cell--non-numeric">Departemen</th>
                        <th class="mdl-data-table__cell--non-numeric">Status</th>
                        <th class="mdl-data-table__cell--non-numeric">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pegawais as $index => $user)
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">{{ $index + 1 }}</td>
                        <td class="mdl-data-table__cell--non-numeric">{{ $user->nik }}</td>
                        <td class="mdl-data-table__cell--non-numeric">{{ $user->name }}</td>
                        <td class="mdl-data-table__cell--non-numeric">{{ $user->email }}</td>
                        <td class="mdl-data-table__cell--non-numeric">{{ $user->pegawai->jabatan }}</td>
                        <td class="mdl-data-table__cell--non-numeric">{{ $user->pegawai->departemen }}</td>
                        <td class="mdl-data-table__cell--non-numeric">
                            <span class="status-{{ $user->status }}">
                                @if($user->status == 'approved')
                                    Disetujui
                                @elseif($user->status == 'rejected')
                                    Ditolak
                                @else
                                    Menunggu
                                @endif
                            </span>
                        </td>
                        <td class="mdl-data-table__cell--non-numeric">
                            <a href="{{ route('pegawai.show', $user->id) }}" class="mdl-button mdl-js-button mdl-button--icon">
                                <i class="material-icons">visibility</i>
                            </a>
                            <a href="{{ route('pegawai.edit', $user->id) }}" class="mdl-button mdl-js-button mdl-button--icon">
                                <i class="material-icons">edit</i>
                            </a>
                            @if($user->status === 'pending')
                                <form action="{{ route('pegawai.approve', $user->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="mdl-button mdl-js-button mdl-button--icon">
                                        <i class="material-icons" style="color: #4CAF50;">check_circle</i>
                                    </button>
                                </form>
                                <form action="{{ route('pegawai.reject', $user->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="mdl-button mdl-js-button mdl-button--icon" onclick="return confirm('Tolak akun pegawai ini?')">
                                        <i class="material-icons" style="color: #F44336;">cancel</i>
                                    </button>
                                </form>
                            @endif
                            <form action="{{ route('pegawai.destroy', $user->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="mdl-button mdl-js-button mdl-button--icon" onclick="return confirm('Hapus pegawai ini?')">
                                    <i class="material-icons">delete</i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Belum ada pegawai.</p>
        @endif
    </div>
</div>
@endsection