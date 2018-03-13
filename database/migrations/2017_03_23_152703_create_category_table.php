<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Name'); // Tên Category
            $table->string('Alias'); // Tên Category không dấu (dùng làm link đường dẫn)
            $table->tinyInteger('Type'); // Loại Category
            $table->integer('ParentID'); // Id của Category cha
            $table->tinyInteger('Level'); // Level của Category
            $table->tinyInteger('IsActive'); // Trạng thái của Category
            $table->integer('Idx'); // Vị trí của Category
            $table->string('Description')->nullable(); // Mô tả về Category
            $table->string('Icon',2083)->nullable(); // Tên hình ảnh icon của Category
            $table->string('Img',2083)->nullable(); // Tên hình ảnh kích thước trung bình của Category
            $table->string('Banner',2083)->nullable(); // Tên hình ảnh kích thước lớn của Category
            $table->string('MetaTitle')->nullable(); // Tiêu đề của Category (Dùng SEO)
            $table->string('MetaDescription')->nullable(); // Mô tả của Category (Dùng SEO)
            $table->string('MetaKeyword')->nullable(); // Từ khóa của Category (Dùng SEO)
            $table->string('Locale')->default('vi-vn'); // Ngôn ngữ của Category
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
        Schema::dropIfExists('category');
    }
}
