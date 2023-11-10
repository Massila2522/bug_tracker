<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AllTicketsController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.register');
})->name('register');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/profile/{user}', [ProfileController::class, 'adminUpdate'])->name('profile.adminUpdate');
    Route::delete('/profile/{user}', [ProfileController::class, 'adminDestroy'])->name('profile.adminDestroy');

    Route::post('/project/add', [ProjectController::class, 'save'])->name('project.save');
    Route::post('/project/{project}/edit', [ProjectController::class, 'update'])->name('project.edit');
    Route::delete('/project/{project}/destroy', [ProjectController::class, 'destroy'])->name('project.destroy');
    Route::get('/project/{project}/show', [ProjectController::class, 'show'])->name('project.show');

    Route::get('/search', [DashboardController::class, 'searchProjects']);
    // ->name('dashboard.searchProjects');

    Route::post('/ticket/add', [TicketController::class, 'save'])->name('ticket.save');
    Route::post('/ticket/{ticket}/edit', [TicketController::class, 'update'])->name('ticket.edit');
    Route::delete('/ticket/{ticket}/destroy', [TicketController::class, 'destroy'])->name('ticket.destroy');
    Route::get('/ticket/{ticket}/show', [TicketController::class, 'show'])->name('ticket.show');

    Route::post('/comment/add', [CommentController::class, 'save'])->name('comment.save');
    Route::post('/comment/{comment}/edit', [CommentController::class, 'update'])->name('comment.edit');
    Route::delete('/comment/{comment}/destroy', [CommentController::class, 'destroy'])->name('comment.destroy');

    Route::get('/tickets', [AllTicketsController::class, 'index'])->name('tickets');

    Route::get('/administration', [AdminController::class, 'index'])->name('administration');
});

require __DIR__.'/auth.php';
