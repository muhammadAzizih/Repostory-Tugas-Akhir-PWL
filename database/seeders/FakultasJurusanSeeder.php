<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FakultasJurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'Fakultas Teknik' => ['S1 Teknologi Informasi', 'S2 Teknik Informatika', 'S3 Ilmu Komputer', 'Teknik Sipil', 'Teknik Elektro'],
            'Fakultas Ekonomi' => ['Manajemen', 'Akuntansi'],
            'Fakultas Hukum' => ['Ilmu Hukum'],
            'Fakultas FISIP' => ['Ilmu Komunikasi', 'Administrasi Negara'],
        ];

        foreach ($data as $fakultasName => $jurusans) {
            $fakultas = \App\Models\Fakultas::firstOrCreate(['name' => $fakultasName]);
            foreach ($jurusans as $jurusanName) {
                $jenjang = 'S1';
                if (str_starts_with($jurusanName, 'S2')) {
                    $jenjang = 'S2';
                } elseif (str_starts_with($jurusanName, 'S3')) {
                    $jenjang = 'S3';
                }
                $jurusan = \App\Models\Jurusan::firstOrNew([
                    'name' => $jurusanName,
                    'fakultas_id' => $fakultas->id
                ]);
                $jurusan->jenjang = $jenjang;
                $jurusan->save();
            }
        }
    }
}
