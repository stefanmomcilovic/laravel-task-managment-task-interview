<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Task;
use App\View\Components\response;

class TaskController extends Controller
{
    public function index(){
        // Order by order and priority
        $tasks = Task::orderBy('task_order', 'asc')->get();
        // Return to home index view
        return view('index', ['tasks' => $tasks]);
    }

    public function sortable(Request $request){
        // Get all tasks
        $tasks = Task::all();
        // Orders 
        $orders = $request->order;
        // Loop through tasks
        foreach($tasks as $task){
           foreach($orders as $order){
                if($order['id'] == $task->task_id){
                   // Update order
                    $task->task_order = strip_tags($order['position']);
                    $task->save();
                }
           }
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Task order updated successfully'
        ]);
    }

    public function addView(){
        return view('task.add');
    }

    public function addPost(Request $request){
        // Validate request
        $validator = Validator::make($request->all(), [
            'task_name' => 'required|min:3',
            'task_description' => 'required|min:3',
            'task_priority' => 'required|in:low,medium,high',
            'task_status' => 'required|in:todo,in_progress,done'
        ], [
            'task_name.required' => 'Task name is required',
            'task_name.min' => 'Task name must be at least 3 characters',
            'task_description.required' => 'Task description is required',
            'task_description.min' => 'Task description must be at least 3 characters',
            'task_priority.required' => 'Task priority is required',
            'task_priority.in' => 'Task priority must be low, medium or high',
            'task_status.required' => 'Task status is required',
            'task_status.in' => 'Task status must be todo, in progress or done'
        ]);
        // If validation fails
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            // Create new task
            $task = new Task;
            $task->task_name = strip_tags($request->task_name);
            $task->task_description = strip_tags($request->task_description);
            $task->task_priority = strip_tags($request->task_priority);
            $task->task_status = strip_tags($request->task_status);
            $task->task_order = Task::count() + 1;
            $task->save();
            // Return to home index view
            return redirect()->route('home')->with('success', 'Task added successfully');
        }
    }

    public function editView($id){
        // Get task
        $task = Task::where('task_id', $id)->first();
        // If task not found
        if(!$task){
            return redirect()->route('home')->with('error', 'Task not found');
        }
        // Return to edit view
        return view('task.edit', ['task' => $task]);
    }

    public function editPost($id, Request $request){
        // Validation
        $validator = Validator::make($request->all(), [
            'edit_task_name' => 'required|min:3',
            'edit_task_description' => 'required|min:3',
            'edit_task_priority' => 'required|in:low,medium,high',
            'edit_task_status' => 'required|in:todo,in_progress,done'
        ], [
            'edit_task_name.required' => 'Task name is required',
            'edit_task_name.min' => 'Task name must be at least 3 characters',
            'edit_task_description.required' => 'Task description is required',
            'edit_task_description.min' => 'Task description must be at least 3 characters',
            'edit_task_priority.required' => 'Task priority is required',
            'edit_task_priority.in' => 'Task priority must be low, medium or high',
            'edit_task_status.required' => 'Task status is required',
            'edit_task_status.in' => 'Task status must be todo, in progress or done'
        ]);
        // If validation fails
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            // Find task
            $task = Task::where('task_id', $id)->first();
            // If task not found
            if(!$task){
                return redirect()->route('home')->with('error', 'Task not found');
            }
            // Update task
            $task->task_name = strip_tags($request->edit_task_name);
            $task->task_description = strip_tags($request->edit_task_description);
            $task->task_priority = strip_tags($request->edit_task_priority);
            $task->task_status = strip_tags($request->edit_task_status);
            $task->save();
            // Return to home index view
            return redirect()->route('home')->with('success', 'Task updated successfully');
        }
    }

    public function delete(Request $request){
        $id = strip_tags($request->id);
        // Get task
        $task = Task::where('task_id', $id)->first();
        // If task exists
        if($task){
            // Delete task
            $task->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Task deleted successfully'
            ]);
        }
        return response()->json([
            'status' => 'errors',
            'message' => 'Task not found'
        ]);
    }
}
