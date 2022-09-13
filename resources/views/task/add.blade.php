@extends('layouts.main-layout')
@section('title', 'Add New Task - Task Managment App')

@section('content')
<x-main-navigation />

<div class="container">
    <div class="row justify-center">
        <div class="col-lg-12 mt-5">
            <h1 class="text-center">Add New Task</h1>
        </div>

        <x-response-message />

        <div class="col-lg-12">
            <form action="{{ url('/task/addPost') }}" method="POST">
                @csrf
                <div class="form-group my-3">
                    <label for="task_name">Task name</label>
                    <input type="text" name="task_name" id="task_name" class="form-control" placeholder="Task name" required minlength="3">
                </div>

                <div class="form-group my-3">
                    <label for="task_description">Task description</label>
                    <textarea name="task_description" id="task_description" class="form-control" placeholder="Task description" required minlength="3"></textarea>
                </div>

                <div class="form-group my-3">
                    <label for="task_priority">Task priority</label>
                    <select name="task_priority" id="task_priority" class="form-control" required>
                        <option value="low">Low</option>
                        <option value="medium">Medium</option>
                        <option value="high">High</option>
                    </select>
                </div>

                <div class="form-group my-3">
                    <label for="task_status">Task status</label>
                    <select name="task_status" id="task_status" class="form-control" required>
                        <option value="todo">To do</option>
                        <option value="in_progress">In progress</option>
                        <option value="done">Done</option>
                    </select>
                </div>

                <div class="form-group my-3">
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add new task</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection