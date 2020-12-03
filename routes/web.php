<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\Users\UserController;
use App\Http\Controllers\Dashboard\Articles\ArticleController;
use App\Http\Controllers\Dashboard\Articles\CommentController;
use App\Http\Controllers\Dashboard\Departments\DepartmentController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Dashboard\ImageController;
use App\Http\Controllers\Dashboard\Users\ProfileController;
use App\Models\Image;

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

Route::get('/',[ArticleController::class,'index']);
Route::prefix('dashboard')->name('dashboard.')->middleware(["auth"])->group(function(){

  //dashboard  
Route::get('index',[DashboardController::class,'index'])->name('index');

//users

Route::get('users/{role}/index',[UserController::class,'index'])->name('users.index')->middleware(['role:super_admin|admin|editor']);
Route::get('users/create',[UserController::class,'create'])->name('users.create')->middleware(['role:super_admin|admin|editor']);
Route::post('users/store',[UserController::class,'store'])->name('users.store')->middleware(['role:super_admin|admin|editor']);
Route::delete('users/destroy',[UserController::class,'store'])->name('users.destroy')->middleware(['role:super_admin|admin|editor']);
Route::get('users/{id}/edit',[UserController::class,'edit'])->name('users.edit')->middleware(['role:super_admin|admin|editor']);
Route::post('users/update',[UserController::class,'update'])->name('users.update')->middleware(['role:super_admin|admin|editor']);
Route::get('users/{id}/profile',[ProfileController::class,'edit'])->name('users.profile.edit');
Route::post('users/profile/update',[ProfileController::class,'update'])->name('users.profile.update');


//articles
Route::get('articles/create',[ArticleController::class,'create'])->name('articles.create')->middleware(['role:super_admin|admin|editor|writer']);
Route::post('articles/store',[ArticleController::class,'store'])->name('articles.store')->middleware(['role:super_admin|admin|editor|writer']);
Route::get('articles/{id}/edit',[ArticleController::class,'edit'])->name('articles.edit')->middleware(['role:super_admin|admin|editor']);
Route::delete('articles/{id}/delete',[ArticleController::class,'destroy'])->name('articles.destroy')->middleware(['role:super_admin|admin|editor']);
Route::patch('articles/update',[ArticleController::class,'update'])->name('articles.update')->middleware(['role:super_admin|admin|editor']);
Route::get('articles/{id}/assign',[ArticleController::class,'assignEditor'])->name('article.assignEditor')->middleware(['role:super_admin|admin']);
Route::post('articles/assign',[ArticleController::class,'assignedEditor'])->name('articles.assignedEditor')->middleware(['role:super_admin|admin']);

//Articles -- Images

Route::delete('articles/image/delete/{id}',[ImageController::class,'destroy'])->name('article.image.delete');


//comments
Route::post('articles/{id}/comment',[CommentController::class,'store'])->name('article.comment');
Route::post('article/comment/{id}',[CommentController::class,'replyStore'])->name('article.comment.replays');


//departments
Route::get('departments/create',[DepartmentController::class,'create'])->name('departments.create')->middleware(['role:admin|editor']);
Route::post('departments/store',[DepartmentController::class,'store'])->name('departments.store')->middleware(['role:admin|editor']);
Route::delete('departments/{id}/destroy',[DepartmentController::class,'destroy'])->name('department.destroy')->middleware(['role:admin|editor']);
Route::get('departments/{id}/edit',[DepartmentController::class,'edit'])->name('department.edit')->middleware(['role:admin|editor']);
Route::post('departments/update',[DepartmentController::class,'update'])->name('departments.update')->middleware(['role:admin|editor']);

});
Route::get('departments/index',[DepartmentController::class,'index'])->name('departments.index');
Route::get('articles/{id}/gallery',[ImageController::class,'show'])->name('article.gallery');
Route::get('articles/gallery',[ImageController::class,'gallery'])->name('articles.gallery');
Route::get('articles/index',[ArticleController::class,'index'])->name('articles.index');
Route::get('articles/department/{id}',[ArticleController::class,'departmentArticles'])->name('articles.department');
Route::get('articles/show/{id}',[ArticleController::class,'show'])->name('articles.show');

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
