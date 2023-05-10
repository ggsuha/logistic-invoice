<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\ShipmentController;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Milon\Barcode\Facades\DNS1DFacade;

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

    Route::resource('shipment', ShipmentController::class)->only([
        'index', 'create', 'store', 'edit', 'update'
    ]);

    Route::get('test', function () {
        $barcode = base64_encode(DNS1DFacade::getBarcodeSVG('4445645656', 'UPCA', 2, 80));
        $qr = base64_encode(QrCode::format('svg')->size(300)->generate('Make me into an QrCode!'));

        $pdf = App::make('snappy.pdf.wrapper');
        $pdf->loadView('pdfs.invoice', compact('qr', 'barcode'))
            ->setPaper('a4');

        return $pdf->inline();
    });

    Route::get('view', function () {
        $barcode = base64_encode(DNS1DFacade::getBarcodeSVG('4445645656', 'UPCA', 2, 80));
        $qr = base64_encode(QrCode::format('svg')->size(300)->generate('Make me into an QrCode!'));

        return view('pdfs.invoice', compact('qr', 'barcode'));
    });

    Route::delete('logout', [LoginController::class, 'logout'])->name('logout');
});

require_once __DIR__ . '/component.php';
