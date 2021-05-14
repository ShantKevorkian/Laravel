<?php

use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Models\Post;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::get('/posts', [PostsController::class, 'index'])->name('posts.index');
Route::get('/posts/store', function () {
    return view('createpost');
});
Route::get('/posts/{id}', function ($id) {
    $postId = Post::where('id', $id)->where('user_id', auth()->user()->id)->first();
    abort_if(!$postId, 403, 'Unauthorized access');
    return view('editpost', ['userPost' => $postId]);
})->name('posts.edit');

Route::put('/posts/update/{id}', [PostsController::class, 'update'])->name('posts.update');
Route::delete('/posts/delete/{id}', [PostsController::class, 'delete'])->name('posts.delete');
Route::post('/posts/store', [PostsController::class, 'store'])->name('posts.store');
Route::put('/profile/updateProfile', [ProfileController::class, 'updateProfile'])->name('profile.update.profile');
Route::put('/profile/updateDetail', [ProfileController::class, 'updateDetail'])->name('profile.update.detail');
Route::put('/profile/upload', [ProfileController::class, 'upload'])->name('profile.upload');

