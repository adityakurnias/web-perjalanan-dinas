<?php

namespace App\Http\Controllers;

use App\Models\Anggaran;
use Illuminate\Http\Request;

class AnggaranController extends Controller
{
    public function index()
    {
        $anggarans = Anggaran::orderBy('tahun', 'desc')
            ->orderBy('bulan', 'desc')
            ->get();
        return view('anggaran.index', compact('anggarans'));
    }

    public function create()
    {
        return view('anggaran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun' => 'required|numeric',
            'bulan' => 'required',
            'jumlah' => 'required|numeric',
        ]);

        $existing = Anggaran::where('tahun', $request->tahun)
            ->where('bulan', $request->bulan)
            ->first();

        if ($existing) {
            return redirect()->back()
                ->with('error', 'Anggaran untuk bulan dan tahun tersebut sudah ada.')
                ->withInput();
        }

        Anggaran::create($request->all());

        return redirect()->route('anggaran.index')
            ->with('success', 'Anggaran berhasil ditambahkan.');
    }

    public function show($id)
    {
        $anggaran = Anggaran::findOrFail($id);
        return view('anggaran.show', compact('anggaran'));
    }

    public function edit($id)
    {
        $anggaran = Anggaran::findOrFail($id);
        return view('anggaran.edit', compact('anggaran'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tahun' => 'required|numeric',
            'bulan' => 'required',
            'jumlah' => 'required|numeric',
        ]);

        $anggaran = Anggaran::findOrFail($id);

        $existing = Anggaran::where('tahun', $request->tahun)
            ->where('bulan', $request->bulan)
            ->where('id', '!=', $id)
            ->first();

        if ($existing) {
            return redirect()->back()
                ->with('error', 'Anggaran untuk bulan dan tahun tersebut sudah ada.')
                ->withInput();
        }

        $anggaran->update($request->all());

        return redirect()->route('anggaran.index')
            ->with('success', 'Anggaran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $anggaran = Anggaran::findOrFail($id);
        $anggaran->delete();

        return redirect()->route('anggaran.index')
            ->with('success', 'Anggaran berhasil dihapus.');
    }
}