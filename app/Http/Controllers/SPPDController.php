<?php

namespace App\Http\Controllers;

use App\Models\SPPD;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SPPDController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->isAdmin()) {
            $sppds = SPPD::with('user')->orderBy('created_at', 'desc')->get();
        } else {
            $sppds = SPPD::where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get();
        }
        
        return view('sppd.index', compact('sppds'));
    }

    public function create()
    {
        return view('sppd.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tujuan' => 'required',
            'tanggal_berangkat' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_berangkat',
            'keperluan' => 'required',
        ]);

        SPPD::create([
            'user_id' => Auth::id(),
            'tujuan' => $request->tujuan,
            'tanggal_berangkat' => $request->tanggal_berangkat,
            'tanggal_kembali' => $request->tanggal_kembali,
            'keperluan' => $request->keperluan,
            'status' => 'pending',
        ]);

        return redirect()->route('sppd.index')
            ->with('success', 'SPPD berhasil diajukan. Menunggu persetujuan admin.');
    }

    public function show($id)
    {
        $sppd = SPPD::with('user', 'laporan')->findOrFail($id);
        
        // Authorization check
        if (!Auth::user()->isAdmin() && $sppd->user_id !== Auth::id()) {
            abort(403);
        }
        
        return view('sppd.show', compact('sppd'));
    }

    public function edit($id)
    {
        $sppd = SPPD::findOrFail($id);
        
        // Authorization check
        if (!Auth::user()->isAdmin() && $sppd->user_id !== Auth::id()) {
            abort(403);
        }
        
        return view('sppd.edit', compact('sppd'));
    }

    public function update(Request $request, $id)
    {
        $sppd = SPPD::findOrFail($id);
        
        // Authorization check
        if (!Auth::user()->isAdmin() && $sppd->user_id !== Auth::id()) {
            abort(403);
        }
        
        $request->validate([
            'tujuan' => 'required',
            'tanggal_berangkat' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_berangkat',
            'keperluan' => 'required',
        ]);

        $sppd->update($request->all());

        return redirect()->route('sppd.index')
            ->with('success', 'SPPD berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $sppd = SPPD::findOrFail($id);
        
        // Authorization check
        if (!Auth::user()->isAdmin() && $sppd->user_id !== Auth::id()) {
            abort(403);
        }
        
        $sppd->delete();

        return redirect()->route('sppd.index')
            ->with('success', 'SPPD berhasil dihapus.');
    }

    public function approve($id)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }
        
        $sppd = SPPD::findOrFail($id);
        $sppd->update(['status' => 'approved']);

        return redirect()->route('sppd.index')
            ->with('success', 'SPPD berhasil disetujui.');
    }

    public function reject(Request $request, $id)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }
        
        $request->validate([
            'catatan_admin' => 'required',
        ]);
        
        $sppd = SPPD::findOrFail($id);
        $sppd->update([
            'status' => 'rejected',
            'catatan_admin' => $request->catatan_admin,
        ]);

        return redirect()->route('sppd.index')
            ->with('success', 'SPPD berhasil ditolak.');
    }
}