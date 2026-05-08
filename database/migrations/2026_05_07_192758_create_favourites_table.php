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
        Schema::create('favourites', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")->references("id")->on("users");
            $table->morphs('favourable');
            // crea favourable_id e favourable_type
            //in questo modo non creiamo 2 tabelle (1 per anime e 1 per manga)

            $table->unique(["user_id","favourable_id","favourable_type"]);
            //ogni campo deve essere unique con queste 3 cose.

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favourites');
    }
};
