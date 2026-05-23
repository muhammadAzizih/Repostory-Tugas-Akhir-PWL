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
        Schema::create('skripsi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('jurusan_id')->nullable()->constrained('jurusan');
            $table->string('title');
            $table->string('sktl_file_path')->nullable();
            $table->enum('sktl_status', ['pending', 'verified', 'rejected'])->default('pending');
            $table->string('sktl_rejection_category')->nullable();
            $table->text('sktl_rejection_notes')->nullable();
            $table->string('cover_file_path')->nullable();
            $table->string('abstrak_file_path')->nullable();
            $table->string('skripsi_file_path')->nullable();
            $table->string('daftar_pustaka_file_path')->nullable();
            $table->enum('file_status', ['pending', 'verified', 'rejected'])->nullable();
            $table->string('file_rejection_category')->nullable();
            $table->text('file_rejection_notes')->nullable();
            $table->enum('status', ['draft', 'sktl_pending', 'sktl_verified', 'sktl_rejected', 'files_pending', 'files_verified', 'files_rejected', 'approved', 'published'])->default('draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skripsi');
    }
};
