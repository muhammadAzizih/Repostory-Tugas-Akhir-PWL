<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OperatorController extends Controller
{
    public function index()
    {
        $jurusanId = auth()->user()->jurusan_id;
        $sktlPending = \App\Models\Skripsi::where('jurusan_id', $jurusanId)->where('status', 'sktl_pending')->count();
        $filesPending = \App\Models\Skripsi::where('jurusan_id', $jurusanId)->where('status', 'files_pending')->count();
        $totalVerified = \App\Models\Skripsi::where('jurusan_id', $jurusanId)->where('status', 'approved')->count();
        $totalPublished = \App\Models\Skripsi::where('jurusan_id', $jurusanId)->where('status', 'published')->count();
        $recentSubmissions = \App\Models\Skripsi::with('user')->where('jurusan_id', $jurusanId)->latest()->take(5)->get();

        return view('operator.dashboard', compact('sktlPending', 'filesPending', 'totalVerified', 'totalPublished', 'recentSubmissions'));
    }

    public function indexStudents()
    {
        $students = \App\Models\User::whereHas('role', function($q) {
            $q->where('name', 'Mahasiswa');
        })
        ->where('jurusan_id', auth()->user()->jurusan_id)
        ->get();
        return view('operator.students.index', compact('students'));
    }

    public function createStudent()
    {
        return view('operator.students.create');
    }

    public function storeStudent(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $mahasiswaRole = \App\Models\Role::where('name', 'Mahasiswa')->first();

        \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $mahasiswaRole->id,
            'jurusan_id' => auth()->user()->jurusan_id,
        ]);

        return redirect()->route('operator.students.index')->with('success', 'Mahasiswa berhasil ditambahkan.');
    }

    public function editStudent($id)
    {
        $student = \App\Models\User::findOrFail($id);
        return view('operator.students.edit', compact('student'));
    }

    public function updateStudent(Request $request, $id)
    {
        $student = \App\Models\User::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $student->name = $request->name;
        $student->email = $request->email;
        if ($request->password) {
            $student->password = bcrypt($request->password);
        }
        $student->save();

        return redirect()->route('operator.students.index')->with('success', 'Data Mahasiswa berhasil diupdate.');
    }

    public function destroyStudent($id)
    {
        \App\Models\User::findOrFail($id)->delete();
        return redirect()->route('operator.students.index')->with('success', 'Mahasiswa berhasil dihapus.');
    }

    public function indexSktl()
    {
        $skripsis = \App\Models\Skripsi::with(['user', 'jurusan'])
            ->where('jurusan_id', auth()->user()->jurusan_id)
            ->where('status', 'sktl_pending')
            ->get();
        return view('operator.verifikasi.sktl', compact('skripsis'));
    }

    public function downloadSktl($id)
    {
        $skripsi = \App\Models\Skripsi::findOrFail($id);
        if (!$skripsi->sktl_file_path || !\Illuminate\Support\Facades\Storage::disk('local')->exists($skripsi->sktl_file_path)) {
            abort(404, 'File not found.');
        }
        return \Illuminate\Support\Facades\Storage::disk('local')->response($skripsi->sktl_file_path);
    }

    public function verifySktl($id)
    {
        $skripsi = \App\Models\Skripsi::findOrFail($id);
        $skripsi->update([
            'sktl_status' => 'verified',
            'status' => 'sktl_verified'
        ]);
        return redirect()->route('operator.verifikasi.sktl')->with('success', 'SKTL berhasil diverifikasi.');
    }

    public function rejectSktl(Request $request, $id)
    {
        $request->validate([
            'category' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $skripsi = \App\Models\Skripsi::findOrFail($id);
        $skripsi->update([
            'sktl_status' => 'rejected',
            'sktl_rejection_category' => $request->category,
            'sktl_rejection_notes' => $request->notes,
            'status' => 'sktl_rejected'
        ]);
        return redirect()->route('operator.verifikasi.sktl')->with('success', 'SKTL ditolak.');
    }

    public function indexFiles()
    {
        $skripsis = \App\Models\Skripsi::with(['user', 'jurusan'])
            ->where('jurusan_id', auth()->user()->jurusan_id)
            ->where('status', 'files_pending')
            ->get();
        return view('operator.verifikasi.files', compact('skripsis'));
    }

    public function verifyFiles($id)
    {
        $skripsi = \App\Models\Skripsi::findOrFail($id);
        $skripsi->update([
            'file_status' => 'verified',
            'status' => 'files_verified'
        ]);
        return redirect()->route('operator.verifikasi.files')->with('success', 'File skripsi berhasil diverifikasi. Menunggu persetujuan Kaprodi.');
    }

    public function rejectFiles(Request $request, $id)
    {
        $request->validate([
            'category' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $skripsi = \App\Models\Skripsi::findOrFail($id);
        $skripsi->update([
            'file_status' => 'rejected',
            'file_rejection_category' => $request->category,
            'file_rejection_notes' => $request->notes,
            'status' => 'files_rejected'
        ]);
        return redirect()->route('operator.verifikasi.files')->with('success', 'File skripsi ditolak.');
    }

    public function riwayat()
    {
        $skripsis = \App\Models\Skripsi::with(['user', 'jurusan'])
            ->where('jurusan_id', auth()->user()->jurusan_id)
            ->latest()
            ->get();
        return view('operator.riwayat', compact('skripsis'));
    }

    public function riwayatDetail($id)
    {
        $skripsi = \App\Models\Skripsi::with(['user', 'jurusan.fakultas'])
            ->where('jurusan_id', auth()->user()->jurusan_id)
            ->findOrFail($id);
        return view('operator.riwayat-detail', compact('skripsi'));
    }

    public function indexPublished(Request $request)
    {
        $search = $request->input('search');

        $query = \App\Models\Skripsi::with(['user', 'jurusan'])
            ->where('jurusan_id', auth()->user()->jurusan_id)
            ->where('status', 'published');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhereHas('user', function($qu) use ($search) {
                      $qu->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%');
                  });
            });
        }

        $skripsis = $query->latest()->get();

        return view('operator.publikasi', compact('skripsis', 'search'));
    }

    public function destroySkripsi($id)
    {
        \App\Models\Skripsi::findOrFail($id)->delete();
        return back()->with('success', 'Data skripsi dihapus.');
    }

    public function statistik()
    {
        $jurusanId = auth()->user()->jurusan_id;
        $jurusan = auth()->user()->jurusan;
        $jurusanName = $jurusan->name ?? 'Program Studi';

        // Selalu gunakan data riil dari database (isDemo diset false)
        $isDemo = false;

        // 1. Metrik Utama dari Database
        $totalMahasiswa = \App\Models\User::where('jurusan_id', $jurusanId)
            ->whereHas('role', function($q) {
                $q->where('name', 'Mahasiswa');
            })->count();

        $totalPublished = \App\Models\Skripsi::where('jurusan_id', $jurusanId)
            ->where('status', 'published')
            ->count();

        $totalPendingApproval = \App\Models\Skripsi::where('jurusan_id', $jurusanId)
            ->where('status', 'files_verified')
            ->count();

        $totalRejected = \App\Models\Skripsi::where('jurusan_id', $jurusanId)
            ->where(function($q) {
                $q->where('sktl_status', 'rejected')
                  ->orWhere('file_status', 'rejected');
            })->count();

        // 2. Status Distribution (Doughnut)
        $statusCounts = \App\Models\Skripsi::where('jurusan_id', $jurusanId)
            ->selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        $statuses = [
            'draft' => 'Draft',
            'sktl_pending' => 'Pending SKTL',
            'sktl_rejected' => 'SKTL Ditolak',
            'sktl_verified' => 'SKTL Terverifikasi',
            'files_pending' => 'Pending Berkas',
            'files_rejected' => 'Berkas Ditolak',
            'files_verified' => 'Menunggu Approval',
            'published' => 'Terpublikasi'
        ];

        $chartStatusLabels = [];
        $chartStatusData = [];
        foreach ($statuses as $key => $label) {
            $chartStatusLabels[] = $label;
            $chartStatusData[] = $statusCounts[$key] ?? 0;
        }

        // 3. Rejection Categories (Bar Chart)
        $sktlRejections = \App\Models\Skripsi::where('jurusan_id', $jurusanId)
            ->where('sktl_status', 'rejected')
            ->whereNotNull('sktl_rejection_category')
            ->selectRaw('sktl_rejection_category as category, count(*) as count')
            ->groupBy('sktl_rejection_category')
            ->pluck('count', 'category')
            ->toArray();

        $fileRejections = \App\Models\Skripsi::where('jurusan_id', $jurusanId)
            ->where('file_status', 'rejected')
            ->whereNotNull('file_rejection_category')
            ->selectRaw('file_rejection_category as category, count(*) as count')
            ->groupBy('file_rejection_category')
            ->pluck('count', 'category')
            ->toArray();

        $allRejections = [];
        foreach ($sktlRejections as $cat => $count) {
            $allRejections[$cat] = ($allRejections[$cat] ?? 0) + $count;
        }
        foreach ($fileRejections as $cat => $count) {
            $allRejections[$cat] = ($allRejections[$cat] ?? 0) + $count;
        }

        arsort($allRejections);
        // Limit to top 5 rejection reasons
        $allRejections = array_slice($allRejections, 0, 5, true);
        
        $chartRejectionLabels = array_keys($allRejections);
        $chartRejectionData = array_values($allRejections);
        if (empty($chartRejectionLabels)) {
            $chartRejectionLabels = ['Belum Ada Penolakan'];
            $chartRejectionData = [0];
        }

        // 4. Monthly Publication Trend (Line Chart - last 6 months)
        $monthlyTrend = \App\Models\Skripsi::where('jurusan_id', $jurusanId)
            ->where('status', 'published')
            ->selectRaw('YEAR(updated_at) as year, MONTH(updated_at) as month, count(*) as count')
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        $chartMonthlyLabels = [];
        $chartMonthlyData = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = \Carbon\Carbon::now()->subMonths($i);
            $year = $date->year;
            $month = $date->month;
            $chartMonthlyLabels[] = $date->translatedFormat('F Y');
            
            $foundCount = 0;
            foreach ($monthlyTrend as $trend) {
                if ($trend->year == $year && $trend->month == $month) {
                    $foundCount = $trend->count;
                    break;
                }
            }
            $chartMonthlyData[] = $foundCount;
        }

        return view('operator.statistik', compact(
            'isDemo',
            'jurusanName',
            'totalMahasiswa',
            'totalPublished',
            'totalPendingApproval',
            'totalRejected',
            'chartStatusLabels',
            'chartStatusData',
            'chartRejectionLabels',
            'chartRejectionData',
            'chartMonthlyLabels',
            'chartMonthlyData'
        ));
    }
}
