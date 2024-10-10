<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmailController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
 
require __DIR__.'/auth.php';
Route::middleware(['auth', 'role:admin'])->group(function(){
    Route::get('admin/dashboard', [AdminController::class, 'AdminDashBoard'])->name('admin.dashboard');
    Route::get('admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('admin/profile', [AdminController::class, 'admin_profile']);
    Route::post('admin_profile/update', [AdminController::class, 'admin_profile_update']);
    Route::get('admin/users', [AdminController::class, 'admin_users']);
    Route::get('admin/users/view/{id}', [AdminController::class, 'admin_users_view']);
    Route::get('admin/users/add', [AdminController::class, 'admin_add_users']);
    Route::post('admin/users/add', [AdminController::class, 'admin_add_users_store']);
    Route::get('admin/email/compose', [EmailController::class, 'admin_email_compose']);
    Route::post('admin/email/compose_post', [EmailController::class, 'admin_email_compose_post']);
    Route::get('admin/email/sent', [EmailController::class, 'admin_email_sent']);
    Route::get('admin/email_sent', [EmailController::class, 'admin_email_sent_delete']);
    Route::get('admin/email/read/{id}', [EmailController::class, 'admin_email_read']);
    Route::get('admin/email/read_delete/{id}', [EmailController::class, 'admin_email_read_delete']);
    

});
Route::middleware(['auth', 'role:agent'])->group(function(){
     Route::get('agent/dashboard', [AgentController::class, 'AgentDashBoard'])->name('agent.dashboard');
});
Route::middleware(['auth', 'role:user'])->group(function(){
    Route::get('user/dashboard', [UserController::class, 'UserDashBoard'])->name('user.dashboard');
});

Route::get('set_new_password/{token}', [AdminController::class, 'set_new_password']);
Route::post('set_new_password/{token}',  [AdminController::class, 'set_new_password_post']);
Route::get('admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');