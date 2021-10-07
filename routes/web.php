<?php



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



Auth::routes();

Route::post('/follow/{user}', [App\Http\Controllers\FollowsController::class, 'store']);

Route::post("/comments", [App\Http\Controllers\CommentController::class, 'store']);
Route::get("/delete/{id}", [App\Http\Controllers\CommentController::class, 'delete']);

Route::post('/like/{post}', [App\Http\Controllers\LikeController::class, 'store']);

Route::get('/', [App\Http\Controllers\PostsController::class, 'index']);
Route::get('/p/create', [App\Http\Controllers\PostsController::class, 'create']);
Route::get('/p/{post}', [App\Http\Controllers\PostsController::class, 'show'])->name('post.show');
Route::delete('/p/delete/{id}', [App\Http\Controllers\PostsController::class, 'delete'])->name('post.delete');
Route::post('/p', [App\Http\Controllers\PostsController::class, 'store']);  
Route::get('/markAsRead', function(){
    auth()->user()->unreadNotifications->markAsRead();
});


Route::get('/search', [\App\Http\Controllers\HomeController::class, 'search'])->name('search.users');

Route::get('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'index'])->name('profile.show');
Route::get('/profile/{user}/edit', [App\Http\Controllers\ProfilesController::class, 'edit'])->name('profile.edit');
Route::patch('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'update'])->name('profile.update');
Route::get('/profile/{user}/following', [\App\Http\Controllers\ProfilesController::class, 'following']);
Route::get('/profile/{user}/followers', [\App\Http\Controllers\ProfilesController::class, 'followers']);
