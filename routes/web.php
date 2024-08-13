<?php

use App\Http\Controllers\Auth\DashboardController;
use App\Http\Controllers\Auth\CategoriesController;
use App\Http\Controllers\Auth\TagController;
use App\Http\Controllers\Auth\PostController;
use App\Http\Controllers\Auth\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\BlogController;
use App\Http\Controllers\Site\CommentController;

Route::get('/', function () {
    return view('site.index');
});

Auth::routes([
    'register' => true
]);

Route::middleware('auth')->group(function(){
    Route::get('dashboard', [DashboardController::class,'dashboard'])->name('dashboard');

    Route::resource('auth/posts',PostController::class);

    Route::get('auth/categories', [CategoriesController::class, 'openCategoriesPage'])->name('auth.categories');

    Route::get('auth/tags', [TagController::class, 'openTagPage'])->name('auth.tags');

    Route::get('auth/profile', [ProfileController::class, 'OpenProfilePage'])->name('auth.profile.index');

    Route::post('auth/profile', [ProfileController::class, 'StoreProfile'])->name('auth.profile.store');

});

Route::get('/', [BlogController::class, 'index'])->name('home');
Route::get('single-blog/{id}', [BlogController::class, 'openSingleBlog'])->name('single-blog');

Route::post('post/comment/{postId}', [CommentController::class, 'postComment'])->name('post.comment')->middleware('auth');
Route::post('comment/reply/{commentId}', [CommentController::class, 'CommentReply'])->name('comment.reply');
Route::post('comment/reply/delete/{replyId}', [CommentController::class, 'commentReplyDelete'])->name('comment.reply.delete');
