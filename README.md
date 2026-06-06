# KELAR.IN - Repository Tugas Akhir

### Anggota Kelompok 2
| NIM | Nama |
|-----|------|
| 251402003 | Hafiz Ahmad Aulia Situmeang |
| 251402009 | Eka Sirait |
| 251402032 | Muhammad Azizih |
| 251402060 | Deby Yasmin Nabila |
| 251402064 | Cellin Angela Simanungkalit |
| 251402121 | Debora Elsa Naomi Tampubolon |

### Mata Kuliah
Pemrograman Web Lanjut (PWL)

---

### Penjelasan Web
**KELAR.IN** (Sistem Manajemen Repositori Tugas Akhir) merupakan platform digital yang dirancang khusus untuk Universitas, gunanya untuk memfasilitasi pengelolaan, pengarsipan, dan publikasi skripsi mahasiswa secara terpusat. Sistem ini mengintegrasikan seluruh alur pemberkasan mulai dari tahap unggah dokumen oleh mahasiswa, verifikasi oleh operator program studi, hingga persetujuan akhir oleh Ketua Program Studi (Kaprodi), sehingga seluruh dokumen karya ilmiah dapat terdokumentasi dengan rapi dan aman.

Sistem ini memiliki fitur privasi dokumen yang memisahkan antara dokumen yang boleh diakses publik secara luas (Open Access) dan dokumen internal yang hanya boleh diakses oleh civitas akademika yang telah memiliki akun terdaftar.

---

### Role Pengguna
Sistem KELAR.IN memiliki empat tingkat hak akses utama:

#### 1. Mahasiswa
Fokus utama mahasiswa adalah mengunggah dokumen prasyarat dan file skripsi akhir.
- Mengunggah bukti kelulusan sidang (SKTL).
- Mengunggah file skripsi secara terpisah (Cover, Abstrak, Skripsi, tesis, disertasi Full Bab 1-5, Daftar Pustaka).
- Mengunggah file hasil cek kemiripan (Turnitin) untuk semua jenjang.
- Mengunggah file Jurnal Ilmiah tambahan (khusus mahasiswa jenjang S2 & S3).
- Memantau status pengajuan dokumen (Pending, Ditolak, Diverifikasi, atau Terpublikasi).
- Melakukan revisi/upload ulang jika dokumen ditolak oleh operator.

#### 2. Operator / Admin
Operator berfokus pada validasi dokumen dan administrasi pengguna.
- Membuat akun untuk mahasiswa (Fitur registrasi mandiri dinonaktifkan).
- Melakukan **Verifikasi Tahap 1**: Memeriksa keabsahan dokumen SKTL.
- Melakukan **Verifikasi Tahap 2**: Memeriksa kelengkapan file skripsi & pendukung (Cover, Abstrak, Skripsi, Dapus, Turnitin, serta Jurnal untuk S2/S3).
- Memberikan status penolakan dengan alasan yang jelas apabila file tidak memenuhi syarat.
- operator dapat melihat riwayat uplotan dari mahasiswa dan jurnal terpublis dan operator bisa menghapush jurnal yang sudah ter publis jika kaprodi tidak sengaja melakukan kesalahan pada saat approve tugas akhir mahasiswa 

#### 3. Ketua Program Studi (Kaprodi)
Kaprodi berperan sebagai pimpinan akademik yang memberikan izin publikasi.
- Memantau daftar skripsi yang telah lolos verifikasi operator.
- Memberikan persetujuan (*Approve*) akhir agar skripsi terpublikasi di repositori.
- Melihat statistik pengajuan.

#### 4. Publik / Pengunjung (Tanpa Login)
Pengguna luar yang ingin mencari referensi skripsi.
- Mencari skripsi berdasarkan filter Fakultas, Jurusan.
- Melihat detail skripsi.
- Hanya bisa melihat file pendukung (Cover, Abstrak, dan Daftar Pustaka) di browser secara langsung tanpa memiliki otorisasi untuk mengunduh (*download*) file utama skripsi.

