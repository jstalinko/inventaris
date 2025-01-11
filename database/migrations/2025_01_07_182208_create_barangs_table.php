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
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('code');
            $table->string('nama_barang');
            $table->string('satuan');
            $table->string('price_modal');
            $table->string('price_sell');
            $table->date('production_date')->default(now());
            $table->string('gudang')->nullable();
            $table->string('nomor_rak')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
