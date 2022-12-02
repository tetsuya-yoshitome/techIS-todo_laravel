<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    //$fillable
    //メリット：指定したカラムのみ値の代入を許可する。
    //デメリット：カラムが増えるたびにその都度、付け加えなければならない。カラム数が多いテーブルは特に大変。

    /**
        * タスクを保持するユーザーの取得
        */
        public function user()
        {
            return $this->belongsTo(User::class);
        }
}
