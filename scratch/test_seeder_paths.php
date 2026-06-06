<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Storage;

$paths = [
    "uploads/skripsi/s1_skripsi_sample.pdf",
    "uploads/skripsi/s2_skripsi_sample.pdf",
    "uploads/sktl/s1_sktl_sample.pdf",
    "uploads/sktl/s2_sktl_sample.pdf",
];

foreach ($paths as $path) {
    $exists = Storage::disk('local')->exists($path);
    $realPath = Storage::disk('local')->path($path);
    echo "Path: $path | Exists: " . ($exists ? "YES" : "NO") . " | Full Path: $realPath\n";
}
