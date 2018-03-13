<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('CartCode')->unique(); // mã đơn đặt hàng
            $table->string('Email'); // Email người đặt hàng
            $table->string('FullName',255); // họ và tên người đặt hàng
            $table->string('Phone')->nullable(); // Số điện của người đặt hàng
            $table->string('Address')->nullable(); // Địa chỉ của người đặt hàng
            $table->text('Note')->nullable(); // Ghi chú
            $table->tinyInteger('IsPay')->default(0); // Trạng thái đơn hàng
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
        Schema::dropIfExists('carts');
    }
}
