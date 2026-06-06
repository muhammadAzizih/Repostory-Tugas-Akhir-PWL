<?php
$base = "c:/xampp/htdocs/WEBLARAVEL/storage/app";
echo "With app/uploads: " . (file_exists("$base/uploads/skripsi/s1_skripsi_sample.pdf") ? "YES" : "NO") . "\n";
echo "With app/private/uploads: " . (file_exists("$base/private/uploads/skripsi/s1_skripsi_sample.pdf") ? "YES" : "NO") . "\n";
