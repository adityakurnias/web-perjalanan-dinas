<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawais = User::with('pegawai')
            ->where('role', 'pegawai')
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('pegawai.index', compact('pegawais'));
    }

    public function create()
    {
        return view('pegawai.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:users|max:20',
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:8',
            'jabatan' => 'required',
            'departemen' => 'required',
            'no_telp' => 'required',
            'alamat' => 'required',
        ]);

        $user = User::create([
            'nik' => $request->nik,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pegawai',
            'status' => 'approved'
        ]);

        Pegawai::create([
            'user_id' => $user->id,
            'jabatan' => $request->jabatan,
            'departemen' => $request->departemen,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('pegawai.index')
            ->with('success', 'Pegawai berhasil ditambahkan.');
    }

    public function show($id)
    {
        $user = User::with('pegawai')->findOrFail($id);
        return view('pegawai.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::with('pegawai')->findOrFail($id);
        return view('pegawai.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $request->validate([
            'nik' => 'required|max:20|unique:users,nik,' . $user->id,
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'jabatan' => 'required',
            'departemen' => 'required',
            'no_telp' => 'required',
            'alamat' => 'required',
        ]);

        $user->update([
            'nik' => $request->nik,
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $user->pegawai->update([
            'jabatan' => $request->jabatan,
            'departemen' => $request->departemen,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('pegawai.index')
            ->with('success', 'Pegawai berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('pegawai.index')
            ->with('success', 'Pegawai berhasil dihapus.');
    }

    public function approve($id)
    {
        $user = User::findOrFail($id);
        $user->update(['status' => 'approved']);

        return redirect()->route('pegawai.index')
            ->with('success', 'Pegawai berhasil disetujui.');
    }

    public function reject($id)
    {
        $user = User::findOrFail($id);
        $user->update(['status' => 'rejected']);

        return redirect()->route('pegawai.index')
            ->with('success', 'Pegawai berhasil ditolak.');
    }
}