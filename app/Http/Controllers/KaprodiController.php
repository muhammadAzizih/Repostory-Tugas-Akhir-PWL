<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KaprodiController extends Controller
{
    public function index()
    {
        $jurusanId = auth()->user()->jurusan_id;
        $totalPublished = \App\Models\Skripsi::where('jurusan_id', $jurusanId)->where('status', 'published')->count();
        $pendingApproval = \App\Models\Skripsi::where('jurusan_id', $jurusanId)->where('status', 'files_verified')->count();
        $totalSkripsi = \App\Models\Skripsi::where('jurusan_id', $jurusanId)->count();

        $skripsis = \App\Models\Skripsi::with(['user', 'jurusan'])
            ->where('jurusan_id', $jurusanId)
            ->where('status', 'files_verified')
            ->get();

        return view('kaprodi.dashboard', compact('totalPublished', 'pendingApproval', 'totalSkripsi', 'skripsis'));
    }

    public function indexPersetujuan()
    {
        $skripsis = \App\Models\Skripsi::with(['user', 'jurusan'])
            ->where('jurusan_id', auth()->user()->jurusan_id)
            ->where('status', 'files_verified')
            ->get();
        return view('kaprodi.persetujuan', compact('skripsis'));
    }

    public function approve($id)
    {
        $skripsi = \App\Models\Skripsi::findOrFail($id);
        
        if ($skripsi->status !== 'files_verified') {
            return back()->with('error', 'Status skripsi tidak valid untuk disetujui.');
        }

        $skripsi->update([
            'status' => 'published'
        ]);

        return redirect()->route('kaprodi.persetujuan')->with('success', 'Skripsi berhasil disetujui dan dipublikasikan.');
    }

    public function analitik()
    {
        return view('kaprodi.analitik');
    }}
