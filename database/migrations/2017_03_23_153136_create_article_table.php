<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Name'); // Tên bài viết
            $table->string('Alias'); // Tên bài viết không dấu (dùng làm link đường dẫn)
            $table->integer('CatId')->unsigned(); // Loại bài viết
            $table->foreign('CatId')->references('id')->on('category')->onDelete('cascade');
            $table->tinyInteger('IsHot')->default(0); // Bài viết nổi bật mặc định là 0
            $table->tinyInteger('IsHome')->default(0); // Chọn bài viết hiển thị lên Trang chủ mặc định là 0
            $table->tinyInteger('IsActive')->default(1); // Trạng thái của bài viết mặc định là hiển thị
            $table->integer('Idx'); // Vị trí của bài viết
            $table->string('Img',2083); // Tên hình ảnh kích thước trung bình của bài viết
            $table->text('Tag')->nullable(); // Tag bài viết
            $table->text('ShortContent')->nullable(); // Nội dung ngắn của bài viết
            $table->longText('Content')->nullable(); // Nội dung của bài viết
            $table->integer('CreateBy')->unsigned(); // Id của người viết bài
            $table->foreign('CreateBy')->references('id')->on('users')->onDelete('cascade');
            $table->integer('UpdateBy')->unsigned(); // Id của người sửa bài
            $table->foreign('UpdateBy')->references('id')->on('users')->onDelete('cascade');
            $table->string('MetaTitle')->nullable(); // Tiêu đề của bài viết (Dùng SEO)
            $table->string('MetaDescription')->nullable(); // Mô tả của bài viết (Dùng SEO)
            $table->string('MetaKeyword')->nullable(); // Từ khóa của bài viết (Dùng SEO)
            $table->string('Locale')->default('vi-vn'); // Ngôn ngữ của bài viết
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
        Schema::dropIfExists('article');
    }
}
