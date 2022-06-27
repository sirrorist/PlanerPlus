<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function edit(Request $request)
    {
        $validateData = Validator::make($request->all(), [
            'title' => 'required',
            'discription' => 'required',
            'status' => 'required',
            'priority' => 'required',
            'close_at' => 'required',
            'responsible' => 'required'
        ]);

        $respCheck = false;

        if ($validateData->fails()){
            return response()->json(['errors' => $validateData->errors()->all()]);
        } else {
            $affected = DB::table('tasks')
              ->where('id', $request->id)
              ->update([
                'title' => $request->title, 
                'discription' => $request->discription, 
                'close_at' => $request->close_at, 
                'priority' => $request->priority, 
                'status' => $request->status, 
                'responsible' => $request->responsible,
                'updated_at' => date('Y-m-d H:i:s')                
            ]);
            return response()->json();
        }
    }

    public function save(Request $request)
    {
        $validateData = Validator::make($request->all(), [
            'title' => 'required',
            'discription' => 'required',
            'status' => 'required',
            'priority' => 'required',
            'close_at' => 'required',
            'responsible' => 'required'
        ]);
        $respCheck = false;
        if ($validateData->fails()){
            return response()->json(['errors' => $validateData->errors()->all()]);
        } else {
            $newTask = new Task();
            $newTask->title = $request->title;
            $newTask->discription = $request->discription;
            $newTask->close_at = $request->close_at;
            $newTask->priority = $request->priority;
            $newTask->status = $request->status;
            $newTask->creator = Auth::id();
            $newTask->responsible = $request->responsible;
            $newTask->save();
            return response()->json();
        }
    }

    public function view(Request $request)
    {
        $tasks = DB::table('tasks')->get();
        $users = DB::table('users')->select('id', 'firstName', 'lastName', 'middleName', 'leader')->get();  
        $date = date('Y-m-d H:i:s');

        if($request->ajax()){
            switch ($request->orderType) {
                case 'default_sort':
                    $tasks = DB::table('tasks')->orderBy('updated_at', 'DESC')->get();
                    break;
                case 'date_sort':
                    $tasks = DB::table('tasks')->orderBy('close_at')->get();
                    break;
                case 'responsible_sort':
                    $tasks = DB::table('tasks')->orderBy('responsible')->get();
                    break;                    
            };
            return view('task.order', [
                'tasks' => $tasks,
                'date' => $date, 
                'users' => $users, 
                'auth_id' => Auth::id()
            ]);
        }

        return view('tasks', [
            'tasks' => $tasks, 
            'date' => $date, 
            'users' => $users, 
            'auth_id' => Auth::id()
        ]);
    }
    public function report(Request $request)
    {
        return view ('report');
    }
}
