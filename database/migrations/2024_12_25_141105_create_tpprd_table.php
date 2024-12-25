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
        if (!Schema::hasTable('tpprd')) {
            Schema::create('tpprd', function (Blueprint $table) {
                $table->id('tpprd_pk')->autoIncrement(); // Primary Key
                $table->string('tpprd_nomor_peserta')->unique(); // Nomor Peserta
                $table->string('tpprd_nama'); // Nama Peserta
                $table->date('tpprd_tanggal_lahir'); // Tanggal Lahir
                $table->integer('tpprd_umur'); // Umur (terisi otomatis)
                $table->string('tpprd_bank'); // Nama Bank
                $table->date('tpprd_tanggal_awal'); // Tanggal Awal (terisi otomatis)
                $table->integer('tpprd_masa_bulan'); // Masa Bulan (diisi user)
                $table->date('tpprd_tanggal_akhir'); // Tanggal Akhir (terisi otomatis)
                $table->decimal('tpprd_up', 15, 2); // Nilai Pinjaman
                $table->decimal('tpprd_tarif', 8, 3); // Tarif (terisi otomatis)
                $table->decimal('tpprd_premi', 15, 2); // Premi (terisi otomatis)
                $table->string('tpprd_user_input'); // User Input (tersimpan sesuai login)
                $table->timestamp('tpprd_date_input')->useCurrent(); // Tanggal Input (tersimpan sesuai sistem/server)
    
                $table->timestamps();
            });
        }
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tpprd');
    }
};
