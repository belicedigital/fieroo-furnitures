<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFurnishingsStandsTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('furnishings', function(Blueprint $table) {
            $table->dropForeign(['stand_type_id']);
        });
        Schema::table('furnishings', function(Blueprint $table) {
            $table->dropColumn('stand_type_id');
            $table->string('color')->nullable()->after('price');
            $table->boolean('is_variant')->default(false)->after('price');
            $table->unsignedBigInteger('variant_id')->nullable()->after('price');
            $table->foreign('variant_id')->references('id')->on('furnishings')->onDelete('cascade');
        });
        Schema::create('furnishings_stands_types', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stand_type_id');
            $table->foreign('stand_type_id')->references('id')->on('stands_types')->onDelete('cascade');
            $table->unsignedBigInteger('furnishing_id');
            $table->foreign('furnishing_id')->references('id')->on('furnishings')->onDelete('cascade');
            $table->boolean('is_supplied')->default(true);
            $table->integer('min')->nullable();
            $table->integer('max')->nullable();
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
        Schema::dropIfExists('furnishings_stands_types');
        Schema::table('furnishings', function(Blueprint $table) {
            $table->dropForeign(['variant_id']);
            $table->dropColumn(['variant_id', 'color', 'is_variant']);
            $table->unsignedBigInteger('stand_type_id');
            $table->foreign('stand_type_id')->references('id')->on('stands_types')->onDelete('cascade');
        });
    }
}
