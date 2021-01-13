<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKadai17sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kadai17s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name'); // 名前を保存するカラム
            $table->string('gender');  // 性別を保存するカラム
            $table->string('hobby');  // 趣味を保存するカラム
            $table->string('introduction');  // 自己紹介を保存するカラム
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
        Schema::dropIfExists('kadai17s');
    }
}
