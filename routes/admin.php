<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['guest:web']], function () {
    Route::get('login', function () {
        return inertia('admin.auth.login');
    })->name('login');

    Route::post('login', [LoginController::class, 'login']);
});

Route::group(['middleware' => ['auth:web']], function () {
    Route::get('/', function () {
        return inertia('admin.dashboard.index');
    })->name('dashboard');

    Route::delete('logout', [LoginController::class, 'logout'])->name('logout');
});

require_once __DIR__ . '/component.php';
