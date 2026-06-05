<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Jurusan;
use App\Models\Skripsi;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            FakultasJurusanSeeder::class,
        ]);

        $mahasiswaRole = Role::where('name', 'Mahasiswa')->first();
        $operatorRole = Role::where('name', 'Operator')->first();
        $kaprodiRole = Role::where('name', 'Kaprodi')->first();

        // ══════════════════════════════════════════════════════════════
        // 1. AMBIL JURUSAN & BUAT OPERATOR & KAPRODI DEFAULT
        // ══════════════════════════════════════════════════════════════
        $s1Ti = Jurusan::where('name', 'S1 Teknologi Informasi')->first();
        $s2Ti = Jurusan::where('name', 'S2 Teknik Informatika')->first();
        $s3Ik = Jurusan::where('name', 'S3 Ilmu Komputer')->first();

        $s1TiId = $s1Ti ? $s1Ti->id : null;
        $s2TiId = $s2Ti ? $s2Ti->id : null;
        $s3IkId = $s3Ik ? $s3Ik->id : null;

        // Operator & Kaprodi S1 TI
        User::factory()->create([
            'name' => 'Operator S1 IT',
            'email' => 'operator@example.com',
            'password' => bcrypt('password'),
            'role_id' => $operatorRole->id,
            'jurusan_id' => $s1TiId,
        ]);

        User::factory()->create([
            'name' => 'Kaprodi S1 IT',
            'email' => 'kaprodi@example.com',
            'password' => bcrypt('password'),
            'role_id' => $kaprodiRole->id,
            'jurusan_id' => $s1TiId,
        ]);

        // Operator & Kaprodi S2 TI
        User::factory()->create([
            'name' => 'Operator S2 IT',
            'email' => 'operator2@example.com',
            'password' => bcrypt('password'),
            'role_id' => $operatorRole->id,
            'jurusan_id' => $s2TiId,
        ]);

        User::factory()->create([
            'name' => 'Kaprodi S2 IT',
            'email' => 'kaprodi2@example.com',
            'password' => bcrypt('password'),
            'role_id' => $kaprodiRole->id,
            'jurusan_id' => $s2TiId,
        ]);

        // Operator & Kaprodi S3 Ilmu Komputer
        User::factory()->create([
            'name' => 'Operator S3 Ilmu Komputer',
            'email' => 'operator3@example.com',
            'password' => bcrypt('password'),
            'role_id' => $operatorRole->id,
            'jurusan_id' => $s3IkId,
        ]);

        User::factory()->create([
            'name' => 'Kaprodi S3 Ilmu Komputer',
            'email' => 'kaprodi3@example.com',
            'password' => bcrypt('password'),
            'role_id' => $kaprodiRole->id,
            'jurusan_id' => $s3IkId,
        ]);

        // ══════════════════════════════════════════════════════════════
        // 2. SEED MAHASISWA & DATA SKRIPSI (RIIL & NAMA ORANG INDONESIA)
        // ══════════════════════════════════════════════════════════════

        // --- DATA S1 TEKNOLOGI INFORMASI ---
        $s1Titles = [
            // Published (Terpublikasi)
            ['title' => 'Implementasi Machine Learning untuk Deteksi Anomali pada Sistem Jaringan', 'status' => 'published', 'student_name' => 'Aditya Pratama'],
            ['title' => 'Rancang Bangun Aplikasi E-Commerce Berbasis Microservices menggunakan Node.js', 'status' => 'published', 'student_name' => 'Rian Hidayat'],
            ['title' => 'Analisis Kinerja Protokol Routing AODV dan DSDV pada Mobile Ad-Hoc Network', 'status' => 'published', 'student_name' => 'Siti Aminah'],
            ['title' => 'Sistem Pendukung Keputusan Pemilihan Dosen Pembimbing Menggunakan Metode AHP', 'status' => 'published', 'student_name' => 'Budi Santoso'],
            ['title' => 'Penerapan Algoritma Convolutional Neural Network (CNN) untuk Klasifikasi Penyakit Daun Padi', 'status' => 'published', 'student_name' => 'Dewi Lestari'],
            ['title' => 'Sistem Pengenalan Wajah Secara Real-time Menggunakan OpenCV dan Algoritma Haar Cascade', 'status' => 'published', 'student_name' => 'Eko Prasetyo'],
            // Waiting Approval (Menunggu Persetujuan Kaprodi)
            ['title' => 'Analisis Keamanan Jaringan Nirkabel Menggunakan Metode Penetration Testing', 'status' => 'files_verified', 'student_name' => 'Larasati Putri'],
            ['title' => 'Pengembangan Chatbot Customer Service Menggunakan NLP dan Framework Rasa', 'status' => 'files_verified', 'student_name' => 'Fajar Nugroho'],
            ['title' => 'Sistem Monitoring Suhu dan Kelembaban Ruang Server Berbasis IoT Menggunakan ESP32', 'status' => 'files_verified', 'student_name' => 'Mega Utami'],
            // Waiting Verification from Operator (Menunggu Verifikasi Berkas)
            ['title' => 'Pengembangan Sistem Keamanan Autentikasi Dua Faktor Berbasis Biometrik', 'status' => 'files_pending', 'student_name' => 'Ferry Irawan'],
            // Rejected SKTL / Berkas
            ['title' => 'Penerapan Kriptografi AES dan RSA untuk Pengamanan Transmisi Data pada Aplikasi Chat', 'status' => 'files_rejected', 'rejection_cat' => 'Hasil Turnitin melebihi batas 25%', 'student_name' => 'Hendra Wijaya'],
            ['title' => 'Rancang Bangun Sistem Informasi Geografis Pemetaan Lokasi Rawan Banjir', 'status' => 'sktl_rejected', 'rejection_cat' => 'Dokumen SKTL buram/tidak terbaca', 'student_name' => 'Rina Wijaya'],
            // Draft & Pending
            ['title' => 'Rancang Bangun Smart Home System Menggunakan Protokol MQTT Berbasis Web', 'status' => 'draft', 'student_name' => 'Ahmad Hidayat'],
            ['title' => 'Analisis Pengaruh User Experience (UX) Terhadap Loyalitas Pengguna Aplikasi Mobile', 'status' => 'sktl_pending', 'student_name' => 'Muhammad Azizih'],
        ];

        // --- DATA S2 TEKNIK INFORMATIKA ---
        $s2Titles = [
            // Published
            ['title' => 'Optimasi Algoritma Klasifikasi Citra Medis Menggunakan Deep Learning dengan Transfer Learning', 'status' => 'published', 'student_name' => 'Irfan Maulana'],
            ['title' => 'Model Prediksi Penyebaran Penyakit Menular Menggunakan Analisis Spasial dan Big Data', 'status' => 'published', 'student_name' => 'Diana Puspita'],
            ['title' => 'Peningkatan Kinerja Query NoSQL Database Menggunakan Metode Hybrid Caching', 'status' => 'published', 'student_name' => 'Rizky Ramadhan'],
            // Waiting Approval
            ['title' => 'Analisis Sentimen Multi-bahasa Berbasis Deep Learning untuk Ulasan Produk E-Commerce', 'status' => 'files_verified', 'student_name' => 'Anisa Rahmawati'],
            ['title' => 'Rancang Bangun Arsitektur IoT Security Framework Berbasis Blockchain untuk Smart City', 'status' => 'files_verified', 'student_name' => 'Taufik Hidayat'],
            // Waiting Verification
            ['title' => 'Analisis Deteksi Deepfake Video Menggunakan Recurrent Neural Network', 'status' => 'files_pending', 'student_name' => 'Hendra Kurniawan'],
            // Rejected
            ['title' => 'Penerapan Deep Reinforcement Learning untuk Navigasi Robot Autonomous', 'status' => 'files_rejected', 'rejection_cat' => 'Format cover tidak sesuai panduan', 'student_name' => 'Putri Amelia'],
            // Draft
            ['title' => 'Analisis Sentimen Kebijakan Pemerintah Menggunakan Support Vector Machine', 'status' => 'draft', 'student_name' => 'Guntur Wibowo'],
        ];

        // --- DATA S3 ILMU KOMPUTER ---
        $s3Titles = [
            // Published
            ['title' => 'Kerangka Kerja Pengambilan Keputusan Strategis Berbasis Swarm Intelligence dan Multi-Agent Systems', 'status' => 'published', 'student_name' => 'Bambang Pamungkas'],
            ['title' => 'Model Keamanan Cloud Computing Berbasis Homomorphic Encryption dan Zero Trust Architecture', 'status' => 'published', 'student_name' => 'Sri Wahyuni'],
            // Waiting Approval
            ['title' => 'Teori Baru Optimasi Rantai Pasok Global Berbasis Algoritma Genetika Adaptif', 'status' => 'files_verified', 'student_name' => 'Joko Susilo'],
            // Waiting Verification
            ['title' => 'Formalisasi Matematika untuk Verifikasi Protokol Kriptografi Quantum', 'status' => 'files_pending', 'student_name' => 'Dewi Setyowati'],
            // Rejected
            ['title' => 'Evaluasi Kinerja Arsitektur Edge Computing pada Jaringan 5G Ultra-Reliable', 'status' => 'files_rejected', 'rejection_cat' => 'Daftar Pustaka tidak sesuai format', 'student_name' => 'Kartika Sari'],
        ];

        // Buat data untuk S1
        $this->seedDepartmentSkripsi($s1TiId, $mahasiswaRole->id, $s1Titles, 's1');
        // Buat data untuk S2
        $this->seedDepartmentSkripsi($s2TiId, $mahasiswaRole->id, $s2Titles, 's2');
        // Buat data untuk S3
        $this->seedDepartmentSkripsi($s3IkId, $mahasiswaRole->id, $s3Titles, 's3');
    }

    private function seedDepartmentSkripsi(?int $jurusanId, int $roleId, array $dataset, string $prefix): void
    {
        if (!$jurusanId) return;

        foreach ($dataset as $index => $data) {
            // 1. Acak tanggal di bulan Maret (3), April (4), atau Mei (5) tahun 2026
            $randomMonth = rand(3, 5);
            $randomDay = rand(1, 28);
            $randomHour = rand(8, 17); // Jam kerja biar riil
            $randomMinute = rand(0, 59);

            $createdAt = Carbon::create(2026, $randomMonth, $randomDay, $randomHour, $randomMinute, 0);
            $updatedAt = $createdAt->copy()->addDays(rand(1, 4))->addHours(rand(1, 5));

            // 2. Buat User Mahasiswa dengan tanggal pembuatan yang diacak juga
            $email = "mhs_" . str_replace(' ', '_', strtolower($data['student_name'])) . "@example.com";
            $student = User::factory()->create([
                'name' => $data['student_name'],
                'email' => $email,
                'password' => bcrypt('password'),
                'role_id' => $roleId,
                'jurusan_id' => $jurusanId,
                'created_at' => $createdAt,
                'updated_at' => $updatedAt,
            ]);

            // Tentukan status sktl & file berdasarkan status utama
            $sktlStatus = 'pending';
            $fileStatus = null;
            $rejectionCat = $data['rejection_cat'] ?? null;

            if ($data['status'] === 'published') {
                $sktlStatus = 'verified';
                $fileStatus = 'verified';
            } elseif ($data['status'] === 'files_verified') {
                $sktlStatus = 'verified';
                $fileStatus = 'verified';
            } elseif ($data['status'] === 'files_pending') {
                $sktlStatus = 'verified';
                $fileStatus = 'pending';
            } elseif ($data['status'] === 'files_rejected') {
                $sktlStatus = 'verified';
                $fileStatus = 'rejected';
            } elseif ($data['status'] === 'sktl_rejected') {
                $sktlStatus = 'rejected';
                $fileStatus = null;
            } elseif ($data['status'] === 'sktl_pending') {
                $sktlStatus = 'pending';
                $fileStatus = null;
            } elseif ($data['status'] === 'draft') {
                $sktlStatus = 'pending';
                $fileStatus = null;
            }

            // 3. Simpan data skripsi dengan tanggal yang sesuai
            $jurusan = Jurusan::find($jurusanId);
            $jenjang = $jurusan->jenjang ?? 'S1';
            $prefix = ($jenjang === 'S1') ? 's1_' : 's2_';

            Skripsi::create([
                'user_id' => $student->id,
                'jurusan_id' => $jurusanId,
                'title' => $data['title'],
                
                // SKTL (diisi jika bukan draft)
                'sktl_file_path' => ($data['status'] !== 'draft') ? "uploads/sktl/{$prefix}sktl_sample.pdf" : null,
                'sktl_status' => $sktlStatus,
                'sktl_rejection_category' => $sktlStatus === 'rejected' ? $rejectionCat : null,
                'sktl_rejection_notes' => $sktlStatus === 'rejected' ? 'Mohon unggah dokumen SKTL resmi yang ditandatangani.' : null,
                
                // File-file Skripsi (diisi jika fileStatus tidak null)
                'cover_file_path' => $fileStatus ? "uploads/cover/{$prefix}cover_sample.pdf" : null,
                'abstrak_file_path' => $fileStatus ? "uploads/abstrak/{$prefix}abstrak_sample.pdf" : null,
                'skripsi_file_path' => $fileStatus ? "uploads/skripsi/{$prefix}skripsi_sample.pdf" : null,
                'daftar_pustaka_file_path' => $fileStatus ? "uploads/daftar_pustaka/{$prefix}daftar_pustaka_sample.pdf" : null,
                'jurnal_file_path' => ($fileStatus && ($jenjang === 'S2' || $jenjang === 'S3')) ? "uploads/jurnal/{$prefix}jurnal_sample.pdf" : null,
                'turnitin_file_path' => $fileStatus ? "uploads/turnitin/{$prefix}turnitin_sample.pdf" : null,
                
                // File Status
                'file_status' => $fileStatus,
                'file_rejection_category' => $fileStatus === 'rejected' ? $rejectionCat : null,
                'file_rejection_notes' => $fileStatus === 'rejected' ? 'Berkas Anda ditolak karena alasan kategori tersebut. Harap perbaiki dokumen Anda.' : null,
                
                // Status Utama
                'status' => $data['status'],
                
                'created_at' => $createdAt,
                'updated_at' => $updatedAt,
            ]);
        }
    }
}
