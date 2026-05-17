# KELAR.IN Repository Tugas Akhir

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
**KELAR.IN** (Sistem Manajemen Repositori Tugas Akhir) merupakan platform digital yang dirancang khusus untuk Universitas, gunanya untuk  memfasilitasi pengelolaan, pengarsipan, dan publikasi skripsi mahasiswa secara terpusat. Sistem ini mengintegrasikan seluruh alur pemberkasan mulai dari tahap unggah dokumen oleh mahasiswa, verifikasi oleh operator program studi, hingga persetujuan akhir oleh Ketua Program Studi (Kaprodi), sehingga seluruh dokumen karya ilmiah dapat terdokumentasi dengan rapi dan aman.

Sistem ini memiliki fitur privasi dokumen yang memisahkan antara dokumen yang boleh diakses publik secara luas (Open Access) dan dokumen internal yang hanya boleh diakses oleh civitas akademika yang telah memiliki akun terdaftar.

---

### Role Pengguna
Sistem KELAR.IN memiliki empat tingkat hak akses utama:

#### 1. Mahasiswa
Fokus utama mahasiswa adalah mengunggah dokumen prasyarat dan file skripsi akhir.
- Mengunggah bukti kelulusan sidang (SKTL).
- Mengunggah file skripsi secara terpisah (Cover, Abstrak, Skripsi Full Bab 1-5, Daftar Pustaka).
- Memantau status pengajuan dokumen (Pending, Ditolak, Diverifikasi, atau Terpublikasi).
- Melakukan revisi/upload ulang jika dokumen ditolak oleh operator.

#### 2. Operator / Admin
Operator berfokus pada validasi dokumen dan administrasi pengguna.
- Membuat akun untuk mahasiswa (Fitur registrasi mandiri dinonaktifkan).
- Melakukan **Verifikasi Tahap 1**: Memeriksa keabsahan dokumen SKTL.
- Melakukan **Verifikasi Tahap 2**: Memeriksa kelengkapan file skripsi (Cover, Abstrak, Skripsi, Dapus).
- Memberikan status penolakan dengan alasan yang jelas apabila file tidak memenuhi syarat.

#### 3. Ketua Program Studi (Kaprodi)
Kaprodi berperan sebagai pimpinan akademik yang memberikan izin publikasi.
- Memantau daftar skripsi yang telah lolos verifikasi operator.
- Memberikan persetujuan (*Approve*) akhir agar skripsi terpublikasi di repositori.
- Melihat statistik pengajuan.

#### 4. Publik / Pengunjung (Tanpa Login)
Pengguna luar yang ingin mencari referensi skripsi.
- Mencari skripsi berdasarkan filter Fakultas, Jurusan, atau kata kunci.
- Melihat detail skripsi.
- Hanya bisa melihat(Cover, Abstrak, dan Daftar Pustaka) dan tidak bisa di downlot

---

### Fitur Utama

- **Pencarian Terstruktur**: Pengunjung dapat mencari dokumen secara cepat dengan menggunakan fitur *Search* maupun *Filter* (Berdasarkan Fakultas dan Jurusan) di halaman utama.
- **Two-Stage Verification Workflow**: Sistem menerapkan alur verifikasi ganda (Verifikasi SKTL -> Verifikasi File Skripsi) sebelum diajukan ke Kaprodi.
- **Progress Tracker**: Mahasiswa dapat memantau status pengajuan mereka melalui *Step Tracker* interaktif di Dashboard.
- **Secure File Access**: Pemisahan disk penyimpanan secara sistematis. File Skripsi Lengkap (Bab 1-5) disimpan di folder `local/private` yang dikunci oleh otentikasi login, sedangkan file pendukung disimpan di `public`.
- **Manajemen Penolakan Detail**: Operator dapat menolak pengajuan dengan memilih *kategori penolakan default* dari dropdown, serta memberikan *catatan instruksi spesifik/manual* agar mahasiswa tahu apa yang harus diperbaiki.

---

### Alur Kerja & Bisnis Proses (Business Process)

1. **Pembuatan Akun**: Mahasiswa tidak bisa mendaftar sendiri. Operator Prodi yang membuatkan akun semua mahasiswa yang lulus dari fakultasnya
2. **Syarat Awal (Upload SKTL)**: Mahasiswa yang telah selesai sidang wajib membuktikan kelulusannya dengan mengunggah **Surat Keterangan Telah Lulus (SKTL)** terlebih dahulu.
3. **Verifikasi SKTL**: Operator akan mengecek file SKTL. Jika valid, mahasiswa diizinkan melangkah ke tahap berikutnya. Jika tidak, operator akan menolak dan mahasiswa harus mengunggah ulang SKTL yang benar.
4. **Upload File Skripsi**: Setelah SKTL disetujui, mahasiswa diwajibkan mengunggah file skripsi yang **dipisah menjadi 4 bagian**:
   - File Sampul / Cover
   - File Abstrak
   - File Skripsi Lengkap (Bab 1,2,3,4,5)
   - File Daftar Pustaka
5. **Verifikasi File Skripsi**: Operator mengecek kembali ke-4 file tersebut. Apabila tidak lengkap atau ada indikasi masalah, operator dapat menolaknya dengan alasan spesifik.
6. **Persetujuan Kaprodi**: Jika operator menyetujui, dokumen akan masuk ke antrean Kaprodi. Kaprodi me-review dan menekan tombol *Approve*.
7. **Publikasi**: Setelah di-approve Kaprodi, skripsi resmi terpublikasi di halaman depan (Welcome Page) repositori.

---

### Catatan Refleksi & Revisi dari Dosen
Sistem KELAR.IN telah dibangun dengan menyesuaikan poin-poin revisi spesifik dari dosen pengampu:

1. **Pemisahan File Upload**: Proses upload skripsi tidak lagi digabung menjadi 1 file, melainkan diwajibkan untuk dipecah menjadi 4 bagian terpisah: **Cover, Abstrak, Skripsi (Bab 1-5), dan Daftar Pustaka**.
2. **Pembatasan Hak Akses Publik**: Pengunjung atau pihak luar (tanpa login) hanya diberikan izin untuk melihat tiga file pendukung yaitu **Cover, Abstrak, dan Daftar Pustaka**. File inti skripsi (Bab 1-5) dikunci khusus untuk pengguna yang sudah login.
3. **Filter Halaman Utama**: Pada halaman homepage, pencarian kini dilengkapi dengan fitur *Filter berdasarkan Fakultas dan Jurusan* untuk mempermudah pencarian karya ilmiah per bidang studi.
4. **Alur Validasi SKTL**: Fitur upload file skripsi dikunci. Syarat utama mahasiswa dapat mengupload file skripsinya adalah dengan membuktikan bahwa ia telah selesai sidang. Bukti tersebut dilakukan dengan tahapan **Upload SKTL** terlebih dahulu.
5. **Kategori Penolakan Terstruktur**: Saat operator melakukan penolakan (baik SKTL maupun File), sistem tidak lagi menggunakan form input alasan manual semata. Operator kini difasilitasi dengan **Dropdown Kategori Penolakan** bawaan (misal: "SKTL Tidak Valid", "File tidak lengkap", dll) untuk standarisasi, yang tetap dikombinasikan dengan **kolom ketik manual (catatan opsional)** untuk memberikan detail revisi yang lebih mandiri dan spesifik.
