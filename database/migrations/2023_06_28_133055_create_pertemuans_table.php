<?php

use App\Models\Pembelajaran;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePertemuansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pertemuans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pembelajaran_id');
            $table->bigInteger('pertemuan_ke');
            $table->date('tanggal');
            $table->time('dari_pukul');
            $table->time('sampai_pukul');
            $table->timestamps();

            // FK
            $table->foreign('pembelajaran_id')->references('id')->on('pembelajarans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pertemuans');
    }
}
