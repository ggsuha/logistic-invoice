<!DOCTYPE html>
<html lang="id">

<head>
    <title>Invoice</title>
    <style>
        html {
            max-width: 1150px;
            margin: 0 auto;
        }

        .flex {
            display: flex;
            display: -webkit-box;
            /* wkhtmltopdf uses this one */
            box-sizing: border-box;
        }

        .two {
            width: 100%;
            border: 2px solid black;
            margin-bottom: 10px;
        }

        .row {
            padding: 5px;
        }

        .row:not(:last-child) {
            border-bottom: 2px solid black;
        }

        .upper {
            text-transform: uppercase;
        }

        .shipper {
            width: 70%;
            padding: 5px;
            box-sizing: border-box;
        }

        .code {
            width: 30%;
            border-left: 2px solid black;
            padding: 5px 0;
            font-size: 40px;
            text-align: center;
            box-sizing: border-box;
        }

        .left {
            width: 70%;
            box-sizing: border-box;
        }

        .right {
            width: 30%;
            box-sizing: border-box;
            text-align: end;
        }

        .w-40 {
            width: 40%;
        }

        .w-60 {
            width: 60%;
        }

        .padding-0 {
            padding: 0;
        }

        .between {
            justify-content: space-between;
        }

        .mt-10 {
            margin-top: 10px;
        }

        .mb-10 {
            margin-bottom: 10px;
        }

        .mt-60 {
            margin-top: 60px;
        }

        .qr,
        .barcode {
            width: 75%;
        }

        .center {
            text-align: center;
        }

        .f-12 {
            font-size: 12px;
        }

        .end {
            text-align: end;
        }

        .separator {
            margin: 10px 0;
            border-bottom: 1px solid black;
        }

        .invoice {
            border: 2px solid black;
        }

        .p-5 {
            padding: 5px;
        }

        .items {
            width: 80%;
            margin: 0 auto;
        }

        .items,
        .items tr,
        .items th,
        .items td {
            border: 1px solid black;
            border-collapse: collapse;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="flex">
        <div class="two">
            <div class="row padding-0 flex">
                <div class="shipper"
                    style="display: flex;
                    display: -webkit-flex;
                flex-wrap: wrap;
                box-sizing: border-box; width:35%;">
                    <img style="height: 100px; width: 270px;"
                        src="data:image/jpeg;base64,{{ base64_encode(file_get_contents(storage_path('app/public/' . $user->detail->logo))) }}"
                        alt="barcode">
                </div>
                <div style="width:35%;font-size: 35px;
                align-self: flex-start;box-sizing: border-box;">
                    Label Pengiriman
                </div>
                <div class="code">
                    {{ $shipment->number }}
                </div>
            </div>
            <div class="row center">
                <img class="barcode" src="data:image/svg+xml;base64,{!! $barcode !!}" alt="barcode">
            </div>
            <div class="row">
                <strong>Receiver:</strong><br>
                <div class="flex">
                    <div class="upper left">{{ $shipment->receiver->name }}</div>
                    <div class="right">{{ $shipment->number }}</div>
                </div>
                {{ $shipment->receiver->phone }} <br>
                {{ $shipment->receiver->address->street }} <br>
                <div class="mt-10">
                    {{ $shipment->receiver->address->postalCode->postal_code }}<br>
                    {{ $shipment->receiver->address->postalCode->city }}<br>
                    {{ $shipment->receiver->address->postalCode->country->name }}
                </div>
            </div>
            <div class="row">
                <strong>Sender:</strong><br>
                <div class="flex">
                    <div class="upper left">{{ $shipment->shipper->name }}</div>
                </div>
                {{ $shipment->shipper->phone }} <br>
            </div>
            <div class="row">
                <div class="flex">
                    <div class="left">
                        <strong>Description of Goods: {{ $shipment->category->name }}</strong><br>
                        {{ $shipment->all_items }}
                        <br><br>
                        <strong>
                            <table>
                                <tr>
                                    <td>Quantity</td>
                                    <td>:</td>
                                    <td>{{ $shipment->pcs }} Pcs</td>
                                </tr>
                                <tr>
                                    <td>Weight</td>
                                    <td>:</td>
                                    <td>{{ $shipment->weight }} Kg</td>
                                </tr>
                                <tr>
                                    <td>Custom Value</td>
                                    <td>:</td>
                                    <td>{{ $shipment->value }} $</td>
                                </tr>
                            </table>
                        </strong>
                    </div>
                    <div class="right">
                        {{--  --}}
                    </div>
                </div>
            </div>
            {{-- <div class="row">
                <div class="flex">
                    <div class="left w-60 p-5">
                        <img class="barcode" src="data:image/svg+xml;base64,{!! $barcode !!}" alt="barcode">
                    </div>
                    <div class="right w-40 center f-12">
                        <span>Print at 06 May 2021 12:02:34</span><br>
                        <span>Receiver's</span>
                        <div class="mt-60">(..................................)</div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
    <div class="separator"></div>
    <div class="invoice">
        <h3 class="upper center">
            comercial invoice
        </h3>
        <div class="end p-5 f-12"><span>Jakarta, {{ $now->translatedFormat('d F Y') }}</span></div>
        <div class="p-5">
            <table>
                <tr>
                    <td style="width: 14%">Consignee</td>
                    <td style="width: 50%">: <span class="upper">{{ $shipment->receiver->name }}</span></td>
                    <td style="width: 14%">ID Number</td>
                    <td>: {{ $shipment->number }}</td>
                </tr>
                <tr>
                    <td style="width: 14%">No Air Waybill</td>
                    <td style="width: 50%">: {{ $shipment->air_waybill }}</td>
                    <td style="width: 14%">No of Pieces</td>
                    <td>: {{ $shipment->pcs }}</td>
                </tr>
                <tr>
                    <td style="width: 14%">Weight</td>
                    <td style="width: 50%">: {{ $shipment->weight }} KG</td>
                    <td style="width: 14%">Dimension</td>
                    <td>: {{ $shipment->dimension ?? '-' }}</td>
                </tr>
            </table>
        </div>
        <div class="p-5 mt-60 mb-10">
            <table class="items">
                <tr>
                    <th style="width: 10%" rowspan="2">No</th>
                    <th style="width: 50%" rowspan="2">Description</th>
                    <th style="width: 10%" rowspan="2">Qty</th>
                    <th colspan="2">Value ($)</th>
                </tr>
                <tr>
                    <th style="width: 15%">Unit Value</th>
                    <th style="width: 15%">Total Value</th>
                </tr>
                @foreach ($shipment->items as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->description }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->value }}</td>
                        <td>{{ $item->total_value }}</td>
                    </tr>
                @endforeach
                <tr>
                    <th colspan="2">TOTAL</th>
                    <td>{{ $shipment->sum_quantity }}</td>
                    <td></td>
                    <td>{{ $shipment->sum_total_value }}</td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>
