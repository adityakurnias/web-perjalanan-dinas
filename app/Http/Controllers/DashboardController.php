<?php

namespace App\Http\Controllers;

use App\Models\SPPD;
use App\Models\User;
use App\Models\LaporanPerjalanan;
use App\Models\Anggaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->isAdmin()) {
            $pendingUsers = User::where('status', 'pending')->count();
            $pendingSPPDs = SPPD::where('status', 'pending')->count();
            $totalSPPDs = SPPD::count();
            $totalAnggaran = Anggaran::sum('jumlah');
            $terpakaiAnggaran = Anggaran::sum('terpakai');
            
            return view('dashboard.admin', compact(
                'pendingUsers', 
                'pendingSPPDs', 
                'totalSPPDs',
                'totalAnggaran',
                'terpakaiAnggaran'
            ));
        } else {
            $sppds = SPPD::where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();
                
            $totalSPPDs = SPPD::where('user_id', $user->id)->count();
            $approvedSPPDs = SPPD::where('user_id', $user->id)
                ->where('status', 'approved')
                ->count();
                
            return view('dashboard.pegawai', compact(
                'sppds', 
                'totalSPPDs', 
                'approvedSPPDs'
            ));
        }
    }
}