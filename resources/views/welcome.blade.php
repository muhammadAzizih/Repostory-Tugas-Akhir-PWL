@extends('layouts.app')
@section('page_title', 'Beranda')
@section('content')
<style>

:root {
    --em-50:  #ecfdf5;
    --em-100: #d1fae5;
    --em-400: #34d399;
    --em-500: #10b981;
    --em-600: #059669;
    --em-700: #047857;
    --em-900: #064e3b;
}


@keyframes floatA { 0%,100%{transform:translateY(0) rotate(0deg)} 50%{transform:translateY(-12px) rotate(2deg)} }
@keyframes floatB { 0%,100%{transform:translateY(0) rotate(0deg)} 50%{transform:translateY(-8px) rotate(-1deg)} }
@keyframes floatC { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-6px)} }
@keyframes pulse-ring { 0%{transform:scale(1);opacity:.4} 100%{transform:scale(1.5);opacity:0} }
@keyframes fadeUp { from{opacity:0;transform:translateY(20px)} to{opacity:1;transform:translateY(0)} }
@keyframes shimmer { 0%{background-position:-400px 0} 100%{background-position:400px 0} }
@keyframes ticker { 0%{transform:translateX(0)} 100%{transform:translateX(-50%)} }
@keyframes countUp { from{opacity:0;transform:translateY(8px)} to{opacity:1;transform:translateY(0)} }
@keyframes cardEntrance {
    from { opacity: 0; transform: translateY(30px) scale(0.96); }
    to   { opacity: 1; transform: translateY(0)   scale(1); }
}
  
.hero-wrap {
    background: linear-gradient(135deg, #d1fae5, #a7f3d0, #ecfdf5, #bbf7d0, #f0fdf4);
    background-size: 300% 300%;
    animation: heroGradient 7s ease infinite;
    border-radius: 28px;
    position: relative;
    overflow: hidden;
    padding: 0;
    margin-bottom: 40px;
}
@keyframes heroGradient {
    0%   { background-position: 0% 0%; }
    33%  { background-position: 100% 50%; }
    66%  { background-position: 50% 100%; }
    100% { background-position: 0% 0%; }
}
.hero-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    min-height: 520px;
    align-items: center;
}
.hero-left {
    padding: 60px 50px 60px 60px;
    position: relative;
    z-index: 2;
    animation: fadeUp .6s ease both;
}
.hero-right {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px 40px 40px 0;
    animation: fadeUp .6s .15s ease both;
}


.hero-blob-1, .hero-blob-2 { display: none; }

