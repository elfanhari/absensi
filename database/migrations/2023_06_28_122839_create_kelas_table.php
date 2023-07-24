<?php

use App\Models\Tapel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jurusan_id');
            $table->unsignedBigInteger('tapel_id');
            $table->unsignedBigInteger('guru_id');
            $table->bigInteger('tingkat');
            $table->string('name');
            $table->timestamps();

            // FK
            $table->foreign('jurusan_id')->references('id')->on('jurusans')->onDelete('cascade');
            $table->foreign('tapel_id')->references('id')->on('tapels')->onDelete('cascade');
            $table->foreign('guru_id')->references('id')->on('gurus')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kelas');
    }
}
