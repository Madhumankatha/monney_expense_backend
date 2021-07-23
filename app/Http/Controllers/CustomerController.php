<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Monolog\Logger;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;
use Symfony\Component\HttpFoundation\Response;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        //
        $data = \Auth::user();
        return CustomerResource::collection(Customer::where('users_id',$data->id)->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        //
        $user = \Auth::user();
        $id = $request->validated();

        $count = Customer::where('users_id',$user->id)->count('*');

        if ($count <= 2){
            Customer::create($request->only("name","phone","acc_no","ifsc","bank")
                + ['users_id'=>$user->id]
            )->timestamps;

            if ($id > 0){
                return Response(["status"=>true,"message"=>"Created Successfully"],Response::HTTP_ACCEPTED);
            }else{
                return Response(["status"=>false,"message"=>"Failed to create"],Response::HTTP_ACCEPTED);
            }
        }else{
            return Response(["status"=>false,"message"=>"API Limit Reached Error"],Response::HTTP_ACCEPTED);
        }



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
        $user = \Auth::user();
        $data = Customer::where('users_id','=',$user->id)->where('id','=',$customer->id);
        $total = Transaction::where('users_id','=',$user->id)->where('customer_id',$customer->id)->sum('amount');
        $transactions = Transaction::where('users_id','=',$user->id)->where('customer_id',$customer->id)->get();
        if ($data->exists()){
            return Response(["user"=>$data->first(),"total"=>$total,"transaction"=>$transactions],200);
        }
        return Response(["status"=>false,"message"=>"Failed to create"]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, Customer $customer)
    {
        //
        $user = \Auth::user();

        $customer->update($request->only('name','phone','acc_no','ifsc','bank')
            + ['users_id'=>$user->id]
        );
        return Response($customer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
        $user = \Auth::user();
        $data = Customer::where('users_id',"=",$user->id)->where('id',"=",$customer->id);
        if ($data->exists()){
            $data->delete();
        }
        return Response(['status'=>1,"message"=>"deleted successfully"],200);
    }
}
