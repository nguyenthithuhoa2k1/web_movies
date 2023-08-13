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
        Schema::create('movies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('image');
            $table->string('title');
            $table->text('descriptions')->nullable();
            $table->string('status')->nullable();
            $table->integer('country_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('genres_id')->nullable();
            $table->integer('user_id');
            $table->string('perfomer')->nullable();
            $table->integer('year')->nullable();
            $table->bigInteger('view')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
