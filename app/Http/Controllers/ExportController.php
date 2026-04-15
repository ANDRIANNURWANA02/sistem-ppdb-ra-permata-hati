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
                'No',
                'Nama Lengkap',
                'NISN',
                'Jenis Kelamin',
                'Tempat Lahir',
                'Tanggal Lahir',
                'Agama',
                'Alamat Lengkap',
                'Nama Ayah',
                'Nama Ibu'
            ]);

            // Data
            Pendaftaran::chunk(100, function ($data) use ($handle) {
                foreach ($data as $row) {
                    fputcsv($handle, [
                        $row->id,
                        $row->nama_lengkap,
                        $row->nisn,
                        $row->jenis_kelamin,
                        $row->tempat_lahir,
                        $row->tanggal_lahir,
                        $row->agama,
                        $row->alamat_lengkap,
                        $row->nama_ayah,
                        $row->nama_ibu
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
