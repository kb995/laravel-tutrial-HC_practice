<?php

namespace App\Http\Controllers;

use App\Folder;
use App\Task;
use App\Http\Requests\CreateTask;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    // 引数$idはルーティングの {id} から受け取る
    public function index(int $id)
    {
        // 全てのフォルダー取得
        $folders = Folder::all();
        // 選択中のフォルダー
        $current_folder = Folder::find($id);
        // 選択中のフォルダーに紐づくタスク
        $tasks = $current_folder->tasks()->get();

        return view('tasks/index', [
            'folders' => $folders,
            'current_folder_id' => $current_folder->id,
            'tasks' => $tasks,
        ]);
    }

    public function showCreateForm(int $id)
    {
        return view('tasks/create', [
            'folder_id' => $id
        ]);
    }

    public function create(int $id, CreateTask $request)
    {
        $current_folder = Folder::find($id);
        $task = new Task();
        $task->title = $request->title;
        $task->due_date = $request->due_date;

        // リレーションを使って保存
        $current_folder->tasks()->save($task);

        return redirect()->route('tasks.index', [
            'id' => $current_folder->id,
        ]);
    }

}
