<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('menu_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menus_id')->constrained('menus')->onDelete('cascade')->onUpdate('cascade');
            $table->string('name', 100);
            $table->boolean('in_active')->default(1);
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
        Schema::dropIfExists('menu_variants');
    }
};
