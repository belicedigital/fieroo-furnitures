<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFurnishingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('furnishings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stand_type_id');
            $table->foreign('stand_type_id')->references('id')->on('stands_types')->onDelete('cascade');
            $table->string('size')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->string('file_path')->nullable();
            $table->timestamps();
        });
        Schema::create('furnishings_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('furnishing_id');
            $table->foreign('furnishing_id')->references('id')->on('furnishings')->onDelete('cascade');
            $table->string('locale', 8)->index();
            $table->foreign('locale')->references('code')->on('languages')->onDelete('cascade')->onUpdate('cascade');
            $table->unique(['furnishing_id','locale']);
            $table->string('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('furnishings_translations');
        Schema::dropIfExists('furnishings');
    }
}
