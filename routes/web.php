<?php

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\AuthorMiddleware;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SubscriberController as AdminSubscriberController;
use App\Http\Controllers\Author\AuthorPostController;
use App\Http\Middleware\RedirectAuthenticatedMiddleware;
use App\Http\Controllers\Author\AuthorDashboardController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/subscriber', [SubscriberController::class, 'store'])->name('subscriber.store');


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware'=>['auth', 'admin']], function () 
//     {
//         Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        
    
//     });

    // Route::group(['prefix' => 'author', 'namespace' => 'Author', 'middleware'=>['auth', 'author']], function () 
    // {
    //     Route::get('/dashboard', [DashboardController::class, 'index'])->name('author.dashboard');
    // });
// ............................................................................................................
    Route::prefix('admin')->name('admin.')->middleware([AdminMiddleware::class])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('settings', [SettingsController::class, 'index'])->name('admin.settings');
        Route::put('profileUpdate', [SettingsController::class, 'updateProfile'])->name('profile.update');
        Route::resource('tag', TagController::class);
        Route::resource('category', CategoryController::class);
        Route::resource('post', PostController::class);
        Route::put('/post/{id}/approve', [PostController::class, 'approve'])->name('post.approve');
        Route::get('pending/post', [PostController::class, 'pending'])->name('post.pending');
        Route::get('subscriber', [AdminSubscriberController::class, 'index'])->name('subscriber.index');
        Route::delete('subscriber/{id}/destroy', [AdminSubscriberController::class, 'destroy'])->name('subscriber.destroy');


    
       });

    Route::prefix('author')->name('author.')->middleware([AuthorMiddleware::class])->group(function () {
        
        Route::get('/dashboard', [AuthorDashboardController::class, 'index'])->name('author.dashboard');
       Route::resource('post',  AuthorPostController::class);
         
});

    Route::middleware([RedirectAuthenticatedMiddleware::class])->group(function () {
        
        Route::get('/login', function () { return view('auth.login'); })->name('login');
        
        Route::get('/register', function () { return view('auth.register'); })->name('register');
        Route::get('/password/reset', function () { return view('auth.passwords.email'); })->name('password.request');
        Route::get('/password/reset/{token}', function () { return view('auth.passwords.reset'); })->name('password.reset');
        Route::get('/password/confirm', function () { return view('auth.passwords.confirm'); })->name('password.confirm');
        Route::get('/email/verify', function () { return view('auth.verify'); })->name('verification.notice');
        Route::get('/email/verify/{id}/{hash}', function () { return view('auth.verify'); })->name('verification.verify');
        Route::get('/email/verification-notification', function () { return view('auth.verify'); })->name('verification.resend');
        Route::get('/password/email', function () { return view('auth.passwords.email'); })->name('password.email');
        Route::get('/password/reset', function () { return view('auth.passwords.reset'); })->name('password.reset');
        Route::get('/password/confirm', function () { return view('auth.passwords.confirm'); })->name('password.confirm');
        Route::get('/password/reset/{token}', function () { return view('auth.passwords.reset'); })->name('password.reset');
        });

   

    
