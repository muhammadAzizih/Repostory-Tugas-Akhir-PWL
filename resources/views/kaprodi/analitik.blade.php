@extends('layouts.app')

@section('page_title', 'Analitik Laporan')

@section('content')
<div class="container-fluid py-4">
    @if($isDemo)
    <div class="alert alert-warning border-0 bg-warning bg-opacity-10 text-warning d-flex align-items-center rounded-4 shadow-sm mb-4" role="alert">
        <i class="bi bi-exclamation-triangle-fill fs-4 me-3"></i>
        <div>
            <strong class="d-block">Mode Presentasi (Simulasi)</strong>
            <span>Data riil di program studi {{ $jurusanName }} kurang dari 5. Halaman ini saat ini menampilkan data simulasi untuk keperluan demonstrasi.</span>
        </div>
    </div>
    @endif

    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Analitik Repositori</h3>
            <p class="text-muted mb-0">Program Studi: <span class="fw-semibold text-dark">{{ $jurusanName }}</span></p>
        </div>
        <div>
            <button class="btn btn-light shadow-sm rounded-3 fw-semibold border" onclick="window.print()">
                <i class="bi bi-printer me-2"></i> Cetak Laporan
            </button>
        </div>
    </div>

    <!-- Metric Cards -->
    <div class="row g-4 mb-4">
        <!-- Mahasiswa -->
        <div class="col-xl-3 col-md-6">
            <div class="card glass-card border-0 p-4 h-100 transition-hover">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-muted fw-semibold small text-uppercase">Total Mahasiswa</span>
                        <h2 class="fw-extrabold mb-0 mt-2">{{ $totalMahasiswa }}</h2>
                    </div>
                    <div class="rounded-4 p-3 bg-primary bg-opacity-10 text-primary">
                        <i class="bi bi-people-fill fs-3"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Terpublikasi -->
        <div class="col-xl-3 col-md-6">
            <div class="card glass-card border-0 p-4 h-100 transition-hover">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-muted fw-semibold small text-uppercase">Terpublikasi</span>
                        <h2 class="fw-extrabold mb-0 mt-2 text-success">{{ $totalPublished }}</h2>
                    </div>
                    <div class="rounded-4 p-3 bg-success bg-opacity-10 text-success">
                        <i class="bi bi-journal-check fs-3"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Menunggu Approval -->
        <div class="col-xl-3 col-md-6">
            <div class="card glass-card border-0 p-4 h-100 transition-hover">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-muted fw-semibold small text-uppercase">Menunggu Approval</span>
                        <h2 class="fw-extrabold mb-0 mt-2 text-warning">{{ $totalPendingApproval }}</h2>
                    </div>
                    <div class="rounded-4 p-3 bg-warning bg-opacity-10 text-warning">
                        <i class="bi bi-clock-history fs-3"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ditolak -->
        <div class="col-xl-3 col-md-6">
            <div class="card glass-card border-0 p-4 h-100 transition-hover">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-muted fw-semibold small text-uppercase">Total Penolakan</span>
                        <h2 class="fw-extrabold mb-0 mt-2 text-danger">{{ $totalRejected }}</h2>
                    </div>
                    <div class="rounded-4 p-3 bg-danger bg-opacity-10 text-danger">
                        <i class="bi bi-x-circle-fill fs-3"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row g-4 mb-4">
        <!-- Doughnut: Status Distribution -->
        <div class="col-lg-5">
            <div class="card glass-card border-0 p-4 h-100">
                <h5 class="fw-bold mb-4">Distribusi Status Dokumen</h5>
                <div class="chart-container d-flex justify-content-center align-items-center" style="position: relative; height: 280px;">
                    <canvas id="statusChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Bar: Rejection Categories -->
        <div class="col-lg-7">
            <div class="card glass-card border-0 p-4 h-100">
                <h5 class="fw-bold mb-4">Top Alasan Penolakan Berkas</h5>
                <div class="chart-container" style="position: relative; height: 280px;">
                    <canvas id="rejectionChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Line: Monthly Trend -->
    <div class="row g-4">
        <div class="col-12">
            <div class="card glass-card border-0 p-4">
                <h5 class="fw-bold mb-4">Tren Publikasi Dokumen (6 Bulan Terakhir)</h5>
                <div class="chart-container" style="position: relative; height: 300px; width: 100%;">
                    <canvas id="trendChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Load Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Colors corresponding to Emerald premium palette
        const primaryColor = '#10b981';
        const primaryDarkColor = '#059669';
        const infoColor = '#3b82f6';
        const warningColor = '#f59e0b';
        const dangerColor = '#ef4444';
        const secondaryColor = '#6b7280';
        
        // 1. Status Chart (Doughnut)
        const ctxStatus = document.getElementById('statusChart').getContext('2d');
        const statusChart = new Chart(ctxStatus, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($chartStatusLabels) !!},
                datasets: [{
                    data: {!! json_encode($chartStatusData) !!},
                    backgroundColor: [
                        '#9ca3af', // Draft
                        '#fbbf24', // Pending SKTL
                        '#f87171', // SKTL Ditolak
                        '#34d399', // SKTL Terverifikasi
                        '#60a5fa', // Pending Berkas
                        '#f87171', // Berkas Ditolak
                        '#a78bfa', // Menunggu Approval
                        '#10b981'  // Terpublikasi
                    ],
                    borderWidth: 2,
                    borderColor: '#ffffff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            font: { family: 'Plus Jakarta Sans', size: 11, weight: '600' },
                            padding: 15,
                            usePointStyle: true
                        }
                    }
                },
                cutout: '65%'
            }
        });

        // 2. Rejection Chart (Bar)
        const ctxRejection = document.getElementById('rejectionChart').getContext('2d');
        const rejectionChart = new Chart(ctxRejection, {
            type: 'bar',
            data: {
                labels: {!! json_encode($chartRejectionLabels) !!},
                datasets: [{
                    label: 'Jumlah Kasus',
                    data: {!! json_encode($chartRejectionData) !!},
                    backgroundColor: 'rgba(239, 68, 68, 0.85)',
                    hoverBackgroundColor: 'rgba(220, 38, 38, 1)',
                    borderRadius: 8,
                    barThickness: 24
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                indexAxis: 'y',
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: {
                            font: { family: 'Plus Jakarta Sans', weight: '600' },
                            stepSize: 1
                        }
                    },
                    y: {
                        grid: { display: false },
                        ticks: {
                            font: { family: 'Plus Jakarta Sans', weight: '600' },
                            callback: function(value) {
                                // Shorten long labels on Y-axis
                                const label = this.getLabelForValue(value);
                                if (label.length > 25) {
                                    return label.substring(0, 25) + '...';
                                }
                                return label;
                            }
                        }
                    }
                }
            }
        });

        // 3. Trend Chart (Line)
        const ctxTrend = document.getElementById('trendChart').getContext('2d');
        
        // Add subtle gradient under the line
        const gradient = ctxTrend.createLinearGradient(0, 0, 0, 300);
        gradient.addColorStop(0, 'rgba(16, 185, 129, 0.3)');
        gradient.addColorStop(1, 'rgba(16, 185, 129, 0.0)');

        const trendChart = new Chart(ctxTrend, {
            type: 'line',
            data: {
                labels: {!! json_encode($chartMonthlyLabels) !!},
                datasets: [{
                    label: 'Dokumen Dipublikasikan',
                    data: {!! json_encode($chartMonthlyData) !!},
                    borderColor: primaryColor,
                    borderWidth: 3,
                    backgroundColor: gradient,
                    fill: true,
                    tension: 0.35,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: primaryColor,
                    pointBorderWidth: 2,
                    pointRadius: 6,
                    pointHoverRadius: 8,
                    pointHoverBackgroundColor: primaryColor,
                    pointHoverBorderColor: '#ffffff',
                    pointHoverBorderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { font: { family: 'Plus Jakarta Sans', weight: '600' } }
                    },
                    y: {
                        grid: { color: 'rgba(0, 0, 0, 0.05)' },
                        ticks: {
                            font: { family: 'Plus Jakarta Sans', weight: '600' },
                            stepSize: 1
                        },
                        min: 0
                    }
                }
            }
        });
    });
</script>
@endsection
