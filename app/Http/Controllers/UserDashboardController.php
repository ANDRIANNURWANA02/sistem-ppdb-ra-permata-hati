<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Pendaftaran; // model data pendaftaran kamu

class UserDashboardController extends Controller
{
    public function index()
    {
        // Ambil data pendaftaran milik user
        $user = Auth::user();
        $pendaftaran = Pendaftaran::where('user_id', $user->id)->first();

        return view('user.dashboard', compact('user', 'pendaftaran'));
    }
}
