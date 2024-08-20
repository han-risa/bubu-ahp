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
    public function up()
    {
        Schema::create('skor_bobots', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kriteria_id');
            $table->unsignedBigInteger('bulan_id');
            $table->double('skor_bobot');
            $table->timestamps();

            // Foreign Key Constraints
            $table->foreign('kriteria_id')->references('id')->on('kriterias')->onDelete('cascade');
            $table->foreign('bulan_id')->references('id')->on('bulan_rankings')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('skor_bobots');
    }
};
