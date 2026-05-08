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
        Schema::create('mangas', function (Blueprint $table) {
            $table->id();//id interno
            $table->unsignedBigInteger("mal_id")->unique(); //id di MAL
            $table->string("title");
            $table->integer("rank")->nullable();
            $table->string("image_url")->nullable();
            $table->integer("volumes")->nullable();
            $table->string("status")->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mangas');
    }
};
