<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThreadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('threads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug')->unique()->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('channel_id');
            $table->string('title');
            $table->text('body');
            $table->unsignedBigInteger('best_reply_id')->nullable();
            $table->boolean('locked')->default(false);
            $table->timestamps();

            $table->foreign('best_reply_id')
                ->references('id')
                ->on('replies')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('threads');
    }
}
