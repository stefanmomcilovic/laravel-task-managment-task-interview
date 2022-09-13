@extends('layouts.main-layout')
@section('title', 'Home - Task Managment App')

@section('content')
<x-main-navigation />

<div class="container">
    <div class="row justify-center">
        <div class="col-lg-12 mt-5">
            <h1 class="text-center">Task Managment App</h1>
            <p class="text-center">This is a simple task managment app built with Laravel 9, Bootstrap 5, FontAwesome, jQuery, jQueryUI and SweetAlert2.</p>

            <x-response-message />
        </div>
        <div class="col-lg-12">
            <div class="d-flex justify-content-between mb-5">
                <h2>My tasks</h2>
                <a href="{{ url('/task/add') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add task</a>
            </div>
        </div>

        <div class="col-lg-12">
            <div id="sortable">
                @foreach($tasks as $task)
                    <div class="col-lg-12 my-3">
                        <div class="card" data-id="{{ $task->task_order }}">
                            <div class="card-header d-flex justify-content-between">
                                <div>
                                    <h5>{{ $task->task_name }}</h5>
                                    <p>Priority: 
                                        @if($task->task_priority == 'low')
                                            <span class="badge bg-success">Low</span>
                                        @elseif($task->task_priority == 'medium')
                                            <span class="badge bg-warning">Medium</span>
                                        @elseif($task->task_priority == 'high')
                                            <span class="badge bg-danger">High</span>
                                        @endif
                                    </p>
                                    <p>Status:
                                        @if($task->task_status == 'todo')
                                            <span class="badge bg-primary">To do</span>
                                        @elseif($task->task_status == 'in_progress')
                                            <span class="badge bg-warning">In progress</span>
                                        @elseif($task->task_status == 'done')
                                            <span class="badge bg-success">Done</span>
                                        @endif
                                    </p>
                                </div>
                                <div>
                                    <a href="{{ url('/task/edit', $task->task_id) }}" class="btn btn-warning text-white"><i class="fa-solid fa-edit"></i> Edit</a>
                                    <a href="#" data-delete-id="{{ $task->task_id }}" class="btn btn-danger delete-btn"><i class="fa-solid fa-trash"></i> Delete</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <p>{{ $task->task_description }}</p>
                            </div>
                            <div class="card-footer text-muted">
                                @if($task->task_created_at == $task->task_updated_at)
                                    Created at: {{ $task->task_created_at }}
                                @else
                                    Updated at: {{ $task->task_updated_at }}
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
    $( "#sortable" ).sortable({
        items: "div.col-lg-12>div.card",
        cursor: 'move',
        opacity: 0.5,
        update: function(){
            sendOrderToServer();
        }
    });

    function sendOrderToServer(){
        var order = [];
        var token = $("meta[name='csrf-token']").attr("content");

        $('div.col-lg-12>div.card').each(function(index, element){
            order.push({
                id: $(this).attr('data-id'),
                position: index + 1
            });
        });

        console.log(order);
        
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "{{ url('/task/sortable') }}",
            data: {
                order: order,
                _token: token
            },
            success: function(response){
                if(response.status == "success"){
                    console.log(response);
                }else{
                    console.log(response);
                }
            },
            error: function(response){
                console.log(response);
            }
        });
    }

    $('.delete-btn').click(function(e){
        e.preventDefault();
        // Get id from data attribute
        var id = $(this).attr('data-delete-id');
        // Swal alert
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Ajax request
                $.ajax({
                    type: "DELETE",
                    dataType: "json",
                    url: "{{ url('/task/delete') }}",
                    data: {
                        id: id,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response){
                        if(response.status == "success"){
                            Swal.fire(
                                'Deleted!',
                                'Your task has been deleted.',
                                'success'
                            ).then((result) => {
                                if(result.isConfirmed){
                                    location.reload();
                                }
                            });
                        }else{
                            Swal.fire(
                                'Error!',
                                'Something went wrong.',
                                'error'
                            );
                        }
                    },
                    error: function(response){
                        Swal.fire(
                            'Error!',
                            'Something went wrong.',
                            'error'
                        );
                    }
                });
            }
        });
    });
});
</script>
@endsection