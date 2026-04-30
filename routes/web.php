<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\UsersAuthenticate;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;

Route::get('/', [UserController::class, 'index'])->name('index');
Route::get('/login', [UserController::class, 'index'])->name('login');
Route::get('/register', function () { return view('register'); })->name('register');
Route::post('/authenticate', [UserController::class, 'authenticate'])->name('authenticate');
Route::post('/registration', [UserController::class, 'registration'])->name('registration');

Route::middleware([UsersAuthenticate::class])->group(function () {
    
    Route::get('/dashboard', function () {
        return view('dashboard', [
            'title' => 'Dashboard',
            'totalProducts' => ProductController::countProducts(),
            'totalAccounts' => UserController::countAccounts(),
        ]);
    });

    Route::get('/logout', function (Request $request) {
        $request->session()->flush();
        return redirect('/login');
    })->name('logout');

    Route::prefix('products')->name('products.')->controller(ProductController::class)->group(function () {
        /* Products */
        Route::get('/', 'index')->name('index');
        Route::post('/fetch', 'fetch')->name('fetch');
        Route::post('/add', 'save')->name('add');
        Route::post('/active', 'active')->name('active');
        Route::post('/inactive', 'inactive')->name('inactive');
        Route::post('/delete', 'delete')->name('delete');
        Route::post('/search', 'searchProducts')->name('search');
    });

    Route::prefix('accounts')->name('accounts.')->controller(UserController::class)->group(function () {
        Route::get('/', 'accountsList')->name('list');
        Route::post('/fetch', 'fetch')->name('fetch');
        Route::post('/active', 'active')->name('active');
        Route::post('/inactive', 'inactive')->name('inactive');
        Route::post('/delete', 'delete')->name('delete');
    });
});
