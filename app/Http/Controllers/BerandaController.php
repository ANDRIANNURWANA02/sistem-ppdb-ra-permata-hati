<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Auth;

class BerandaController extends Controller
{
   public function index()
    {
        // Ambil data pendaftaran milik user
        $user = Auth::user();
        $pendaftaran = Pendaftaran::where('user_id', $user->id)->first();

        return view('user.beranda', compact('user', 'pendaftaran'));
    }
}
