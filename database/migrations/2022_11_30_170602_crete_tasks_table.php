<?php

// このファイルにはアップメソッドとダウンメソッドが存在する。アップメソッドは新しいテーブル、カラム、インデックスを追加するもの。
// ダウンメソッドはアップメソッドの操作を元に戻すもの。

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreteTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            //
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            // ->index();はテーブル同士の結合のオプション
            $table->string('name');
            $table->timestamps();
        });
    }
    //php artisan migrateで実行すると、データベースにテーブルが作られる。「構造」を見てみると、上記のカラムができている

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
