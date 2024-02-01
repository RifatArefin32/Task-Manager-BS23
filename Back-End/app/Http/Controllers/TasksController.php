<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tasks;


class TasksController extends Controller
{
    public function all(){
        return Tasks::all();
    }
    public function create(Request $request)
    {
         // Validate the request data
         $request->validate([
            "title"=>"required",
            'description' => 'required',
            'status' => 'required',
        ]);

        //  get the user
        $user = auth()->user();
 
        // create a task
        $task = Tasks::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'user_id' => $user->id,
        ]);
        $task->save();


        // response
        return response([
            "Task"=>$task,
            "message"=>"Task Created",
            "success"=>true,
        ],201);
    }

    public function retrieve()
    {
        return auth()->user()->tasks;
    }

    public function taskofid($id)
    {
        $task = auth()->user()->tasks()->find($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        return response()->json(['task' => $task], 200);
    }
    
    public function update(Request $request,$id)
    {
         // Validate the request data
         $request->validate([
            "title"=>"required",
            'description' => 'required',
            'status' => 'required',
        ]);

        // create a task
        $task = Tasks::find($id);
        $task->update($request->all());


        // response
        return response([
            "message"=>"Task Updated",
            "success"=>true,
        ],200);
    }


    public function delete($id)
    {
        $task= Tasks::find($id);
        $task->delete();
        return response(['message' => 'Task deleted successfully'],200);
    }

    


}
