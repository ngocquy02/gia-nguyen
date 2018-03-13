<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSliderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slider', function (Blueprint $table) {
            $table->increments('id');
            $table->text('Name')->nullable(); // Tên của ảnh slider
            $table->string('Url',255)->nullable(); //Đường dẫn kèm theo slider
            $table->string('Type',255)->default('slider'); //loại (slider, quảng cáo, pupup)
            $table->integer('IsActive')->default(0);
            $table->integer('Idx');
            $table->string('Img',2083); // Tên hình ảnh kích thước trung bình của sản phẩm
            $table->string('Locale')->default('vi-vn'); // Ngôn ngữ của sản phẩm
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
        Schema::dropIfExists('slider');
    }
}
