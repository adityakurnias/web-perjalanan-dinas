<!-- resources/views/pegawai/show.blade.php -->
@extends('layouts.app')

@section('title', 'Detail Pegawai')

@section('content')
<div class="mdl-grid">
    <div class="mdl-cell mdl-cell--8-col mdl-cell--2-offset">
        <div class="mdl-card mdl-shadow--2dp card-wide">
            <div class="mdl-card__title">
                <h2 class="mdl-card__title-text">Detail Pegawai</h2>
            </div>
            <div class="mdl-card__supporting-text">
                <div class="mdl-grid">
                    <div class="mdl-cell mdl-cell--6-col">
                        <strong>NIK:</strong> {{ $user->nik }}
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <strong>Nama:</strong> {{ $user->name }}
                    </div>
                    
                    <div class="mdl-cell mdl-cell--6-col">
                        <strong>Email:</strong> {{ $user->email }}
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <strong>Status:</strong>
                        <span class="status-{{ $user->status }}">
                            @if($user->status == 'approved')
                                Disetujui
                            @elseif($user->status == 'rejected')
                                Ditolak
                            @else
                                Menunggu
                            @endif
                        </span>
                    </div>
                    
                    <div class="mdl-cell mdl-cell--6-col">
                        <strong>Jabatan:</strong> {{ $user->pegawai->jabatan }}
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <strong>Departemen:</strong> {{ $user->pegawai->departemen }}
                    </div>
                    
                    <div class="mdl-cell mdl-cell--6-col">
                        <strong>No. Telepon:</strong> {{ $user->pegawai->no_telp }}
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <strong>Alamat:</strong> {{ $user->pegawai->alamat }}
                    </div>
                </div>
                
                <div style="margin-top: 20px;">
                    <a href="{{ route('pegawai.edit', $user->id) }}" class="mdl-button mdl-js-button mdl-button--raised">
                        <i class="material-icons">edit</i> Edit
                    </a>
                    
                    <a href="{{ route('pegawai.index') }}" class="mdl-button mdl-js-button">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection