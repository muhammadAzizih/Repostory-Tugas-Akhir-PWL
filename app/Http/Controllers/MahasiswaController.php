<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $skripsi = $user->skripsi;
        return view('mahasiswa.dashboard', compact('user', 'skripsi'));
    }

    public function status()
    {
        $skripsi = auth()->user()->skripsi;
        return view('mahasiswa.status', compact('skripsi'));
    }

    public function createSktl()
    {
        $skripsi = auth()->user()->skripsi;
        if ($skripsi && $skripsi->sktl_status !== 'rejected') {
            return redirect()->route('mahasiswa.dashboard')->with('error', 'Anda sudah mengupload SKTL.');
        }
        $fakultas = \App\Models\Fakultas::all();
        $jurusans = \App\Models\Jurusan::all();
        return view('mahasiswa.upload-sktl', compact('fakultas', 'jurusans'));
    }

    public function storeSktl(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'sktl_file' => 'required|mimes:pdf|max:20480', // 20MB
        ]);

        $user = auth()->user();
        $path = $request->file('sktl_file')->storeAs('private/sktl/' . $user->id, 'sktl_' . time() . '.pdf', 'local');

        if ($user->skripsi) {
            $user->skripsi->update([
                'title' => $request->title,
                'jurusan_id' => $user->jurusan_id,
                'sktl_file_path' => $path,
                'sktl_status' => 'pending',
                'status' => 'sktl_pending'
            ]);
        } else {
            \App\Models\Skripsi::create([
                'user_id' => $user->id,
                'title' => $request->title,
                'jurusan_id' => $user->jurusan_id,
                'sktl_file_path' => $path,
                'sktl_status' => 'pending',
                'status' => 'sktl_pending'
            ]);
        }

        return redirect()->route('mahasiswa.dashboard')->with('success', 'SKTL berhasil diupload dan menunggu verifikasi.');
    }

    public function reuploadSktl()
    {
        return $this->createSktl();
    }

    public function storeReuploadSktl(Request $request)
    {
        return $this->storeSktl($request);
    }

    public function createFiles()
    {
        $skripsi = auth()->user()->skripsi;
        if (!$skripsi || !$skripsi->canUploadFiles()) {
            return redirect()->route('mahasiswa.dashboard')->with('error', 'SKTL belum diverifikasi.');
        }
        if ($skripsi->file_status === 'pending' || $skripsi->file_status === 'verified' || $skripsi->status === 'published' || $skripsi->status === 'approved') {
            return redirect()->route('mahasiswa.dashboard')->with('error', 'Anda sudah mengupload file skripsi.');
        }

        return view('mahasiswa.upload-files', compact('skripsi'));
    }

    public function storeFiles(Request $request)
    {
        $user = auth()->user();
        $jenjang = $user->jurusan->jenjang ?? 'S1';
        $requiresJurnal = in_array($jenjang, ['S2', 'S3']);

        $rules = [
            'cover_file' => 'required|mimes:pdf|max:20480',
            'abstrak_file' => 'required|mimes:pdf|max:20480',
            'skripsi_file' => 'required|mimes:pdf|max:20480',
            'daftar_pustaka_file' => 'required|mimes:pdf|max:20480',
            'turnitin_file' => 'required|mimes:pdf|max:20480',
        ];

        if ($requiresJurnal) {
            $rules['jurnal_file'] = 'required|mimes:pdf|max:20480';
        }

        $request->validate($rules);

        $user = auth()->user();
        $skripsi = $user->skripsi;

        // Public files
        $coverPath = $request->file('cover_file')->storeAs('uploads/skripsi/' . $user->id, 'cover_' . time() . '.pdf', 'public');
        $abstrakPath = $request->file('abstrak_file')->storeAs('uploads/skripsi/' . $user->id, 'abstrak_' . time() . '.pdf', 'public');
        $daftarPustakaPath = $request->file('daftar_pustaka_file')->storeAs('uploads/skripsi/' . $user->id, 'daftarpustaka_' . time() . '.pdf', 'public');

        // Private file
        $skripsiPath = $request->file('skripsi_file')->storeAs('private/skripsi/' . $user->id, 'skripsi_' . time() . '.pdf', 'local');

        $turnitinPath = $request->file('turnitin_file')->storeAs('uploads/skripsi/' . $user->id, 'turnitin_' . time() . '.pdf', 'public');

        $dataUpdate = [
            'cover_file_path' => $coverPath,
            'abstrak_file_path' => $abstrakPath,
            'skripsi_file_path' => $skripsiPath,
            'daftar_pustaka_file_path' => $daftarPustakaPath,
            'turnitin_file_path' => $turnitinPath,
            'file_status' => 'pending',
            'status' => 'files_pending'
        ];

        if ($requiresJurnal) {
            $jurnalPath = $request->file('jurnal_file')->storeAs('uploads/skripsi/' . $user->id, 'jurnal_' . time() . '.pdf', 'public');
            $dataUpdate['jurnal_file_path'] = $jurnalPath;
        }

        $skripsi->update($dataUpdate);

        return redirect()->route('mahasiswa.dashboard')->with('success', 'File skripsi berhasil diupload dan menunggu verifikasi.');
    }

    public function reuploadFiles()
    {
        return $this->createFiles();
    }

    public function storeReuploadFiles(Request $request)
    {
        return $this->storeFiles($request);
    }}
