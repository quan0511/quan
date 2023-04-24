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
        Schema::create('slide', function (Blueprint $table) {
            $table->id('id_slide');
		    $table->string('image');
		    $table->string('title',60);
		    $table->string('title_color',7)->default('#000000');
		    $table->string('content',200)->nullable();
		    $table->string('content_color',7)->default('#343A40');
		    $table->string('link',20)->nullable();
		    $table->string('btn_content',20)->nullable();
		    $table->string('btn_color',7)->default('#ffffff');
		    $table->string('btn_bg_color',7)->default('#000000');
		    $table->string('attr')->nullable();
		    $table->string('alert',40)->nullable();
            $table->string('alert_size',4)->default('fs-6');
		    $table->string('alert_color',7)->default('#000000');
		    $table->string('alert_bg',7)->default('#dc3545');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slide');
    }
};
