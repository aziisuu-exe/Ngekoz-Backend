<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('kos_places', function (Blueprint $table) {
            $table->dropColumn('rules'); // Hapus kolom lama
            
            // Opsional: Tambahkan kolom untuk aturan unik jika belum ada
            // $table->text('additional_rules')->nullable()->after('description'); 
        });
    }
    
    public function down()
    {
        Schema::table('kos_places', function (Blueprint $table) {
            $table->text('rules')->nullable(); // Rollback jika dibutuhkan
        });
    }
};
