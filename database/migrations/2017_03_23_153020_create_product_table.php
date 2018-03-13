<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Name',255); // Tên sản phẩm
            $table->string('Alias',255); // Tên sản phẩm không dấu (dùng làm link đường dẫn)
            $table->integer('CatId')->unsigned(); // ID Loại sản phẩm
            $table->foreign('CatId')->references('id')->on('category')->onDelete('cascade');
            $table->tinyInteger('IsHot'); // sản phẩm nổi bật
            $table->tinyInteger('IsHome'); // Chọn sản phẩm hiển thị lên trang chủ
            $table->tinyInteger('IsActive'); // Trạng thái của sản phẩm
            $table->integer('Idx'); // Vị trí của sản phẩm
            $table->integer('Price')->default(0); // Giá của sản phẩm
            $table->integer('Sale')->default(0); // Phầm trăm giảm giá của sản phẩm
            $table->string('Img',2083); // Tên hình ảnh kích thước trung bình của sản phẩm
            $table->text('ShortContent')->nullable(); // Nội dung ngắn của sản phẩm
            $table->longText('Content')->nullable(); // Nội dung của sản phẩm
            $table->integer('CreateBy')->unsigned(); // Id của người đăng sản phẩm
            $table->foreign('CreateBy')->references('id')->on('users')->onDelete('cascade');
            $table->integer('UpdateBy')->unsigned(); // Id của người sửa sản phẩm
            $table->foreign('UpdateBy')->references('id')->on('users')->onDelete('cascade');
            $table->string('MetaTitle')->nullable(); // Tiêu đề của sản phẩm (Dùng SEO)
            $table->string('MetaDescription')->nullable(); // Mô tả của sản phẩm (Dùng SEO)
            $table->string('MetaKeyword')->nullable(); // Từ khóa của sản phẩm (Dùng SEO)
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
        Schema::dropIfExists('product');
    }
}
