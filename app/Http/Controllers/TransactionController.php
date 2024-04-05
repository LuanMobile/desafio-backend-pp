<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function transaction(Request $request)
    {
        /* {
            "value": 100,
            "payer": 4,
            "payee": 15
        } */

        //dd($request->all());
        $data = $request->all();
        $balance = $request['value'];
        dd($balance);
    }
}
