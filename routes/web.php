<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPanel;
use Illuminate\Support\Facades\Route;

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


// authMiddleware

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/posts/fetch', [PostController::class, 'fetch'])->name('posts.fetch');
Route::resources(['login' => LoginController::class]);
Route::resources(['register' => RegisterController::class]);
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

// Pages
Route::get('/about', function() { return view('pages.about'); })->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'sendMail'])->name('contact.sendMail');


Route::post('/posts/{post}', [CommentController::class, 'store'])->name('comments.store');
Route::delete('/posts/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
Route::resource('posts', PostController::class);

Route::middleware(['isUser'])->group(function() {
  Route::resource('users', UserPanel::class);
  Route::get('comments/{user}', [CommentController::class, 'index'])->name('comments.index');
  Route::delete('comments/{comment}', [CommentController::class, 'index'])->name('comments.destroy');
});

Route::get('posts/category/{category}', [PostController::class, 'getPostsByCategory'])->name('posts.category');
Route::get('posts/user/{user}', [PostController::class, 'getPostsByUser'])->name('posts.user');


Route::name('admin.')->middleware('isAdmin')->group(function() {
  Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('/paginate', [AdminController::class, 'pagination']);
    Route::resource('users', UserController::class);
    Route::resource('posts', PostController::class)->except(['index']);
    Route::get('/comments', [AdminController::class, 'viewComments'])->name('comments');
    Route::delete('/comments/${comment}', [CommentController::class, 'deleteCommentAdmin'])->name('comments.destroy');
    Route::get('/posts', [PostController::class, 'getPostsAdminView'])->name('posts');
  });
});

// ->middleware('isAdmin')