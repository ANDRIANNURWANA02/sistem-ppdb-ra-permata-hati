<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\Models\Pendaftaran;

class AdminController extends Controller
{
     public function index(Request $request)
    {
        $pendaftarans = Pendaftaran::query()
            ->when($request->search, function ($query, $search) {
                $query->where('nama_lengkap', 'like', '%' . $search . '%');
            })
            ->when($request->jenis_kelamin, function ($query, $jenis_kelamin) {
                $query->where('jenis_kelamin', $jenis_kelamin);
            })
            ->when($request->agama, function ($query, $agama) {
                $query->where('agama', $agama);
            })
            ->orderBy('id', 'asc')
            ->get();

        return view('dashboard', compact('pendaftarans'));
    }

    public function exportCsv()
{
    $pendaftarans = Pendaftaran::all();
    $filename = 'data_pendaftaran_' . date('Y-m-d_H-i-s') . '.csv';

    $handle = fopen('php://output', 'w');
    ob_start();

    // Header kolom
    fputcsv($handle, [
        'ID', 'Nama Lengkap', 'Jenis Kelamin', 'Agama', 'Tempat Lahir', 'Tanggal Lahir', 
        'Alamat', 'Nama Ayah', 'Nama Ibu', 'Nomor HP', 'Tanggal Pendaftaran', 'status_verifikasi', 'catatan_admin'
    ]);

    // Isi data
    foreach ($pendaftarans as $p) {
        fputcsv($handle, [
            $p->id,
            $p->nama_lengkap,
            $p->jenis_kelamin,
            $p->agama,
            $p->tempat_lahir,
            $p->tanggal_lahir,
            $p->alamat,
            $p->nama_ayah,
            $p->nama_ibu,
            $p->nomor_hp,
            $p->status_verifikasi,
            $p->catatan_admin,
            $p->created_at,
        ]);
    }

    fclose($handle);
    $csv = ob_get_clean();

    return Response::make($csv, 200, [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="' . $filename . '"',
    ]);
    }

    public function show($id)
    {
    $pendaftaran = Pendaftaran::with('user')->findOrFail($id);

    return view('admin.pendaftaran.show', compact('pendaftaran'));
    }

    // ✅ Update status verifikasi
    public function verifikasi(Request $request, $id)
    {
        $request->validate([
        'status_verifikasi' => 'required|in:menunggu,lolos,perlu_perbaikan',
        'catatan_admin' => 'nullable|string'
    ]);


        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->update([
            'status_verifikasi' => $request->status_verifikasi,
            'catatan_admin' => $request->catatan_admin
        ]);

        return redirect()->back()->with('success', 'Status verifikasi berhasil diperbarui');
    }
}
