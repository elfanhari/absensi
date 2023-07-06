<?php

use App\Models\Pertemuan;
use App\Models\Siswa;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pertemuan_id');
            $table->unsignedBigInteger('siswa_id');
            $table->enum('keterangan', ['H', 'S', 'I', 'A', 'T']);
            $table->timestamps();

            // FK
            $table->foreign('pertemuan_id')->references('id')->on('pertemuans')->onDelete('cascade');
            $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absens');
    }
}
