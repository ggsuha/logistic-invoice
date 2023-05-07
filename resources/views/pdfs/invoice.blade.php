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
            width: 48%;
            border: 2px solid black;
            margin: 10px;
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
            width: 100%;
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
            <div class="row upper">
                <h2>
                    Global Logistic
                </h2>
            </div>
            <div class="row padding-0 flex">
                <div class="shipper">
                    <strong>Shipper:</strong><br>
                    Global Logistic <br>
                    085843439805
                </div>
                <div class="code">
                    TPE
                </div>
            </div>
            <div class="row">
                <strong>Receiver:</strong><br>
                <div class="flex">
                    <div class="upper left">Sri Rahayu NINGSIH</div>
                    <div class="right">LD01173819</div>
                </div>
                085843439805 <br>
                Perum Xxx, Jl. Candi Mendut No.36, RT 011/RW 005 (Belakang Polsek Lowokwaru), Kel. Mojolangu, Kec.
                Lowokwaru, Kota Malang, Jawa Timur, 65142 <br>
                <div class="mt-10">
                    Taiwan
                </div>
            </div>
            <div class="row">
                <div class="flex">
                    <div class="left">
                        <strong>Description of Goods: FOOD</strong><br>
                        TEPUNG
                        <br><br>
                        <strong>
                            <table>
                                <tr>
                                    <td>Quantity</td>
                                    <td>:</td>
                                    <td>1 Pcs</td>
                                </tr>
                                <tr>
                                    <td>Weight</td>
                                    <td>:</td>
                                    <td>4 Kg</td>
                                </tr>
                                <tr>
                                    <td>Custom Value</td>
                                    <td>:</td>
                                    <td>100 $</td>
                                </tr>
                            </table>
                        </strong>
                    </div>
                    <div class="right">
                        <img class="qr" src="data:image/svg+xml;base64,{!! $qr !!}" alt="QR">
                    </div>
                </div>
            </div>
            <div class="row">
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
            </div>
        </div>
        <div class="two">
            <div class="row upper">
                <h2>
                    Global Logistic
                </h2>
            </div>
            <div class="row padding-0 flex">
                <div class="shipper">
                    <strong>Shipper:</strong><br>
                    Global Logistic <br>
                    085843439805
                </div>
                <div class="code">
                    TPE
                </div>
            </div>
            <div class="row">
                <strong>Receiver:</strong><br>
                <div class="flex">
                    <div class="upper left">Sri Rahayu NINGSIH</div>
                    <div class="right">LD01173819</div>
                </div>
                085843439805 <br>
                Perum Xxx, Jl. Candi Mendut No.36, RT 011/RW 005 (Belakang Polsek Lowokwaru), Kel. Mojolangu, Kec.
                Lowokwaru, Kota Malang, Jawa Timur, 65142 <br>
                <div class="mt-10">
                    Taiwan
                </div>
            </div>
            <div class="row">
                <div class="flex">
                    <div class="left">
                        <strong>Description of Goods: FOOD</strong><br>
                        TEPUNG
                        <br><br>
                        <strong>
                            <table>
                                <tr>
                                    <td>Quantity</td>
                                    <td>:</td>
                                    <td>1 Pcs</td>
                                </tr>
                                <tr>
                                    <td>Weight</td>
                                    <td>:</td>
                                    <td>4 Kg</td>
                                </tr>
                                <tr>
                                    <td>Custom Value</td>
                                    <td>:</td>
                                    <td>100 $</td>
                                </tr>
                            </table>
                        </strong>
                    </div>
                    <div class="right">
                        <img class="qr" src="data:image/svg+xml;base64,{!! $qr !!}" alt="QR">
                    </div>
                </div>
            </div>
            <div class="row">
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
            </div>
        </div>
    </div>
    <div class="separator"></div>
    <div class="invoice">
        <h3 class="upper center">
            comercial invoice
        </h3>
        <div class="end p-5 f-12"><span>Jakarta, 23 Mei 2023</span></div>
        <div class="p-5">
            <table>
                <tr>
                    <td style="width: 14%">Consignee</td>
                    <td style="width: 50%">: <span class="upper">sri rahayu ningsih</span></td>
                    <td style="width: 14%">ID Number</td>
                    <td>: LD01173819</td>
                </tr>
                <tr>
                    <td style="width: 14%">No Air Waybill</td>
                    <td style="width: 50%">: 123456789</td>
                    <td style="width: 14%">No of Pieces</td>
                    <td>: 1</td>
                </tr>
                <tr>
                    <td style="width: 14%">Weight</td>
                    <td style="width: 50%">: KG</td>
                    <td style="width: 14%">Dimension</td>
                    <td>: 1 cm * 1 cm * 2 cm</td>
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
                <tr>
                    <td>1</td>
                    <td>Tepung</td>
                    <td>1</td>
                    <td>100</td>
                    <td>100</td>
                </tr>
                <tr>
                    <th colspan="2">TOTAL</th>
                    <td>1</td>
                    <td></td>
                    <td>100</td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>
