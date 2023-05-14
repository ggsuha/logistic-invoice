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
                'category_id' => $this->category_id,
                'weight' => $this->weight,
                'content' => $this->content,
                'pcs' => $this->pcs,
                'value' => $this->value,
                'dimension' => $this->dimension,
            ],
            'shipper' => [
                'name' => $this->shipper->name,
                'phone' => $this->shipper->phone,
                'address' => $this->shipper->address,
            ],
            'receiver' => [
                'id' => $this->receiver->id,
                'name' => $this->receiver->name,
                'phone' => $this->receiver->phone,
                'address' => [
                    'street' => $this->receiver->address->street,
                    'country_id' => $this->receiver->address->postalCode->country_id,
                    'postal_code_id' => $this->receiver->address->postal_code_id,
                ]
            ]
        ];
    }
}
