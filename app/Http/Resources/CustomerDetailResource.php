<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'phone'=>$this->phone,
            'acc_no'=>$this->acc_no,
            'ifsc'=>$this->ifsc,
            'bank'=>$this->bank,
            'total'=>$this->total,
            'transactions'=>$this->summary,
        ];
    }
}
