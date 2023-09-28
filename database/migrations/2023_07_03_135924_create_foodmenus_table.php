<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodmenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foodmenus', function (Blueprint $table) {
            $table->id();
            $table->string('food_name');
            $table->enum('food_jenis', ['Makanan', 'Minuman', 'Cemilan', 'Catering']);
            $table->string('foto');
            $table->string('deskripsi');
            $table->integer('harga');
            $table->enum('status', ['Ready', 'Habis']);
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
        Schema::dropIfExists('foodmenus');
    }
}
