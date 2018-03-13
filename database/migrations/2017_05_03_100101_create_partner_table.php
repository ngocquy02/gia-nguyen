<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartnerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Name',255)->nullable(); // Tên của đối tác
            $table->string('Url',255)->nullable(); // đường dẫn đên đối tác
            $table->string('Img',2083)->nullable(); // Tên hình ảnh đại diện của đối tác
            $table->tinyInteger('IsActive')->default(0); // Trạng thái
            $table->string('Locale')->default('vi-vn'); // Ngôn ngữ 
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
        Schema::dropIfExists('partner');
    }
}
