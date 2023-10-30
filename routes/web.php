<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.register');
})->name('register');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/project/add', [ProjectController::class, 'save'])->name('project.save');
    Route::post('/project/{project}/edit', [ProjectController::class, 'update'])->name('project.edit');
    Route::delete('/project/{project}/destroy', [ProjectController::class, 'destroy'])->name('project.destroy');
    Route::get('/project/{project}/show', [ProjectController::class, 'show'])->name('project.show');

    Route::get('/search', [DashboardController::class, 'searchProjects']);
    // ->name('dashboard.searchProjects');
});

require __DIR__.'/auth.php';


// function () {
//     return view('dashboard', [
//         'projects' => Project::all(),
//         'tickets' => Ticket::all()  //only tickets of the logged in user
//     ]);
// }
