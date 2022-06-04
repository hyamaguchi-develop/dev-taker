<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotoInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photoInfos', function (Blueprint $table) {
            $table->bigIncrements('photo_id');
            // 画像のIDで紐付け
            // $table->increments('image_id');
            $table->string('shooting_location');
            $table->string('prefecture');
            $table->string('iso');
            $table->string('f_value');
            $table->string('shutter_speed');
            $table->string('time_zone');
            $table->boolean('is_tripod');
            $table->string('other');
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
        Schema::dropIfExists('photoInfos');
    }
}