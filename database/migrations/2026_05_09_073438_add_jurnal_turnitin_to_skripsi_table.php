<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('skripsi', function (Blueprint $table) {
            $table->string('jurnal_file_path')->nullable()->after('daftar_pustaka_file_path');
            $table->string('turnitin_file_path')->nullable()->after('jurnal_file_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('skripsi', function (Blueprint $table) {
            $table->dropColumn(['jurnal_file_path', 'turnitin_file_path']);
        });
    }
};
