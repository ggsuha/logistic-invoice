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
            'receiver.address',
            'item',
        ]);

        $barcode = base64_encode(DNS1DFacade::getBarcodeSVG($shipment->air_waybill, 'UPCA', 2, 80));
        $qr = base64_encode(QrCode::format('svg')->size(300)->generate($shipment->air_waybill));

        $pdf = App::make('snappy.pdf.wrapper');
        $pdf->loadView('pdfs.invoice', compact('qr', 'barcode'))
            ->setPaper('a4')->setOption('title', "Invoice-{$shipment->number}");

        return $pdf->inline();
    }
}
