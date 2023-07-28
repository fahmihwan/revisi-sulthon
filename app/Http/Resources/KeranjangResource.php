<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class KeranjangResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public $preserveKeys = true;

    public function toArray($request)
    {

        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'nama' => $this->item->nama,
            'harga' => $this->item->harga,
            'gambar' => $this->item->gambar,
            'ukuran' => $this->ukuran->nama,
            'qty' => $this->qty,
            'total' => $this->item->harga * $this->qty
        ];
    }
}
