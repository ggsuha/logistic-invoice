<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\ShipmentResource;
use App\Models\Category;
use App\Models\Country;
use App\Models\Receiver;
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
        $countries = Country::select('id', 'name')->get();
        $categories = Category::select('id', 'name')->get();

        return inertia('admin.shipment.form', compact('countries', 'categories'));
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
            if (isset($request->receiver['id'])) {
                $receiver = Receiver::findOrFail($request->receiver['id']);
                $receiver->update($request->receiver);
                $receiver->address()->update($request->receiver['address']);
            } else {
                $receiver = Receiver::create($request->receiver);
                $receiver->address()->create($request->receiver['address']);
            }

            $shipment = $receiver->shipment()->create($request->shipment);
            $shipment->shipper()->create($request->shipper);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        dd('haha');

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
        $shipment->load([
            'shipper',
            'receiver.address',
            'item',
        ]);

        return inertia('admin.shipment.form', [
            'shipment' => ShipmentResource::make($shipment),
            'read_only' => true,
        ]);
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

        return redirect()->route('admin.shipment.show', ['shipment' => $shipment->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shipment  $shipment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shipment $shipment)
    {
        $shipment->delete();

        return redirect()->back();
    }
}
