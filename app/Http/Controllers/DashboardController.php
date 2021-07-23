<?php

namespace App\Http\Controllers;

use App\Http\Resources\TransactionResource;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Http\Response;

class DashboardController extends Controller
{
    //
    public function dashboard(){
        $user = \Auth::user();
        $id = $user->id;
        $members = Customer::where('users_id',$id)->count('*');
        $transactions = Transaction::where('users_id',$id)->count('*');
        $data = TransactionResource::collection(Transaction::where('users_id',"=",$user->id)->get());
        return Response(["members"=>$members,"transactions"=>$transactions,"data"=>$data],Response::HTTP_ACCEPTED);
    }
}
