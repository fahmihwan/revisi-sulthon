<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Dashboard_alert_transaction extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        if ($this->transaction_status == 'capture' || $this->transaction_status == 'settlement') {
            $alertt = 'text-red-600';
        }
        if ($this->transaction_status == 'pending') {
            $alertt = 'text-yellow-600';
        }
        if ($this->transaction_status == 'deny' || $this->transaction_status == 'cancel' || $this->transaction_status == 'expire' || $this->transaction_status == 'failure') {
            $alertt = 'text-red-600';
        }
        return [
            'id' => $this->id,
            'date' => $this->date,
            'email' => $this->email,
            'transaction_status' => $this->transaction_status,
            'alert' => $alertt
        ];
    }
}
