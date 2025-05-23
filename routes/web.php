<?php

use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\AuthorMiddleware;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Middleware\RedirectAuthenticatedMiddleware;
use App\Http\Controllers\Author\AuthorDashboardController;



Route::get('/', function () {
    return view('welcome');
})->name('home');

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
        // Route::get('/dashboard', function () { return view('dashboard');});

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::resource('tag', TagController::class);
        Route::resource('category', CategoryController::class);
    
       
    });

    Route::prefix('author')->middleware([AuthorMiddleware::class])->group(function () {
        

       Route::get('/dashboard', [AuthorDashboardController::class, 'index'])->name('author.dashboard');
    
       
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

   

    
