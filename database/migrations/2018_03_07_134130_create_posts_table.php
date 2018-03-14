<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('author');
            $table->integer('modified_by')->nullable();
            $table->string('title');
            $table->string('description')->nullable();
            $table->text('content');
            $table->string('status'); //public-draft-private
//            $table->string('type'); //Xác định loại bài
            $table->string('comment_status')->nullable(); //Đánh dấu bài viết có được phép bình luận không
            $table->string('password')->nullable();
            $table->string('img_path')->nullable();
            $table->string('img_disk')->nullable();
            $table->dateTime('date');
            $table->softDeletes();
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
        Schema::dropIfExists('posts');
    }
}
