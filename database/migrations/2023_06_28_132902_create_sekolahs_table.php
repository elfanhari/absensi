<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSekolahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sekolahs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('npsn')->nullable();
            $table->bigInteger('nss')->nullable();
            $table->string('telepon');
            $table->string('email');
            $table->text('alamat');
            $table->bigInteger('kodepos');
            $table->string('website')->nullable();
            $table->string('kepsek');
            $table->bigInteger('nipkepsek');
            $table->text('logo')->nullable()->default('logo.png');
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
        Schema::dropIfExists('sekolahs');
    }
}
