<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Pendaftaran;

class ProfileController extends Controller
{
    /**
     * DASHBOARD USER
     */
    public function index()
    {
        $user = Auth::user();
        $pendaftaran = Pendaftaran::where('user_id', $user->id)->first();

        return view('profile.index', compact('user', 'pendaftaran'));
    }

    /**
     * EDIT PROFIL
     */
    public function edit()
    {
        return view('profile.edit', [
            'user' => Auth::user()
        ]);
    }

    /**
     * UPDATE PROFIL
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // ================= VALIDASI =================
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'new_password' => 'nullable|min:8|confirmed',
        ]);

        // ================= UPDATE DATA DASAR =================
        $user->name = $request->name;
        $user->email = $request->email;

        // ================= UPDATE PASSWORD (JIKA ADA) =================
        if ($request->filled('new_password')) {
            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui');
    }
}
