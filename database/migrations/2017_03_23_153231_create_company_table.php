<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Name')->nullable(); // Tên công ty
            $table->string('Address')->nullable(); // Địa chỉ của công ty
            $table->string('Phone')->nullable(); // Số điện thoại của công ty
            $table->string('Hotline')->nullable(); // Hotlien công ty
            $table->string('Tax')->nullable(); // Mã số thuế của công ty
            $table->string('Email')->nullable(); // Email của công ty
            $table->string('Skype')->nullable(); // Skype của công ty
            $table->string('Facebook')->nullable(); // Facebook của công ty
            $table->string('Google')->nullable(); // Google Plus của công ty
            $table->string('Twitter')->nullable();
            $table->string('Viber')->nullable();
            $table->string('Zalo')->nullable(); // Zalo của công ty của công ty
            $table->string('Logo',2083); // Tên hình ảnh logo của công ty
            $table->string('Img',2083)->nullable(); // Tên hình ảnh header của trang web
            $table->text('Map'); // Nhúng Map của công ty
            $table->text('Analytic')->nullable(); // Mã analytic của công ty
            $table->text('Chatbox')->nullable(); // Mã chatbox của công ty
            $table->string('MetaTitle')->nullable(); // Tiêu đề của công ty (Dùng SEO)
            $table->string('MetaDescription')->nullable(); // Mô tả của công ty (Dùng SEO)
            $table->string('MetaKeyword')->nullable(); // Từ khóa của công ty (Dùng SEO)
            $table->string('Locale')->default('vi-vn'); // Ngôn ngữ của công ty
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
        Schema::dropIfExists('company');
    }
}
