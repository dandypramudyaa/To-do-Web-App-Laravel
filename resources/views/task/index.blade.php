@extends('layout/main')

@section('title', 'My To-do List | To-do Web App')
@php
    $nav = 'Todo';
@endphp

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">My To-do List</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item active">To-do List</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- /.content-header -->

<section class="content">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-list-ul" style="margin-top: 10px;"></i> Task List
                <a href="/task/create">
                    <button type="button" class="btn btn-info float-right">+ Add New Task</button>
                </a>
            </div>
            <div class="card-body">

                @if (session('status'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ session('status') }}</strong>
                    </div>
                @endif
                
                @if (!$tasks->isEmpty()) 
                    
                    @foreach ($tasks as $task)
                    
                        @if ($task->status == 'Unfinished')
                            <div class="callout callout-danger">
                        @else
                            <div class="callout callout-success">
                        @endif

                        <div class="row">
                            <div class="col-sm-10">
                                <div class="widget-content-left">
                                    <div class="widget-heading">{{$task->tanggal}}
                                        @if ($task->status == 'Unfinished')
                                            <div class="badge badge-danger ml-2">Unfinished</div>
                                        @else
                                            <div class="badge badge-success ml-2">Finished</div>
                                        @endif
                                        <div class="widget-heading">{{$task->task}}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="widget-content-right float-right">
                                    <button class="border-0 btn-transition btn btn-outline-success" data-toggle="modal" data-target="#modal-selesai{{$task->id}}">
                                        <i class="fa fa-check"></i>
                                    </button>
                                    <button class="border-0 btn-transition btn btn-outline-danger" data-toggle="modal" data-target="#modal-hapus{{$task->id}}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="modal fade" id="modal-selesai{{$task->id}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-success">
                                            <h4 class="modal-title">Finished Task</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h5>Have you completed this task? ({{$task->task}})</h5>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            <form action="/task/{{$task->id}}" method="POST">
                                                @method('patch')
                                                @csrf
                                                <button type="submit" class="btn btn-success">Yes, I finished</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="modal-hapus{{$task->id}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger">
                                            <h4 class="modal-title">Success Modal</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h5>Do you want to delete this task? ({{$task->task}})</h5>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                                            <form action="task/{{ $task->id }}" method="POST">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Yes, I want to delete it</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        </div>
                    @endforeach
                @else
                    <div style="justify-content: center; font-size: 2em">You haven't created a single to-do list yet</div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection