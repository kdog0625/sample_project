<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTweetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tweets', function (Blueprint $table) {
            $table->bigIncrements('id');
            //氏名、メールアドレス、url、性別、年齢、お問い合わせ内容
            $table->string('name', 20);
            $table->string('email', 255);
            //空の場合も許可する
            $table->longText('url')->nullable($value = true);
            //マイナスがないプラスだけの値に設定できる。
            $table->boolean('gender')->unsigned();
            $table->tinyInteger('age');
            $table->string('contact', 200);
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
        Schema::dropIfExists('tweets');
    }
}
