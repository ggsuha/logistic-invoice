<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostalCodeController;
use App\Http\Controllers\Admin\ShipmentController;
use App\Http\Controllers\Admin\ShipmentInvoiceController;
use App\Http\Controllers\Admin\ShipmentItemController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['guest:web']], function () {
    Route::get('login', function () {
        return inertia('admin.auth.login');
    })->name('login');

    Route::post('login', [LoginController::class, 'login']);
});

Route::group(['middleware' => ['auth:web']], function () {
    Route::resource('shipment', ShipmentController::class)->except(['show', 'destroy']);

    Route::post('shipment/{shipment}/items', [ShipmentItemController::class, 'store'])->name('shipment.item.store');
    Route::delete('shipment/{shipment}/items/{id}', [ShipmentItemController::class, 'destroy'])->name('shipment.item.destroy');

    Route::resource('category', CategoryController::class)->except(['show']);

    Route::get('shipment/{shipment}/invoice', [ShipmentInvoiceController::class, 'print'])->name('shipment.invoice');

    Route::delete('logout', [LoginController::class, 'logout'])->name('logout');
});

Route::get('/postal-code/{id}', [PostalCodeController::class, 'index'])->name('postalcode');
