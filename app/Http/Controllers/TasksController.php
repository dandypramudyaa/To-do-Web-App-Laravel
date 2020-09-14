<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use App\User;

class TasksController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = session()->get('id');
        // $tasks = Task::all();
        $tasks = Task::where('id_user', $id)->orderBy('tanggal', 'asc')->get();

        if (session()->has('id')) {
            return view('task/index', ['tasks' => $tasks]);
        } else {
            return redirect('/');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (session()->has('id')) {
            return view('task/create');
        } else {
            return redirect('/');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'task' => 'required',
            'date' => 'required'
        ]);

        $task = $request->input('task');
        $date = $request->input('date');

        Task::create([
            'task' => $task,
            'tanggal' => $date,
            'status' => 'Unfinished',
            'id_user' => session()->get('id')
        ]);

        return redirect('/task')->with('status', 'Successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        Task::where('id', $task->id)
            ->update(['status' => 'Finished']);

        return redirect('/task')->with('status', 'Successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        Task::destroy($task->id);
        return redirect('/task')->with('status', 'Successfully deleted!');
    }
}
