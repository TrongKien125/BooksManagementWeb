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
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->unsignedInteger('code_numbers')->nullable();
            $table->string('public_year')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();

            $table->boolean('status')->default(0);
            $table->unsignedInteger('total_view')->default(0);
            $table->unsignedInteger('total_search')->default(0);
            $table->unsignedInteger('total_borrowed')->default(0);
            $table->unsignedInteger('user_id')->nullable()->index();

            $table->unsignedInteger('category_id')->index();
            $table->unsignedInteger('publisher_id')->index();
            $table->unsignedInteger('translate_id')->nullable()->index();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('publisher_id')->references('id')->on('publishers');
            // // $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
};