---

### Fitur Utama

- **Pencarian Terstruktur**: Pengunjung dapat mencari dokumen secara cepat dengan menggunakan fitur *Search* maupun *Filter* (Berdasarkan Fakultas dan Jurusan) di halaman utama.
-Sistem menerapkan alur verifikasi ganda (Verifikasi SKTL -> Verifikasi File Skripsi) sebelum diajukan ke Kaprodi.
- **Progress Tracker**: Mahasiswa dapat memantau status pengajuan mereka melalui *Step Tracker* interaktif di Dashboard.
- **Secure File Access (RBAC)**: Pemisahan disk penyimpanan secara sistematis. File Skripsi, tesis, disertasi Lengkap (Bab 1-5) disimpan di folder `local/private` yang dikunci oleh otentikasi login, sedangkan file pendukung disimpan di `public`.
- **Dinamisasi Unggah Dokumen Sesuai Jenjang**: Form unggah secara otomatis mendeteksi jenjang studi mahasiswa. Mahasiswa S1 wajib mengunggah Cover, Abstrak, Skripsi, Dapus, dan Cek Turnitin. Mahasiswa S2 & S3 memiliki tambahan kolom wajib untuk mengunggah Jurnal Ilmiah.
- **Manajemen Penolakan Detail**: Operator dapat menolak pengajuan dengan memilih *kategori penolakan default* dari dropdown, serta memberikan *catatan instruksi spesifik/manual* agar mahasiswa tahu apa yang harus diperbaiki.

---

### Alur Kerja & Bisnis Proses (Business Process)

1. **Pendaftaran Akun Mahasiswa (Registrasi Tertutup)**:
   - Mahasiswa tidak dapat melakukan registrasi mandiri. Akun mahasiswa dibuat secara terpusat oleh **Operator Program Studi** melalui dashboard admin untuk menjamin validitas data mahasiswa yang terdaftar di fakultas tersebut.

2. **Pengunggahan Syarat Kelulusan Sidang (Upload SKTL)**:
   - Setelah masuk ke sistem, fitur pengunggahan file tugas akhir mahasiswa masih terkunci. 
   - Mahasiswa wajib memulai proses dengan mengunggah **Surat Keterangan Telah Lulus (SKTL)** beserta judul tugas akhir untuk divalidasi keabsahannya. Status pengajuan berubah menjadi `sktl_pending`.

3. **Verifikasi Tahap 1 (Validasi SKTL oleh Operator)**:
   - **Operator** memeriksa dokumen SKTL yang diunggah mahasiswa.
   - **Jika Ditolak (`sktl_rejected`)**: Operator memberikan kategori alasan penolakan (misal: "SKTL Buram/Tidak Terbaca", "SKTL Salah Dokumen") disertai catatan spesifik. Mahasiswa menerima notifikasi alasan penolakan dan harus mengunggah ulang dokumen SKTL yang benar.
   - **Jika Disetujui (`sktl_verified`)**: Status pengajuan diperbarui, dan akses pengunggahan berkas tugas akhir utama otomatis terbuka bagi mahasiswa.

4. **Pengunggahan Berkas Tugas Akhir (Upload File Mandiri Sesuai Jenjang)**:
   - Mahasiswa mengunggah berkas yang telah dipisah secara terstruktur:
     - **Semua Jenjang (S1, S2, S3)**:
       - File Sampul / Cover (PDF - Public Storage)
       - File Abstrak (PDF - Public Storage)
       - File Daftar Pustaka (PDF - Public Storage)
       - File Hasil Cek Kemiripan / Turnitin (PDF - Public Storage)
       - File Utama Tugas Akhir/Skripsi/Tesis/Disertasi Bab 1-5 (PDF - Local Secure/Private Storage)
     - **Khusus Jenjang S2 (Magister) & S3 (Doktor)**:
       - Wajib melampirkan file **Jurnal Ilmiah** tambahan (PDF - Public Storage).
   - Setelah diunggah, status berubah menjadi `files_pending`.

