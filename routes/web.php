<?php

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return redirect()->route('tasks.index');
});

Route::get('/tasks', function(){
    return view('index', [
        'tasks' => Task::latest()->get()
    ]);
})->name('tasks.index');

Route::view('/tasks/create', 'create')->name('tasks.create');

Route::get('/tasks/{task}/edit', function(Task $task) {
    return view('edit', ['task' => $task]);
})->name('tasks.edit');

Route::get('/tasks/{task}', function(Task $task){
    return view('show', ['task' => $task]);
})->name('tasks.show');

Route::post('/tasks', function(TaskRequest $request) {
    $task = Task::create($request->validated());

    return redirect()->route('tasks.show', ['task' => $task->id])->with('success', 'Task created successfully.');
})->name('tasks.store');

Route::put('/tasks/{task}', function(TaskRequest $request, Task $task) {
    $task->update($request->validated());

    return redirect()->route('tasks.show', ['task' => $task->id])->with('success', 'Task edited successfully.');
})->name('tasks.update');

// Route::get('/xxx', function() {
//     return 'Hello';
// })->name('hello');

// Route::get('/greet/{name}', function($name) {
//     return 'Hello ' . $name . '!';
// });

// Route::get('/hallo', function() {
//     return redirect()->route('hello');
// });

// Route::fallback(function() {
//     return '404!';
// });
