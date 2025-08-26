<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_laporan_perjalanans_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('laporan_perjalanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sppd_id')->constrained('s_p_p_d_s')->onDelete('cascade');
            $table->text('kegiatan');
            $table->text('hasil');
            $table->decimal('total_biaya', 15, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('laporan_perjalanans');
    }
};