5. **Verifikasi Tahap 2 (Validasi Kelengkapan Berkas oleh Operator)**:
   - **Operator** mengunduh dan memeriksa kualitas serta kesesuaian berkas yang telah diunggah mahasiswa.
   - **Jika Ditolak (`files_rejected`)**: Operator menolak berkas dengan memilih alasan dari dropdown (misal: "Halaman ada yang hilang", "Hasil Turnitin di atas batas toleransi") beserta instruksi revisi manual. Mahasiswa harus mengunggah ulang revisi berkas yang bermasalah.
   - **Jika Disetujui (`files_verified` / `approved`)**: Berkas dinyatakan lengkap dan valid. Berkas diteruskan ke antrean persetujuan Ketua Program Studi.

6. **Persetujuan Akhir oleh Ketua Program Studi (Approval Kaprodi)**:
   - **Kaprodi** memeriksa antrean tugas akhir mahasiswa yang telah lolos verifikasi operator.
   - Kaprodi memberikan persetujuan akhir (*Approve*) melalui sistem untuk mengotorisasi penerbitan. Status diperbarui menjadi `published`.

7. **Publikasi Repositori & Hak Akses Publik**:
   - Karya ilmiah yang telah disetujui Kaprodi langsung tampil secara otomatis di halaman utama pencarian (Welcome Page) repositori.
   - Pengunjung umum (tanpa login) dapat mencari dan menyaring data berdasarkan Fakultas dan Jurusan, serta **hanya diizinkan melihat preview online** file Cover, Abstrak, dan Daftar Pustaka.
   - File utama tugas akhir (Bab 1-5) tetap terkunci dan hanya dapat diunduh oleh civitas akademika yang telah login ke dalam sistem.

---

### Catatan Refleksi & Revisi dari Dosen
Sistem KELAR.IN telah dibangun dengan menyesuaikan poin-poin revisi spesifik dari dosen pengampu:

1. **Pemisahan File Upload**: Proses upload skripsi tidak lagi digabung menjadi 1 file, melainkan diwajibkan untuk dipecah menjadi bagian-bagian terpisah: **Cover, Abstrak, Skripsi (Bab 1-5), dan Daftar Pustaka**.
2. **Pembatasan Hak Akses Publik**: Pengunjung atau pihak luar (tanpa login) hanya diberikan izin untuk melihat tiga file pendukung yaitu **Cover, Abstrak, dan Daftar Pustaka**. File inti skripsi (Bab 1-5) dikunci khusus untuk pengguna yang sudah login dan tidak dapat diunduh sembarangan.
3. **Filter Halaman Utama**: Pada halaman landing page, pencarian kini dilengkapi dengan fitur *Filter berdasarkan Fakultas dan Jurusan* untuk mempermudah pencarian karya ilmiah per bidang studi.
4. **Alur Validasi SKTL**: Fitur upload file skripsi dikunci. Syarat utama mahasiswa dapat mengupload file skripsinya adalah dengan membuktikan bahwa ia telah selesai sidang. Bukti tersebut dilakukan dengan tahapan **Upload SKTL** terlebih dahulu.
5. **Kategori Penolakan Terstruktur**: Saat operator melakukan penolakan (baik SKTL maupun File), sistem tidak lagi menggunakan form input alasan manual semata. Operator kini difasilitasi dengan **Dropdown Kategori Penolakan** bawaan (misal: "SKTL Tidak Valid", "File tidak lengkap", dll) untuk standarisasi, yang tetap dikombinasikan dengan **kolom ketik manual (catatan opsional)** untuk memberikan detail revision yang lebih mandiri dan spesifik.
6. **Validasi File & Tambahan Berdasarkan Jenjang (Turnitin & Jurnal)**: Semua jenjang diwajibkan melampirkan bukti Cek Turnitin. Khusus untuk mahasiswa jenjang Magister (S2) dan Doktor (S3), sistem secara otomatis mewajibkan unggahan tambahan berupa file Jurnal Ilmiah sebagai syarat publikasi tugas akhir.