.hero-dots {
    position:absolute; inset:0; z-index:0; pointer-events:none;
    background-image: radial-gradient(circle, #10b98115 1px, transparent 1px);
    background-size: 28px 28px;
}


.hero-badge {
    display: inline-flex; align-items: center; gap: 8px;
    background: white; border: 1px solid var(--em-100);
    border-radius: 100px; padding: 6px 16px 6px 10px;
    font-size: .78rem; font-weight: 700; color: var(--em-700);
    box-shadow: 0 2px 12px rgba(16,185,129,.1);
    margin-bottom: 20px;
}
.hero-badge .dot {
    width: 8px; height: 8px; border-radius: 50%;
    background: var(--em-500); position: relative;
}
.hero-badge .dot::after {
    content:''; position:absolute; inset:-3px;
    border-radius:50%; border: 2px solid var(--em-400);
    animation: pulse-ring 1.5s ease-out infinite;
}


.hero-h1 {
    font-size: clamp(2rem, 4vw, 3rem);
    font-weight: 800;
    line-height: 1.1;
    letter-spacing: -1.5px;
    color: #111827;
    margin-bottom: 16px;
}
.hero-h1 .gradient-text {
    background: linear-gradient(135deg, var(--em-600), var(--em-400));
    -webkit-background-clip: text; -webkit-text-fill-color: transparent;
}

.hero-sub {
    font-size: 1rem; color: #6b7280; line-height: 1.7;
    margin-bottom: 32px; font-weight: 500; max-width: 400px;
}


.hero-stats {
    display: flex; gap: 24px; margin-bottom: 36px; flex-wrap: wrap;
}
.stat-item { display: flex; flex-direction: column; }
.stat-num {
    font-size: 1.4rem; font-weight: 800; color: #111827; line-height: 1;
    animation: countUp .5s ease both;
}
.stat-num span { color: var(--em-500); }
.stat-label { font-size: .7rem; font-weight: 600; color: #9ca3af; text-transform: uppercase; letter-spacing: .8px; margin-top: 2px; }
.stat-divider { width: 1px; background: #e5e7eb; align-self: stretch; }


.hero-search-wrap {
    background: white;
    border-radius: 16px;
    border: 1.5px solid #e5e7eb;
    box-shadow: 0 8px 32px rgba(0,0,0,.08), 0 2px 8px rgba(16,185,129,.06);
    display: flex; align-items: center;
    overflow: hidden;
    transition: border-color .2s, box-shadow .2s;
    max-width: 480px;
}
.hero-search-wrap:focus-within {
    border-color: var(--em-400);
    box-shadow: 0 8px 32px rgba(0,0,0,.08), 0 0 0 4px rgba(16,185,129,.12);
}
.hero-search-icon {
    padding: 0 14px 0 18px;
    color: var(--em-500);
    font-size: 1.15rem;
    flex-shrink: 0;
}
.hero-search-input {
    border: none; outline: none; box-shadow: none !important;
    font-size: .95rem; font-weight: 500; color: #111827;
    padding: 14px 12px 14px 0;
    background: transparent; flex-grow: 1; min-width: 0;
}
.hero-search-input::placeholder { color: #9ca3af; font-weight: 400; }
.hero-search-btn {
    background: linear-gradient(135deg, var(--em-500), var(--em-600));
    color: white; border: none; padding: 10px 22px;
    font-weight: 700; font-size: .875rem; cursor: pointer;
    border-radius: 10px; margin: 5px 5px;
    transition: all .2s; white-space: nowrap; flex-shrink: 0;
}
.hero-search-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(16,185,129,.35);
}


.hero-visual { position: relative; width: 100%; max-width: 420px; height: 420px; }


.doc-mockup {
    background: white;
    border-radius: 20px;
    box-shadow: 0 24px 60px rgba(0,0,0,.12), 0 4px 16px rgba(0,0,0,.06);
    padding: 24px;
    width: 260px;
    position: absolute;
    top: 50%; left: 50%;
    transform: translate(-50%, -50%);
    animation: floatA 5s ease-in-out infinite;
    z-index: 3;
}
.doc-mockup-header {
    display: flex; align-items: center; gap: 10px; margin-bottom: 18px;
}
.doc-icon-wrap {
    width: 38px; height: 38px;
    background: linear-gradient(135deg, var(--em-500), var(--em-600));
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    color: white; font-size: .9rem; flex-shrink: 0;
}
.doc-lines { display: flex; flex-direction: column; gap: 5px; }
.doc-line {
    height: 6px; border-radius: 4px; background: #f1f5f9;
}
.doc-line.dark { background: #1f2937; }
.doc-line.accent { background: var(--em-100); }
.doc-body { display: flex; flex-direction: column; gap: 6px; }
.doc-meta {
    display: flex; align-items: center; gap: 6px;
    font-size: .7rem; color: #6b7280; font-weight: 600;
    margin-bottom: 8px;
}
.doc-meta .badge-mini {
    background: var(--em-50); color: var(--em-700);
    border: 1px solid var(--em-100);
    border-radius: 100px; padding: 2px 8px;
    font-size: .65rem; font-weight: 700;
}
.doc-title-mock {
    font-size: .8rem; font-weight: 700; color: #111827; line-height: 1.4; margin-bottom: 10px;
}
.doc-author-row {
    display: flex; align-items: center; gap: 6px;
}
.doc-avatar {
    width: 22px; height: 22px; border-radius: 50%;
    background: linear-gradient(135deg, var(--em-400), var(--em-600));
    display: flex; align-items: center; justify-content: center;
    color: white; font-size: .55rem; font-weight: 800;
}
.doc-author-name { font-size: .7rem; color: #6b7280; font-weight: 500; }


.float-badge-verified {
    position: absolute; top: 12%; left: -8%;
    background: white; border-radius: 14px;
    box-shadow: 0 12px 30px rgba(0,0,0,.1);
    padding: 10px 14px;
    display: flex; align-items: center; gap: 8px;
    animation: floatB 4s 1s ease-in-out infinite;
    z-index: 4; white-space: nowrap;
    border: 1px solid var(--em-100);
}
.float-badge-verified .icon { color: var(--em-500); font-size: 1.1rem; }
.float-badge-verified .text { font-size: .72rem; font-weight: 700; color: #111827; }
.float-badge-verified .sub  { font-size: .62rem; color: #6b7280; }



.float-mini-card {
    position: absolute; top: 5%; right: 2%;
    background: white; border-radius: 12px;
    box-shadow: 0 8px 24px rgba(0,0,0,.08);
    padding: 10px 12px; display: flex; align-items: center; gap: 8px;
    animation: floatA 6s 2s ease-in-out infinite;
    z-index: 4; border: 1px solid #f0fdf4;
}
.float-mini-card .fi { font-size: 1.2rem; }
.float-mini-card .ft { font-size: .68rem; font-weight: 700; color: #111827; }
.float-mini-card .fs { font-size: .6rem; color: #9ca3af; }


.hero-ring-1 {
    position:absolute; width:340px; height:340px;
    border-radius:50%; border: 2px dashed var(--em-100);
    top:50%; left:50%; transform:translate(-50%,-50%);
    z-index:1; pointer-events:none;
}
.hero-ring-2 {
    position:absolute; width:460px; height:460px;
    border-radius:50%; border: 1px solid #f0fdf4;
    top:50%; left:50%; transform:translate(-50%,-50%);
    z-index:1; pointer-events:none;
}

.filter-bar-wrap {
    background: white;
    border-radius: 16px;
    border: 1px solid #e5e7eb;
    padding: 14px 20px;
    box-shadow: 0 2px 12px rgba(0,0,0,.04);
    margin-bottom: 28px;
    display: flex; align-items: flex-end; gap: 16px; flex-wrap: wrap;
}
.filter-group { display: flex; flex-direction: column; gap: 4px; }
.filter-group label {
    font-size: .65rem; font-weight: 800; text-transform: uppercase;
    letter-spacing: .9px; color: #9ca3af;
}
.filter-group select {
    border: 1.5px solid #e5e7eb; border-radius: 10px;
    font-size: .85rem; padding: 8px 12px;
    background: #f9fafb; color: #111827; font-weight: 500;
    min-width: 180px; cursor: pointer;
    transition: border-color .15s, box-shadow .15s;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%239ca3af' stroke-width='2.5'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 10px center;
    padding-right: 30px;
}
.filter-group select:focus {
    border-color: var(--em-400);
    box-shadow: 0 0 0 3px rgba(16,185,129,.1);
    outline: none;
}
.filter-divider-v { width:1px; background:#f0f0f0; align-self:stretch; margin: 0 4px; }
.btn-reset {
    background: #fef2f2; color: #ef4444;
    border: 1.5px solid #fecaca; border-radius: 10px;
    padding: 8px 16px; font-size: .8rem; font-weight: 700;
    cursor: pointer; display: flex; align-items: center; gap: 6px;
    transition: all .15s; white-space: nowrap; text-decoration: none;
    align-self: flex-end;
}
.btn-reset:hover { background: #fee2e2; color: #dc2626; }
.filter-result-info {
    margin-left: auto; align-self: flex-end;
    font-size: .78rem; color: #9ca3af; font-weight: 500;
    white-space: nowrap;
}

.section-header { margin-bottom: 20px; display: flex; justify-content: space-between; align-items: baseline; flex-wrap: wrap; gap: 8px; }
.section-title { font-size: 1.15rem; font-weight: 800; color: #111827; margin: 0; }
.section-sub   { font-size: .78rem; color: #9ca3af; font-weight: 500; }

    background: white;
    border-radius: 20px;
    border: 1.5px solid #f1f5f9;
    padding: 24px;
    display: flex; flex-direction: column;
    transition: transform .25s cubic-bezier(.4,0,.2,1), box-shadow .25s, border-color .25s;
    position: relative; overflow: hidden;
    animation: cardEntrance .4s ease both;
}
.doc-card::before {
    content: ''; position: absolute;
    top: 0; left: 0; right: 0; height: 3px;
    background: linear-gradient(90deg, var(--em-500), var(--em-400));
    transform: scaleX(0); transform-origin: left;
    transition: transform .25s ease;
}
.doc-card:hover { transform: translateY(-6px); box-shadow: 0 20px 48px rgba(0,0,0,.08); border-color: var(--em-100); }
.doc-card:hover::before { transform: scaleX(1); }

.doc-card-top { display: flex; align-items: flex-start; justify-content: space-between; gap: 10px; margin-bottom: 12px; }
.badge-jenjang {
    background: var(--em-50); color: var(--em-700);
    border: 1px solid var(--em-100);
    border-radius: 8px; padding: 4px 10px;
    font-size: .65rem; font-weight: 800; text-transform: uppercase; letter-spacing: .5px;
    flex-shrink: 0;
}
.badge-program {
    background: #f8fafc; color: #64748b;
    border: 1px solid #e2e8f0;
    border-radius: 8px; padding: 4px 10px;
    font-size: .65rem; font-weight: 700;
    flex-shrink: 0;
}
.doc-card-title {
    font-size: .9rem; font-weight: 700; color: #111827;
    line-height: 1.45; margin-bottom: 14px;
    display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
    flex-grow: 1;
}
.doc-card-title a { color: inherit; text-decoration: none; }
.doc-card-title a::after {
    content: ''; position: absolute; inset: 0;
}

.doc-card-footer {
    margin-top: auto; padding-top: 14px;
    border-top: 1px solid #f1f5f9;
    display: flex; align-items: center; justify-content: space-between; gap: 8px;
}
.author-info { display: flex; align-items: center; gap: 8px; }
.author-avatar {
    width: 32px; height: 32px; border-radius: 50%;
    background: linear-gradient(135deg, var(--em-400), var(--em-600));
    display: flex; align-items: center; justify-content: center;
    color: white; font-size: .6rem; font-weight: 800;
    flex-shrink: 0;
}
.author-name  { font-size: .75rem; font-weight: 700; color: #374151; line-height: 1.2; }
.author-date  { font-size: .65rem; color: #9ca3af; font-weight: 500; }
.card-arrow {
    width: 32px; height: 32px; border-radius: 50%;
    background: var(--em-50); border: 1px solid var(--em-100);
    display: flex; align-items: center; justify-content: center;
    color: var(--em-600); font-size: .8rem;
    flex-shrink: 0; position: relative; z-index: 1;
    transition: background .2s, transform .2s;
}
.doc-card:hover .card-arrow { background: var(--em-500); color: white; transform: rotate(-45deg); }


.doc-card:nth-child(1) { animation-delay: .05s }
.doc-card:nth-child(2) { animation-delay: .1s }
.doc-card:nth-child(3) { animation-delay: .15s }
.doc-card:nth-child(4) { animation-delay: .2s }
.doc-card:nth-child(5) { animation-delay: .25s }
.doc-card:nth-child(6) { animation-delay: .3s }
.doc-card:nth-child(7) { animation-delay: .35s }
.doc-card:nth-child(8) { animation-delay: .4s }

.empty-state {
    text-align: center; padding: 80px 24px;
    background: white; border-radius: 24px;
    border: 1.5px dashed #e5e7eb;
}
.empty-icon-wrap {
    width: 80px; height: 80px; border-radius: 20px;
    background: linear-gradient(135deg, var(--em-50), var(--em-100));
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 20px; font-size: 2rem; color: var(--em-500);
}
.empty-title { font-size: 1.1rem; font-weight: 800; color: #111827; margin-bottom: 6px; }
.empty-sub { font-size: .85rem; color: #6b7280; margin-bottom: 24px; }
.empty-suggestions { display: flex; gap: 8px; justify-content: center; flex-wrap: wrap; margin-bottom: 20px; }
.suggestion-chip {
    background: var(--em-50); color: var(--em-700);
    border: 1px solid var(--em-100); border-radius: 100px;
    padding: 6px 14px; font-size: .78rem; font-weight: 600;
    cursor: pointer; transition: all .15s; text-decoration: none;
}
.suggestion-chip:hover { background: var(--em-100); color: var(--em-800); transform: translateY(-1px); }

.pagination-wrap { margin-top: 48px; display: flex; justify-content: center; }
.pagination-wrap .pagination { gap: 4px; margin: 0; }
.pagination-wrap .page-item .page-link {
    border-radius: 10px; border: 1.5px solid #e5e7eb;
    color: #6b7280; font-weight: 600; font-size: .85rem;
    padding: 8px 14px; transition: all .15s;
}
.pagination-wrap .page-item .page-link:hover { border-color: var(--em-400); color: var(--em-600); background: var(--em-50); }
.pagination-wrap .page-item.active .page-link {
    background: var(--em-500); border-color: var(--em-500); color: white;
    box-shadow: 0 4px 12px rgba(16,185,129,.25);
}
.pagination-wrap .page-item.disabled .page-link { opacity: .4; }
.pagination-wrap p { display: none !important; }
.pagination-wrap div { justify-content: center !important; }

@media (max-width: 900px) {
    .hero-grid { grid-template-columns: 1fr; }
    .hero-right { display: none; }
    .hero-left { padding: 40px 24px; }
    .hero-h1 { font-size: 1.9rem; }
    .hero-search-wrap { max-width: 100%; }
    .hero-stats { gap: 16px; }
}
@media (max-width: 576px) {
    .filter-bar-wrap { gap: 10px; }
    .filter-group select { min-width: 140px; width: 100%; }
    .filter-result-info { display: none; }
    .hero-left { padding: 28px 20px; }
    .hero-badge { font-size: .7rem; }
}
</style>

<div class="container-fluid px-md-3 pb-5">

   
    <div class="hero-wrap">
        <div class="hero-dots"></div>
        <div class="hero-blob-1"></div>
        <div class="hero-blob-2"></div>

        <div class="hero-grid">
            {{-- LEFT: Copy + Search --}}
            <div class="hero-left">
                <div class="hero-badge">
                    <div class="dot"></div>
                    Repository Digital Tugas Akhir Mahasiswa
                </div>

                <h1 class="hero-h1">
                    Gerbang<br>
                    <span class="gradient-text">Pengetahuan</span><br>
                    Digital.
                </h1>

                <p class="hero-sub">
                    Akses ribuan skripsi, tesis, dan disertasi terverifikasi dari seluruh fakultas dalam satu platform terpusat.
                </p>

                {{-- Stats — real data from DB --}}
                <div class="hero-stats">
                    <div class="stat-item">
                        <div class="stat-num">{{ $stats['total_docs'] }}<span>+</span></div>
                        <div class="stat-label">Dokumen</div>
                    </div>
                    <div class="stat-divider"></div>
                    <div class="stat-item">
                        <div class="stat-num">{{ $stats['total_authors'] }}<span>+</span></div>
                        <div class="stat-label">Penulis</div>
                    </div>
                    <div class="stat-divider"></div>
                    <div class="stat-item">
                        <div class="stat-num">{{ $stats['total_fakultas'] }}</div>
                        <div class="stat-label">Fakultas</div>
                    </div>
                    <div class="stat-divider"></div>
                    <div class="stat-item">
                        <div class="stat-num">100<span>%</span></div>
                        <div class="stat-label">Terverifikasi</div>
                    </div>
                </div>

                {{-- Search --}}
                <form action="{{ route('welcome') }}" method="GET">
                    <div class="hero-search-wrap">
                        <span class="hero-search-icon"><i class="bi bi-search"></i></span>
                        <input
                            type="text" name="search"
                            class="hero-search-input"
                            placeholder="Cari judul, nama penulis, atau topik..."
                            value="{{ request('search') }}"
                            autocomplete="off"
                        >
                        <button type="submit" class="hero-search-btn">Temukan</button>
                    </div>
                </form>
            </div>

            {{-- RIGHT: Floating visual --}}
            <div class="hero-right">
                <div class="hero-visual">
                    <div class="hero-ring-1"></div>
                    <div class="hero-ring-2"></div>

                    {{-- Main doc card — real latest data --}}
                    <div class="doc-mockup">
                        <div class="doc-mockup-header">
                            <div class="doc-icon-wrap"><i class="bi bi-file-earmark-text-fill"></i></div>
                            <div class="doc-lines" style="flex:1">
                                <div class="doc-line dark" style="width:70%"></div>
                                <div class="doc-line" style="width:50%"></div>
                            </div>
                        </div>
                        <div class="doc-meta">
                            <span class="badge-mini">S1 Teknologi Informasi</span>
                            <span>·</span>
                            <span>Fak. Teknik</span>
                        </div>
                        <div class="doc-title-mock">
                            Implementasi Machine Learning untuk Deteksi Anomali pada Sistem Jaringan
                        </div>
                        <div class="doc-body">
                            <div class="doc-line" style="width:100%"></div>
                            <div class="doc-line" style="width:85%"></div>
                            <div class="doc-line" style="width:60%"></div>
                        </div>
                        <div class="doc-author-row" style="margin-top:14px; padding-top:12px; border-top:1px solid #f1f5f9;">
                            <div class="doc-avatar">AR</div>
                            <div class="doc-author-name">Laravelia E. · 2025</div>
                        </div>
                    </div>

                    {{-- Floating: verified --}}
                    <div class="float-badge-verified">
                        <div class="icon"><i class="bi bi-patch-check-fill"></i></div>
                        <div>
                            <div class="text">Terverifikasi</div>
                            <div class="sub">Oleh Kaprodi</div>
                        </div>
                    </div>

                    {{-- Floating mini top right --}}
                    <div class="float-mini-card">
                        <div class="fi"><i class="bi bi-shield-check" style="color:var(--em-500)"></i></div>
                        <div>
                            <div class="ft">Open Access</div>
                            <div class="fs">100% Gratis</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════
         FILTER + GRID
    ═══════════════════════════════════════ --}}

    {{-- Section Header --}}
    <div class="section-header">
        <div>
            <h4 class="section-title">Koleksi Dokumen</h4>
        </div>
        <div class="section-sub">{{ $skripsis->total() }} dokumen ditemukan</div>
    </div>

    {{-- Filter Bar --}}
    <div class="filter-bar-wrap">
        <form action="{{ route('welcome') }}" method="GET" style="display:contents">
            @if(request('search'))
                <input type="hidden" name="search" value="{{ request('search') }}">
            @endif

            <span style="font-size:.8rem;font-weight:700;color:#374151;display:flex;align-items:center;gap:6px;align-self:flex-end;padding-bottom:8px;">
                <i class="bi bi-sliders2" style="color:var(--em-500)"></i> Filter
            </span>
            <div class="filter-divider-v" style="align-self:flex-end;height:36px;"></div>

            <div class="filter-group">
                <label>Jenjang</label>
                <select name="jenjang" onchange="this.form.submit()">
                    <option value="">Semua Jenjang</option>
                    @foreach($jenjangList as $jj)
                        <option value="{{ $jj }}" {{ request('jenjang') == $jj ? 'selected' : '' }}>{{ $jj }}</option>
                    @endforeach
                </select>
            </div>

            <div class="filter-group">
                <label>Fakultas</label>
                <select name="fakultas" onchange="this.form.submit()">
                    <option value="">Semua Fakultas</option>
                    @foreach($fakultas as $f)
                        <option value="{{ $f->id }}" {{ request('fakultas') == $f->id ? 'selected' : '' }}>{{ $f->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="filter-group">
                <label>Program Studi</label>
                <select name="jurusan" onchange="this.form.submit()">
                    <option value="">Semua Prodi</option>
                    @foreach($jurusans as $j)
                        @if(!request('fakultas') || $j->fakultas_id == request('fakultas'))
                            <option value="{{ $j->id }}" {{ request('jurusan') == $j->id ? 'selected' : '' }}>{{ $j->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            @if(request('fakultas') || request('jurusan') || request('jenjang') || request('search'))
                <a href="{{ route('welcome') }}" class="btn-reset">
                    <i class="bi bi-x-circle"></i> Reset
                </a>
            @endif

            <div class="filter-result-info">
                <i class="bi bi-file-text me-1"></i>{{ $skripsis->count() }} dari {{ $skripsis->total() }} dokumen
            </div>
        </form>
    </div>

    {{-- Document Grid --}}
    <div class="row g-3 g-md-4">
        @forelse($skripsis as $skripsi)
            <div class="col-sm-6 col-lg-4 col-xl-3">
                <div class="doc-card h-100">
                    <div class="doc-card-top">
                        <span class="badge-program">{{ Str::limit($skripsi->jurusan->name ?? '-', 24) }}</span>
                    </div>

                    <div class="doc-card-title">
                        <a href="{{ route('skripsi.show', $skripsi->id) }}">{{ $skripsi->title }}</a>
                    </div>

                    <div class="doc-card-footer">
                        <div class="author-info">
                            <div class="author-avatar">
                                {{ strtoupper(substr($skripsi->user->name, 0, 2)) }}
                            </div>
                            <div>
                                <div class="author-name">{{ Str::limit($skripsi->user->name, 18) }}</div>
                                <div class="author-date">{{ $skripsi->updated_at->format('d M Y') }}</div>
                            </div>
                        </div>
                        <div class="card-arrow">
                            <i class="bi bi-arrow-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="empty-state">
                    <div class="empty-icon-wrap">
                        <i class="bi bi-search"></i>
                    </div>
                    <div class="empty-title">Dokumen tidak ditemukan</div>
                    <div class="empty-sub">
                        @if(request('search'))
                            Tidak ada hasil untuk "<strong>{{ request('search') }}</strong>". Coba kata kunci lain.
                        @else
                            Belum ada dokumen yang dipublikasikan untuk filter ini.
                        @endif
                    </div>
                    <div class="empty-suggestions">
                        <span class="suggestion-chip" onclick="fillSearch('Sistem Informasi')">Sistem Informasi</span>
                        <span class="suggestion-chip" onclick="fillSearch('Data Mining')">Data Mining</span>
                        <span class="suggestion-chip" onclick="fillSearch('Machine Learning')">Machine Learning</span>
                        <span class="suggestion-chip" onclick="fillSearch('Keuangan')">Keuangan</span>
                        <span class="suggestion-chip" onclick="fillSearch('Hukum Pidana')">Hukum Pidana</span>
                    </div>
                    <a href="{{ route('welcome') }}" class="btn-reset" style="display:inline-flex;margin:0 auto;">
                        <i class="bi bi-x-circle"></i> Hapus Semua Filter
                    </a>
                </div>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="pagination-wrap">
        {{ $skripsis->withQueryString()->links('pagination::bootstrap-5') }}
    </div>

</div>




<script>
function fillSearch(keyword) {
    const url = new URL(window.location.href);
    url.searchParams.set('search', keyword);
    url.searchParams.delete('fakultas');
    url.searchParams.delete('jurusan');
    url.searchParams.delete('jenjang');
    window.location.href = url.toString();
}
</script>
@endsection
