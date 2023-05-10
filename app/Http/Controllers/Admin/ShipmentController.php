<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\ShipmentResource;
use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class ShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shipments = Shipment::with(['receiver', 'shipper'])
            ->select(['id', 'number', 'air_waybill'])
            ->paginate(3);

        return inertia('admin.shipment.index', compact('shipments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return inertia('admin.shipment.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $shipment = Shipment::create($request->shipment);

            $shipment->shipper()->create($request->shipper);
            $shipment->item()->create($request->item);
            $receiver = $shipment->receiver()->create($request->receiver);

            $receiver->address()->create($request->receiver['address']);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return redirect()->route('admin.shipment.edit', ['shipment' => $shipment->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shipment  $shipment
     * @return \Illuminate\Http\Response
     */
    public function show(Shipment $shipment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shipment  $shipment
     * @return \Illuminate\Http\Response
     */
    public function edit(Shipment $shipment)
    {
        $shipment->load([
            'shipper',
            'receiver.address',
            'item',
        ]);

        return inertia('admin.shipment.form', [
            'shipment' => ShipmentResource::make($shipment),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shipment  $shipment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shipment $shipment)
    {
        DB::beginTransaction();
        try {
            $shipment->update($request->shipment);

            $shipment->shipper()->update($request->shipper);
            $shipment->item()->update($request->item);
            $shipment->receiver()->update(Arr::except($request->receiver, 'address'));
            $shipment->address()->update($request->receiver['address']);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return redirect()->route('admin.shipment.edit', ['shipment' => $shipment->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
