<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jenis_ikan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_ikan');
            $table->integer('masa_panen_hari');
            $table->decimal('harga_per_kg', 10, 2);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jenis_ikan');
    }
};
