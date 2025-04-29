<?php

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// redirect to taks index
Route::get('/', function() {
    return redirect()->route('tasks.index');
});

Route::get('/tasks', function() {
    return view('index', [
        'tasks' => \App\Models\Task::latest()->get()
    ]);
})->name('tasks.index');

Route::view('/tasks/create', 'create')->name('tasks.create');

Route::get('/tasks/{id}', function($id){
    return view('show', ['task' => \App\Models\Task::findOrFail($id)]);
})->name('tasks.show');

Route::post('/tasks', function(Request $request) {
    dd($request->all());
})->name('tasks.store');

// 404
Route::fallback(function() {
    return 'Still got somewhere!';
});
