<?php

namespace App\Http\Controllers;

use App\Models\LaporanPerjalanan;
use App\Models\SPPD;
use App\Models\Biaya;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            $laporans = LaporanPerjalanan::with('sppd.user')
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $laporans = LaporanPerjalanan::whereHas('sppd', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('laporan.index', compact('laporans'));
    }

    public function create()
    {
        $user = Auth::user();
        $sppds = SPPD::where('user_id', $user->id)
            ->where('status', 'approved')
            ->whereDoesntHave('laporan')
            ->get();

        return view('laporan.create', compact('sppds'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sppd_id' => 'required|exists:s_p_p_d_s,id',
            'kegiatan' => 'required',
            'hasil' => 'required',
            'jenis_biaya' => 'required|array',
            'jenis_biaya.*' => 'required',
            'jumlah_biaya' => 'required|array',
            'jumlah_biaya.*' => 'required|numeric',
            'keterangan_biaya' => 'nullable|array',
        ]);

        $totalBiaya = array_sum($request->jumlah_biaya);

        $laporan = LaporanPerjalanan::create([
            'sppd_id' => $request->sppd_id,
            'kegiatan' => $request->kegiatan,
            'hasil' => $request->hasil,
            'total_biaya' => $totalBiaya,
        ]);

        foreach ($request->jenis_biaya as $index => $jenis) {
            Biaya::create([
                'laporan_id' => $laporan->id,
                'jenis_biaya' => $jenis,
                'jumlah' => $request->jumlah_biaya[$index],
                'keterangan' => $request->keterangan_biaya[$index] ?? null,
                'status' => 'pending',
            ]);
        }

        return redirect()->route('laporan.index')
            ->with('success', 'Laporan perjalanan berhasil dibuat.');
    }

    public function show($id)
    {
        $laporan = LaporanPerjalanan::with('sppd.user', 'biayas')->findOrFail($id);

        if (!Auth::user()->isAdmin() && $laporan->sppd->user_id !== Auth::id()) {
            abort(403);
        }

        return view('laporan.show', compact('laporan'));
    }

    public function edit($id)
    {
        $laporan = LaporanPerjalanan::with('sppd.user', 'biayas')->findOrFail($id);

        if (!Auth::user()->isAdmin() && $laporan->sppd->user_id !== Auth::id()) {
            abort(403);
        }

        return view('laporan.edit', compact('laporan'));
    }

    public function update(Request $request, $id)
    {
        $laporan = LaporanPerjalanan::findOrFail($id);

        if (!Auth::user()->isAdmin() && $laporan->sppd->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'kegiatan' => 'required',
            'hasil' => 'required',
        ]);

        $laporan->update($request->all());

        return redirect()->route('laporan.index')
            ->with('success', 'Laporan perjalanan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $laporan = LaporanPerjalanan::findOrFail($id);

        if (!Auth::user()->isAdmin() && $laporan->sppd->user_id !== Auth::id()) {
            abort(403);
        }

        $laporan->delete();

        return redirect()->route('laporan.index')
            ->with('success', 'Laporan perjalanan berhasil dihapus.');
    }

    public function export($id)
    {
        $laporan = LaporanPerjalanan::with('sppd.user', 'biayas')->findOrFail($id);

        if (!Auth::user()->isAdmin() && $laporan->sppd->user_id !== Auth::id()) {
            abort(403);
        }

        

        $pdf = PDF::loadView('laporan.export', compact('laporan'));

        return $pdf->download('laporan-perjalanan-' . $laporan->id . '.pdf');
    }
}