<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use Illuminate\Support\Facades\App;
use Milon\Barcode\Facades\DNS1DFacade;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ShipmentInvoiceController extends Controller
{
    /**
     * Display a resource in pdf.
     *
     * @param  \App\Models\Shipment  $shipment
     * @return \Illuminate\Http\Response
     */
    public function print(Shipment $shipment)
    {
        $shipment->load([
            'shipper',
            'receiver.address.postalCode.country',
            'category',
            'items',
        ]);

        /**
         * @var \App\Models\User
         */
        $user = auth()->user();
        $user->load('detail');

        $now = now();

        $barcode = base64_encode(DNS1DFacade::getBarcodeSVG($shipment->air_waybill, 'EAN13', 2, 80));

        $now = now();

        $pdf = App::make('snappy.pdf.wrapper');
        $pdf->loadView('pdfs.invoice2', compact('barcode', 'shipment', 'now', 'user'))
            ->setPaper('a4')->setOption('title', "Invoice-{$shipment->number}");

        return $pdf->inline();
    }
}
