<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skripsi;
use App\Models\Fakultas;
use App\Models\Jurusan;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class WelcomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Skripsi::with(['user', 'jurusan.fakultas'])->where('status', 'published');

        if ($request->filled('fakultas')) {
            $query->whereHas('jurusan.fakultas', function ($q) use ($request) {
                $q->where('id', $request->fakultas);
            });
        }

        if ($request->filled('jurusan')) {
            $query->where('jurusan_id', $request->jurusan);
        }

        if ($request->filled('jenjang')) {
            $query->whereHas('jurusan', function ($q) use ($request) {
                $q->where('jenjang', $request->jenjang);
            });
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $skripsis    = $query->latest()->paginate(12);
        $fakultas    = Fakultas::all();
        $jurusans    = Jurusan::all();
        $jenjangList = Jurusan::select('jenjang')->distinct()->orderBy('jenjang')->pluck('jenjang');

        // Latest published doc — used in hero mockup card
        $latestDoc = Skripsi::with(['user', 'jurusan'])
            ->where('status', 'published')
            ->latest()
            ->first();

        // Real stats from DB
        $stats = [
            'total_docs'     => Skripsi::where('status', 'published')->count(),
            'total_authors'  => User::whereHas('skripsi', fn($q) => $q->where('status', 'published'))->count(),
            'total_fakultas' => Fakultas::count(),
        ];

        return view('welcome', compact('skripsis', 'fakultas', 'jurusans', 'jenjangList', 'latestDoc', 'stats'));
    }

    public function show($id)
    {
        $skripsi = Skripsi::with(['user', 'jurusan.fakultas'])->where('status', 'published')->findOrFail($id);
        return view('skripsi.show', compact('skripsi'));
    }

    public function downloadSkripsi($id)
    {
        $skripsi = Skripsi::findOrFail($id);

        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Silakan login untuk mengunduh dokumen skripsi lengkap.');
        }

        if (!$skripsi->skripsi_file_path || !Storage::disk('local')->exists($skripsi->skripsi_file_path)) {
            abort(404, 'File not found.');
        }

        return Storage::disk('local')->response($skripsi->skripsi_file_path);
    }
}