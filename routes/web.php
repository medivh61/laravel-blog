<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MainArticleController;
use App\Http\Controllers\MainNoteController;
use App\Http\Controllers\MainVideoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\VideoController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});




/*TODO Перенести роутеры в middleware
*/
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/articles', ArticleController::class);
    Route::post('/articles/{article}/toggle_like', [ArticleController::class, 'toggleLike']);
    Route::post('/articles/{article}/comment', [ArticleController::class, 'comment']);
    Route::get('/articles/{article}/comment', [ArticleController::class, 'commentList']);


    Route::resource('/notes', NoteController::class);
    Route::post('/notes/{note}/toggle_like', [NoteController::class, 'toggleLike']);
    Route::post('/notes/{note}/comment', [NoteController::class, 'comment']);
    Route::get('/notes/{note}/comment', [NoteController::class, 'commentList']);


    Route::resource('/videos', VideoController::class);
    Route::post('/videos/{video}/toggle_like', [VideoController::class, 'toggleLike']);
    Route::post('/videos/{video}/comment', [VideoController::class, 'comment']);
    Route::get('/videos/{video}/comment', [VideoController::class, 'commentList']);



    Route::get('/show-article', MainArticleController::class)->name('show.article');
    Route::get('/show-note', MainNoteController::class)->name('show.note');
    Route::get('/show-video', MainVideoController::class)->name('show.video');

    Route::inertia('admin-panel', 'Admin/AdminPanel')->name('admin.panel');
    Route::inertia('/', 'Main')->name('home');
});

require __DIR__.'/auth.php';
