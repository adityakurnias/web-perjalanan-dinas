<!-- resources/views/pegawai/create.blade.php -->
@extends('layouts.app')

@section('title', 'Tambah Pegawai')

@section('content')
<div class="mdl-grid">
    <div class="mdl-cell mdl-cell--8-col mdl-cell--2-offset">
        <div class="mdl-card mdl-shadow--2dp card-wide">
            <div class="mdl-card__title">
                <h2 class="mdl-card__title-text">Tambah Pegawai Baru</h2>
            </div>
            <div class="mdl-card__supporting-text">
                <form method="POST" action="{{ route('pegawai.store') }}">
                    @csrf
                    
                    <div class="mdl-grid">
                        <div class="mdl-cell mdl-cell--6-col">
                            <h4>Data Akun</h4>
                            
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" type="text" id="nik" name="nik" value="{{ old('nik') }}" required>
                                <label class="mdl-textfield__label" for="nik">NIK</label>
                                @error('nik')
                                    <span class="mdl-textfield__error">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" type="text" id="name" name="name" value="{{ old('name') }}" required>
                                <label class="mdl-textfield__label" for="name">Nama Lengkap</label>
                                @error('name')
                                    <span class="mdl-textfield__error">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" type="email" id="email" name="email" value="{{ old('email') }}" required>
                                <label class="mdl-textfield__label" for="email">Email</label>
                                @error('email')
                                    <span class="mdl-textfield__error">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" type="password" id="password" name="password" required>
                                <label class="mdl-textfield__label" for="password">Password</label>
                                @error('password')
                                    <span class="mdl-textfield__error">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" type="password" id="password_confirmation" name="password_confirmation" required>
                                <label class="mdl-textfield__label" for="password_confirmation">Konfirmasi Password</label>
                            </div>
                        </div>
                        
                        <div class="mdl-cell mdl-cell--6-col">
                            <h4>Data Pegawai</h4>
                            
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" type="text" id="jabatan" name="jabatan" value="{{ old('jabatan') }}" required>
                                <label class="mdl-textfield__label" for="jabatan">Jabatan</label>
                                @error('jabatan')
                                    <span class="mdl-textfield__error">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" type="text" id="departemen" name="departemen" value="{{ old('departemen') }}" required>
                                <label class="mdl-textfield__label" for="departemen">Departemen</label>
                                @error('departemen')
                                    <span class="mdl-textfield__error">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" type="text" id="no_telp" name="no_telp" value="{{ old('no_telp') }}" required>
                                <label class="mdl-textfield__label" for="no_telp">No. Telepon</label>
                                @error('no_telp')
                                    <span class="mdl-textfield__error">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <textarea class="mdl-textfield__input" type="text" id="alamat" name="alamat" rows="3" required>{{ old('alamat') }}</textarea>
                                <label class="mdl-textfield__label" for="alamat">Alamat</label>
                                @error('alamat')
                                    <span class="mdl-textfield__error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                        Tambah Pegawai
                    </button>
                    
                    <a href="{{ route('pegawai.index') }}" class="mdl-button mdl-js-button">
                        Batal
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
