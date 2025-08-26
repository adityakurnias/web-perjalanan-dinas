<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'current_password' => 'nullable|required_with:password',
            'password' => 'nullable|confirmed|min:8',
            'jabatan' => 'required',
            'departemen' => 'required',
            'no_telp' => 'required',
            'alamat' => 'required',
        ]);

        // Update user data
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Update password if provided
        if ($request->password) {
            if (!Hash::check($request->current_password, $user->password)) {
                return redirect()->back()
                    ->with('error', 'Password saat ini tidak valid.');
            }
            
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        // Update pegawai data
        $user->pegawai->update([
            'jabatan' => $request->jabatan,
            'departemen' => $request->departemen,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('profile')
            ->with('success', 'Profil berhasil diperbarui.');
    }
}