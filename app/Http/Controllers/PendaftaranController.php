<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PendaftaranController extends Controller
{
    /**
     * Tampilkan form pendaftaran
     */
    public function index()
    {
        $user = auth()->user();

        // Cek apakah user sudah pernah daftar
        $pendaftaran = Pendaftaran::where('user_id', $user->id)->first();
        if ($pendaftaran) {
            return redirect()->route('user.dashboard')
                ->with('info', 'Anda sudah melakukan pendaftaran.');
        }

        return view('pendaftaran.index');
    }

    /**
     * Simpan data pendaftaran
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        // Batasi user hanya boleh daftar sekali
        if (Pendaftaran::where('user_id', $user->id)->exists()) {
            return redirect()->route('user.dashboard')
                ->with('error', 'Anda sudah melakukan pendaftaran.');
        }

        $validated = $request->validate([
            // Data Anak
            'nama_lengkap' => 'required|string|max:255',
            'nama_panggilan' => 'nullable|string|max:255',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'required',
            'agama' => 'nullable|string|max:50',
            'kewarganegaraan' => 'nullable|string|max:50',
            'anak_ke' => 'nullable|integer',
            'jumlah_saudara_kandung' => 'nullable|integer',
            'jumlah_saudara_tiri' => 'nullable|integer',
            'jumlah_saudara_angkat' => 'nullable|integer',
            'bahasa_sehari_hari' => 'nullable|string|max:50',
            'tinggi_badan' => 'nullable',
            'berat_badan' => 'nullable|numeric',
            'golongan_darah' => 'nullable|string|max:5',
            'riwayat_penyakit' => 'nullable|string|max:255',
            'imunisasi' => 'nullable|string|max:255',
            'ciri_khusus' => 'nullable|string|max:255',
            'makanan_kesukaan' => 'nullable|string|max:255',
            'minuman_kesukaan' => 'nullable|string|max:255',
            'buah_kesukaan' => 'nullable|string|max:255',
            'prestasi' => 'nullable|string|max:255',
            'alamat_lengkap' => 'nullable',

            // Data Ayah
            'nama_ayah' => 'nullable|string|max:255',
            'tempat_lahir_ayah' => 'nullable|string|max:255',
            'tanggal_lahir_ayah' => 'nullable|date',
            'agama_ayah' => 'nullable|string|max:50',
            'kewarganegaraan_ayah' => 'nullable|string|max:50',
            'pendidikan_terakhir_ayah' => 'nullable|string|max:100',
            'pekerjaan_ayah' => 'nullable|string|max:100',
            'pangkat_ayah' => 'nullable|string|max:50',
            'golongan_darah_ayah' => 'nullable|string|max:5',
            'penghasilan_ayah' => 'nullable|string|max:50',

            // Data Ibu
            'nama_ibu' => 'nullable|string|max:255',
            'tempat_lahir_ibu' => 'nullable|string|max:255',
            'tanggal_lahir_ibu' => 'nullable|date',
            'agama_ibu' => 'nullable|string|max:50',
            'kewarganegaraan_ibu' => 'nullable|string|max:50',
            'pendidikan_terakhir_ibu' => 'nullable|string|max:100',
            'pekerjaan_ibu' => 'nullable|string|max:100',
            'penghasilan_ibu' => 'nullable|string|max:50',

            // Lain-lain
            'kemampuan' => 'nullable|string|max:255',

            // File Upload (max 5MB)
            'file_kk' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'file_akte' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'file_surat_lain' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            
        ]);

        // Simpan file ke storage
        if ($request->hasFile('file_kk')) {
            $validated['file_kk'] = $request->file('file_kk')->store('uploads/kk', 'public');
        }
        if ($request->hasFile('file_akte')) {
            $validated['file_akte'] = $request->file('file_akte')->store('uploads/akte', 'public');
        }
        if ($request->hasFile('file_surat_lain')) {
            $validated['file_surat_lain'] = $request->file('file_surat_lain')->store('uploads/surat', 'public');
        }

        // Tambahkan user_id
        $validated['user_id'] = $user->id;

        // Simpan data ke database
        Pendaftaran::create($validated);

        // Redirect ke dashboard user
        return redirect()->route('user.dashboard')
            ->with('success', 'Pendaftaran berhasil dikirim!');
    }

    /**
     * Lihat semua data (untuk admin)
     */
    public function showAll()
    {
        $data = Pendaftaran::all();
        return view('home', compact('data'));
    }

    /**
     * Download file
     */
    public function download($jenis, $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);

        switch ($jenis) {
            case 'kk':
                $filePath = $pendaftaran->file_kk;
                break;
            case 'akte':
                $filePath = $pendaftaran->file_akte;
                break;
            case 'lain':
                $filePath = $pendaftaran->file_surat_lain;
                break;
            default:
                return redirect()->back()->with('error', 'Jenis file tidak valid.');
        }

        if (!$filePath || !Storage::disk('public')->exists($filePath)) {
            return redirect()->back()->with('error', 'File tidak ditemukan di server.');
        }

        $fileFullPath = storage_path('app/public/' . $filePath);
        $fileName = basename($filePath);

        return response()->download($fileFullPath, $fileName);
    }

    /**
     * Edit pendaftaran
     */
    public function edit($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        return view('pendaftaran.edit', compact('pendaftaran'));
    }

    /**
     * Update pendaftaran
     */
    public function update(Request $request, $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);

        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required',
            'alamat_lengkap' => 'required',
            'nama_ayah' => 'required',
            'nama_ibu' => 'required',
        ]);

        $pendaftaran->update($request->except(['file_kk', 'file_akte', 'file_surat_lain']));

        // Update file jika ada
        if ($request->hasFile('file_kk')) {
            $pendaftaran->file_kk = $request->file('file_kk')->store('uploads/kk', 'public');
        }
        if ($request->hasFile('file_akte')) {
            $pendaftaran->file_akte = $request->file('file_akte')->store('uploads/akte', 'public');
        }
        if ($request->hasFile('file_surat_lain')) {
            $pendaftaran->file_surat_lain = $request->file('file_surat_lain')->store('uploads/surat', 'public');
        }

        $pendaftaran->save();

        return redirect()->route('admin.dashboard')
            ->with('success', 'Data pendaftaran berhasil diperbarui.');
    }

    /**
     * Lihat detail pendaftaran
     */
    public function show($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        return view('pendaftaran.show', compact('pendaftaran'));
    }
    
    public function verifikasi(Request $request, $id)
    {
    $request->validate([
        'status_verifikasi' => 'required|in:lolos,perbaikan',
        'catatan_admin' => 'nullable|string'
    ]);

    $pendaftaran = Pendaftaran::findOrFail($id);

    $pendaftaran->update([
        'status_verifikasi' => $request->status_verifikasi,
        'catatan_admin' => $request->catatan_admin
    ]);

    return redirect()->route('user.beranda')
        ->with('success', 'Status pendaftaran berhasil diperbarui.');
    }

    public function editUser()
    {
    $pendaftaran = Pendaftaran::where('user_id', auth()->id())->firstOrFail();

    // ❌ jika sudah lolos, tidak boleh edit
    if ($pendaftaran->verifikasi === 'lolos') {
        return redirect()->route('user.beranda')
            ->with('error', 'Data sudah lolos dan tidak dapat diubah.');
    }

    return view('pendaftaran.edit', compact('pendaftaran'));
    }

    public function updateUser(Request $request)
    {
    $pendaftaran = Pendaftaran::where('user_id', auth()->id())->firstOrFail();

    if ($pendaftaran->verifikasi === 'lolos') {
        return redirect()->route('user.beranda');
    }

    $request->validate([
        'nama_lengkap' => 'required|string',
        'jenis_kelamin' => 'required',
        'tempat_lahir' => 'required',
        'tanggal_lahir' => 'required|date',
        'agama' => 'required',
        'alamat_lengkap' => 'required',
        'nama_ayah' => 'required',
        'nama_ibu' => 'required',
        // field lain
    ]);

    $pendaftaran->update($request->all());

     if ($request->hasFile('file_kk')) {
            $pendaftaran->file_kk = $request->file('file_kk')->store('uploads/kk', 'public');
        }
        if ($request->hasFile('file_akte')) {
            $pendaftaran->file_akte = $request->file('file_akte')->store('uploads/akte', 'public');
        }
        if ($request->hasFile('file_surat_lain')) {
            $pendaftaran->file_surat_lain = $request->file('file_surat_lain')->store('uploads/surat', 'public');
        }
    $pendaftaran->save();

    return redirect()->route('user.beranda')
        ->with('success', 'Data pendaftaran berhasil diperbarui.');
    }


}
