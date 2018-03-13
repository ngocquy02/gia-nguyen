<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact', function (Blueprint $table) {
            $table->increments('id');
            $table->string('FullName')->nullable(); // Họ và tên của khách hàng
            $table->string('Email')->nullable(); // Email cũng như tên đăng nhập của khách hàng
            $table->string('Phone')->nullable(); // Số điện thoại
            $table->string('Address')->nullable(); // Địa chỉ
            $table->tinyInteger('Status')->default(0); // Trạng thái
            $table->text('Content')->nullable(); // Số điện thoại
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
        Schema::dropIfExists('contact');
    }
}
