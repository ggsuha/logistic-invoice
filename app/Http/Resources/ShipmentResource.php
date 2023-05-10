<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShipmentResource extends JsonResource
{
    /**
     * The "data" wrapper that should be applied.
     *
     * @var string|null
     */
    public static $wrap = null;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'shipment' => [
                'id' => $this->id,
                'number' => $this->number,
                'air_waybill' => $this->air_waybill,
            ],
            'shipper' => [
                'name' => $this->shipper->name,
                'phone' => $this->shipper->phone,
            ],
            'receiver' => [
                'name' => $this->receiver->name,
                'phone' => $this->receiver->phone,
                'address' => [
                    'street' => $this->receiver->address->street,
                    'country' => $this->receiver->address->country,
                    'postal_code' => $this->receiver->address->postal_code,
                ]
            ],
            'item' => [
                'name' => $this->item->name,
                'quantity' => $this->item->quantity,
                'weight' => $this->item->weight,
                'weight_unit' => $this->item->weight_unit,
                'custom_value' => $this->item->custom_value,
                'x_axis' => $this->item->x_axis,
                'y_axis' => $this->item->y_axis,
                'z_axis' => $this->item->z_axis,
                'dimension_unit' => $this->item->dimension_unit,
            ]
        ];
    }
}
