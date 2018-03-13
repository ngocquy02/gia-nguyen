<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('FullName'); // Họ và tên của user
            $table->string('Email')->unique(); // Email cũng như tên đăng nhập của user
            $table->string('Password'); // Mật khẩu đăng nhập
            $table->string('Phone'); // Số điện thoại
            $table->string('Skype'); // Skype
            $table->string('Facebook'); // Facebook
            $table->string('Google'); // Google Plus
            $table->string('Sex'); // Giới tính
            $table->string('Img',2083); // Hình ảnh đại diện
            $table->tinyInteger('IsActive'); // Trạng thái của user
            $table->tinyInteger('Role'); // Chức vụ (quyền) của user
            $table->rememberToken();
            $table->timestamps(); // ngày tạo và ngày sửa
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
