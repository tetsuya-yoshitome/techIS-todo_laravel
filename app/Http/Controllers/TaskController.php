<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Task;

use App\Repositories\TaskRepository;

class TaskController extends Controller
{
    /**
    * タスクリポジトリ
    *
    * @var TaskRepository
    */
    protected $tasks;
    
    /**
        * コンストラクタ。認証機能をタスクコントローラで有効にするためのコード
        *
        * @return void
        */
        public function __construct(TaskRepository $tasks)
        {
            $this->middleware('auth');

            $this->tasks = $tasks;
        }

/**
        * タスク一覧
        *
        * @param Request $request
        * @return Response
        */
        public function index(Request $request)
        {
            // $tasks = Task::orderBy('created_at', 'asc')->get();
            // $tasks = $request->user()->tasks()->get(); //＄request、ユーザーメソッドにて認証済みのユーザーを取得している。そのユーザーが保持するタスク一覧を取得している
            return view('tasks.index', [
            'tasks' => $this->tasks->forUser($request->user()), //Controllerで作成したリポジトリを使用し、リポジトリーでデータ操作を行う
            ]);
        }
    

/**
        * タスク登録
        *
        * @param Request $request
        * @return Response
        */
        public function store(Request $request)
        {
            $this->validate($request, [ //validate：パラメーターが有効かどうかのチェックをしている
            // $thisは直近の$～を指す。
                'name' => 'required|max:255', //←ネームは必須で最大255文字、の意味
            ]);
     
            // // タスク作成
            // Task::create([ //SQLのインサート文
            //     'user_id' => 0,
            //     'name' => $request->name
            // ]);
            $request->user()->tasks()->create([
                'name' => $request->name,
            ]);
            return redirect('/tasks');
        }
     
        /**
            * タスク削除
            *
            * @param Request $request
            * @param Task $task
            * @return Response
            */
        public function destroy(Request $request, Task $task)
        {
            $this->authorize('destroy', $task);
        $task->delete();
        return redirect('/tasks');
        }
    }