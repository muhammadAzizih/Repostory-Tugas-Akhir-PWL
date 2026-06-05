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

        return view('kaprodi.analitik', compact(
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
