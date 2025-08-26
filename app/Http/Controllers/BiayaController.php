<?php

namespace App\Http\Controllers;

use App\Models\Biaya;
use App\Models\Anggaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BiayaController extends Controller
{
    public function index()
    {
        $biayas = Biaya::with('laporan.sppd.user')
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('biaya.index', compact('biayas'));
    }

    public function show($id)
    {
        $biaya = Biaya::with('laporan.sppd.user')->findOrFail($id);
        return view('biaya.show', compact('biaya'));
    }

    public function approve($id)
    {
        DB::beginTransaction();
        
        try {
            $biaya = Biaya::with('laporan')->findOrFail($id);
            $biaya->update(['status' => 'approved']);
            
            // Update anggaran terpakai
            $currentMonth = now()->format('n');
            $currentYear = now()->format('Y');
            
            $anggaran = Anggaran::where('bulan', $currentMonth)
                ->where('tahun', $currentYear)
                ->first();
                
            if ($anggaran) {
                $anggaran->update([
                    'terpakai' => $anggaran->terpakai + $biaya->jumlah
                ]);
            }
            
            DB::commit();
            
            return redirect()->route('biaya.index')
                ->with('success', 'Biaya berhasil disetujui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('biaya.index')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'keterangan' => 'required',
        ]);
        
        $biaya = Biaya::findOrFail($id);
        $biaya->update([
            'status' => 'rejected',
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('biaya.index')
            ->with('success', 'Biaya berhasil ditolak.');
    }
}