<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Perjalanan Dinas - @yield('title')</title>
    
    <!-- Material Design Lite -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
    
    <!-- Custom CSS -->
    <style>
        .demo-layout-waterfall .mdl-layout__header-row .mdl-navigation__link:last-of-type  {
            padding-right: 0;
        }
        
        .status-pending {
            color: #ff9800;
            font-weight: bold;
        }
        
        .status-approved {
            color: #4caf50;
            font-weight: bold;
        }
        
        .status-rejected {
            color: #f44336;
            font-weight: bold;
        }
        
        .card-wide.mdl-card {
            width: 100%;
            margin-bottom: 20px;
        }
        
        .card-wide > .mdl-card__title {
            color: #fff;
            height: 176px;
            background: #3f51b5;
        }
        
        .card-wide > .mdl-card__menu {
            color: #fff;
        }
        
        .page-content {
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .mdl-data-table {
            width: 100%;
        }
        
        .alert {
            padding: 10px 15px;
            margin-bottom: 15px;
            border-radius: 2px;
        }
        
        .alert-success {
            background-color: #dff0d8;
            color: #3c763d;
            border: 1px solid #d6e9c6;
        }
        
        .alert-error {
            background-color: #f2dede;
            color: #a94442;
            border: 1px solid #ebccd1;
        }
        
        .alert-info {
            background-color: #d9edf7;
            color: #31708f;
            border: 1px solid #bce8f1;
        }
        
        .form-row {
            margin-bottom: 15px;
        }
        
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: #f5f5f5;
        }
        
        .login-card {
            width: 400px;
        }
        
        .register-container {
            background: #f5f5f5;
            padding: 20px 0;
        }
        
        .biaya-row {
            margin-bottom: 15px;
            padding: 15px;
            border: 1px solid #eee;
            border-radius: 4px;
            position: relative;
        }
        
        .remove-biaya {
            position: absolute;
            right: 10px;
            top: 10px;
            cursor: pointer;
            color: #f44336;
        }
        
        .dashboard-stats {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            flex: 1;
            min-width: 200px;
            padding: 20px;
            background: white;
            border-radius: 4px;
            box-shadow: 0 2px 2px 0 rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.2), 0 1px 5px 0 rgba(0,0,0,.12);
        }
        
        .stat-number {
            font-size: 24px;
            font-weight: bold;
            margin: 10px 0;
        }
        
        .stat-label {
            color: #757575;
        }
    </style>
    
    @yield('styles')
</head>
<body>
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
    @auth
    <header class="mdl-layout__header">
        <div class="mdl-layout__header-row">
            <span class="mdl-layout-title">Sistem Perjalanan Dinas</span>
            <div class="mdl-layout-spacer"></div>
            <nav class="mdl-navigation mdl-layout--large-screen-only">
                <a class="mdl-navigation__link" href="{{ route('dashboard') }}">Dashboard</a>
                
                @if(auth()->user()->role === 'admin')
                    <a class="mdl-navigation__link" href="{{ route('pegawai.index') }}">Kelola Pegawai</a>
                    <a class="mdl-navigation__link" href="{{ route('sppd.index') }}">Kelola SPPD</a>
                    <a class="mdl-navigation__link" href="{{ route('biaya.index') }}">Kelola Biaya</a>
                    <a class="mdl-navigation__link" href="{{ route('anggaran.index') }}">Kelola Anggaran</a>
                @else
                    <a class="mdl-navigation__link" href="{{ route('sppd.create') }}">Buat SPPD</a>
                    <a class="mdl-navigation__link" href="{{ route('sppd.index') }}">Status SPPD</a>
                    <a class="mdl-navigation__link" href="{{ route('laporan.index') }}">Laporan</a>
                @endif
                
                <a class="mdl-navigation__link" href="{{ route('profile') }}">Profil</a>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="mdl-navigation__link" style="background: none; border: none; cursor: pointer; font-family: 'Roboto', sans-serif;">Logout</button>
                </form>
            </nav>
        </div>
    </header>
    @endauth
    
    <main class="mdl-layout__content">
        <div class="page-content">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif
            
            @if(session('info'))
                <div class="alert alert-info">
                    {{ session('info') }}
                </div>
            @endif
            
            @yield('content')
        </div>
    </main>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Dynamic form for biaya
        document.getElementById('add-biaya')?.addEventListener('click', function() {
            const biayaContainer = document.getElementById('biaya-container');
            const index = biayaContainer.children.length;
            const template = `
                <div class="biaya-row">
                    <span class="remove-biaya" onclick="this.parentElement.remove()">×</span>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" name="jenis_biaya[]" required>
                        <label class="mdl-textfield__label">Jenis Biaya</label>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="number" name="jumlah_biaya[]" step="0.01" required>
                        <label class="mdl-textfield__label">Jumlah Biaya</label>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <textarea class="mdl-textfield__input" name="keterangan_biaya[]" rows="2"></textarea>
                        <label class="mdl-textfield__label">Keterangan</label>
                    </div>
                </div>
            `;
            
            const div = document.createElement('div');
            div.innerHTML = template;
            biayaContainer.appendChild(div.firstElementChild);
            
            // Re-initialize MDL components
            componentHandler.upgradeAllRegistered();
        });
    });
</script>

@yield('scripts')
</body>
</html>