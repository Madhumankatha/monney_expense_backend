<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DemoController extends Controller
{
    //
    public function Demo(){
        return response('Hello World!!');
    }
}
