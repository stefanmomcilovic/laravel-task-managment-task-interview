@extends('layouts.main-layout')
@section('title', 'Edit Task - Task Managment App')

@section('content')
<x-main-navigation />

<div class="container">
    <div class="row justify-center">
        <div class="col-lg-12 mt-5">
            <h1 class="text-center">Edit Task</h1>
        </div>

        <x-response-message />

        <div class="col-lg-12">
            <form action="{{ url('/task/editPost', $task->task_id) }}" method="POST">
                @csrf
                <div class="form-group my-3">
                    <label for="edit_task_name">Task name</label>
                    <input type="text" name="edit_task_name" id="edit_task_name" class="form-control" placeholder="Task name" value="{{ $task->task_name }}" required minlength="3">
                </div>

                <div class="form-group my-3">
                    <label for="edit_task_description">Task description</label>
                    <textarea name="edit_task_description" id="edit_task_description" class="form-control" placeholder="Task description" required minlength="3">{{ $task->task_description }}</textarea>
                </div>

                <div class="form-group my-3">
                    <label for="edit_task_priority">Task priority</label>
                    <select name="edit_task_priority" id="edit_task_priority" class="form-control" required>
                        <option value="low" @if($task->task_priority == 'low') selected @endif>Low</option>
                        <option value="medium" @if($task->task_priority == 'medium') selected @endif>Medium</option>
                        <option value="high" @if($task->task_priority == 'high') selected @endif>High</option>
                    </select>
                </div>

                <div class="form-group my-3">
                    <label for="edit_task_status">Task status</label>
                    <select name="edit_task_status" id="task_status" class="form-control" required>
                        <option value="todo" @if($task->task_status == 'todo') selected @endif>To do</option>
                        <option value="in_progress" @if($task->task_status == 'in_progress') selected @endif>In progress</option>
                        <option value="done" @if($task->task_status == 'done') selected @endif>Done</option>
                    </select>
                </div>

                <div class="form-group my-3">
                    <button type="submit" class="btn btn-warning"><i class="fa-solid fa-edit"></i> Edit task</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection