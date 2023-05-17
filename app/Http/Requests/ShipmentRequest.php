<?php

namespace App\Http\Requests;

class ShipmentRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'shipper.name'                      => 'required',
            'shipper.phone'                     => 'required',
            'shipper.address'                   => 'required',
            'receiver.name'                     => 'required',
            'receiver.phone'                    => 'required',
            'receiver.address'                  => 'required',
            'receiver.address.street'           => 'required',
            'receiver.address.postal_code_id'   => 'required',
            'country_id'                        => 'required',
            'shipment.category_id'              => 'required',
            'shipment.weight'                   => 'required',
            'shipment.content'                  => 'required',
            'shipment.pcs'                      => 'required',
            'shipment.value'                    => 'required',
            'shipment.dimension'                => 'nullable',
        ];
    }

    /**
     * Set attribute's name.
     *
     * @return array<string, mixed>
     */
    public function attributes()
    {
        return [
            'shipper.name'                      => 'nama',
            'shipper.phone'                     => 'nomor telepon',
            'shipper.address'                   => 'alamat',
            'receiver.name'                     => 'nama',
            'receiver.phone'                    => 'nomor telepon',
            'receiver.address.street'           => 'alamat',
            'receiver.address.postal_code_id'   => 'kode pos',
            'country_id'                        => 'negara',
            'shipment.category_id'              => 'jenis paket',
            'shipment.weight'                   => 'berat',
            'shipment.content'                  => 'daftar isi',
            'shipment.pcs'                      => 'pcs',
            'shipment.value'                    => 'value',
            'shipment.dimension'                => 'dimensi',
        ];
    }
}
