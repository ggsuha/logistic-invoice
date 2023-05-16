<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\ShipmentResource;
use App\Models\Category;
use App\Models\Country;
use App\Models\Receiver;
use App\Models\Shipment;
use Illuminate\Http\Request;
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
        $shipments = Shipment::with([
            'receiver.address.postalCode.country',
            'shipper',
            'category'
        ])->paginate(10);

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
        $receivers = Receiver::get();

        return inertia('admin.shipment.form', compact('countries', 'categories', 'receivers'));
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

            $shipment = $receiver->shipments()->create($request->shipment);
            $shipment->shipper()->create($request->shipper);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return redirect()->route('admin.shipment.edit', ['shipment' => $shipment->id]);
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
            'receiver.address.postalCode.country',
        ]);

        $items = $shipment->items()->paginate(10);

        $countries = Country::select('id', 'name')->get();
        $categories = Category::select('id', 'name')->get();
        $receivers = Receiver::get();

        return inertia('admin.shipment.form', [
            'shipment' => ShipmentResource::make($shipment),
            'countries' => $countries,
            'categories' => $categories,
            'items' => $items,
            'receivers' => $receivers,
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

            if (isset($request->receiver['id'])) {
                $receiver = Receiver::findOrFail($request->receiver['id']);
                $receiver->update($request->receiver);
                $receiver->address()->update($request->receiver['address']);
            } else {
                $receiver = Receiver::create($request->receiver);
                $receiver->address()->create($request->receiver['address']);
            }

            $shipment->update($request->shipment + ['receiver_id' => $receiver->id]);
            $shipment->shipper()->update($request->shipper);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return redirect()->back();
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
