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
        Schema::create('comment', function (Blueprint $table) {
            $table->id('id_comment');
            $table->foreignId('id_product');
            $table->foreignId('id_user');
            $table->boolean('verified')->default(false);
            $table->string('name',20)->nullable();
            $table->text('context')->nullable();
            $table->integer('rating')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comment');
    }
};
