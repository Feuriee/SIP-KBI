<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pakan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pakan');
            $table->string('jenis_pakan');
            $table->decimal('harga_per_kg', 10, 2);
            $table->decimal('stok_kg', 10, 2);
            $table->string('supplier');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pakan');
    }
};
