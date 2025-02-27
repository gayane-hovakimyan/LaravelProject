<?php

use App\Http\Requests\TaskRequest;
use \App\Models\Task;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



// root
Route::get('/', function () {
    return redirect()->route('tasks.index');
});



// responsible for getting all the tasks

Route::get('/tasks', function ()  {
    return view('index',[
        'tasks'=>Task::latest()->paginate(10)
    ]);
})-> name('tasks.index');


// forms part
Route::view('/tasks/create', 'create')
    ->name('tasks.create');

// edit part

Route::get('/tasks/{task}/edit', function(Task $task) {
    return view('edit', [
        'task' => $task ]);
})->name('tasks.edit');

// id part


Route::get('/tasks/{task}', function(Task $task) {
        return view('show',[
        'task'=> $task]);
})->name('tasks.show');


// create, post

Route::post('/tasks',function (TaskRequest $request) {

    $task = Task::create($request->validated());

    return redirect()-> route('tasks.show',['task'=> $task->id])
    ->with('success','Task created successfully!');
})-> name('tasks.store');


// for update field, put

Route::put('/tasks/{task}',function ( Task $task, TaskRequest $request) {

    $task -> update($request->validated());

    return redirect()-> route('tasks.show',['task'=> $task->id])
    ->with('success','Task updated successfully!');
})-> name('tasks.update');


// deleting

Route::delete( '/tasks/{task}', function( Task $task){
    $task->delete();

    return redirect()-> route('tasks.index')
    ->with('success','Successfully deleted');
})->name('tasks.destroy');


// fot toglle-complete

Route::put('/tasks/{task}/toggle-complete', function ( Task $task) {
    $task -> toggleComplete();

    return redirect()-> back()->with('success','Task succesfully updated!!');
})-> name('tasks.toggle-completed') ;
