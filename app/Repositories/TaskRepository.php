<?php

//データアクセスに関することはリポジトリだけに書き、コントローラでこれを呼び出すと、コントローラでのデータ操作を気にする必要がなくなる。
 
namespace App\Repositories;
 
use App\Models\User;
 
class TaskRepository
{
    /**
        * ユーザーのタスク一覧取得
        *
        * @param User $user
        * @return Collection
        */
    public function forUser(User $user)
    {
        return $user->tasks()
            ->orderBy('created_at', 'asc')
            ->get();
    }
}