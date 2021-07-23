<?php

namespace App\Http\Resources;

use App\Models\Customer;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
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
            "amount"=>$this->amount,
            "comments"=>$this->comments,
            "date"=>$this->date,
            "name"=>$this->cusname,
            "account"=>$this->account
        ];
    }
}
