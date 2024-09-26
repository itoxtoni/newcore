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
        Schema::create('pages', function (Blueprint $table) {
            $table->integer('page_id')->autoIncrement();
            $table->string('page_slug');
            $table->string('page_name');
            $table->string('page_date')->nullable();
            $table->string('page_info')->nullable();
            $table->integer('page_price')->nullable();
            $table->string('page_image')->nullable();
            $table->text('page_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
