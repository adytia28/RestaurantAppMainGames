<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_variant_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_variants_id')->constrained('menu_variants')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('stock')->default(0);
            $table->integer('price')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_variant_details');
    }
};
