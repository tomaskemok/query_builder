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
        Schema::create('sinonimos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('palabra_id');
            $table->string('sinonimo');
            $table->foreign('palabra_id')->references('id')->on('palabras')->onDelete('cascade');
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
        Schema::dropIfExists('sinonimos');
    }
};
