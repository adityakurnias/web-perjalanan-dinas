<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_s_p_p_d_s_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('s_p_p_d_s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('tujuan');
            $table->date('tanggal_berangkat');
            $table->date('tanggal_kembali');
            $table->text('keperluan');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('catatan_admin')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('s_p_p_d_s');
    }
};