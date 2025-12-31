<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportController extends Controller
{
    public function excel()
    {
        $fileName = 'data_pendaftaran.csv';

        $response = new StreamedResponse(function () {
            $handle = fopen('php://output', 'w');

            // Header kolom
            fputcsv($handle, [
                'Nama Lengkap',
                'NISN',
                'Jenis Kelamin',
                'Asal Sekolah',
                'No HP',
                'Alamat'
            ]);

            // Data
            Pendaftaran::chunk(100, function ($data) use ($handle) {
                foreach ($data as $row) {
                    fputcsv($handle, [
                        $row->nama_lengkap,
                        $row->nisn,
                        $row->jenis_kelamin,
                        $row->asal_sekolah,
                        $row->no_hp,
                        $row->alamat
                    ]);
                }
            });

            fclose($handle);
        });

        return response()->streamDownload(function () use ($response) {
            $response->sendContent();
        }, $fileName, [
            'Content-Type' => 'text/csv',
        ]);
    }
}
