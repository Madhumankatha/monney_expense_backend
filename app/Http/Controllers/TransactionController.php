<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Http\Requests\TransactionRequest;
use App\Http\Resources\TransactionResource;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function index()
    {
        //
        $user = \Auth::user();
        $total = Transaction::where('users_id','=', $user->id)->sum('amount');
        $data = TransactionResource::collection(Transaction::where('users_id',"=",$user->id)->get());
        return Response(["total"=>$total,"transactions"=>$data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransactionRequest $request)
    {
        //
        $user = \Auth::user();

        $count = Transaction::where('users_id',$user->id)->count('*');

        if ($count <= 5){
            if (Customer::where('id',"=",$request->customer_id)->where('users_id',"=",$user->id)->exists()){
                Transaction::create($request->only("amount","comments","date","customer_id")
                    + ['users_id'=>$user->id]
                );

                return Response(["status"=>true,"message"=>"Successfully created"],Response::HTTP_ACCEPTED);
            }

            return Response(["status"=>false,"message"=>"Failed to created"],Response::HTTP_FORBIDDEN);
        }else{
            return Response(["status"=>false,"message"=>"API Limit Reached Error"],Response::HTTP_FORBIDDEN);
        }
    }



}
