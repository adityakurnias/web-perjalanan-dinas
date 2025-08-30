@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    @if(auth()->user()->role === 'admin')
        @include('dashboard.admin', [
            'pendingUsers' => $pendingUsers,
            'pendingSPPDs' => $pendingSPPDs,
            'totalSPPDs' => $totalSPPDs,
            'totalAnggaran' => $totalAnggaran,
            'terpakaiAnggaran' => $terpakaiAnggaran,
        ])
    @else
        @include('dashboard.pegawai', [
            'totalSPPDs' => $totalSPPDs,
            'approvedSPPDs' => $approvedSPPDs,
            'sppds' => $sppds,
        ])
    @endif
@endsection