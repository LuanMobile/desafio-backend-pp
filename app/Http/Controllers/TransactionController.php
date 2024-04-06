<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Retailer;
use Exception;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function transaction(Request $request)
    {
        /* {
            "value": 100,
            "payer": 4, // customer
            "payee": 15 // retailer
        } */

        //dd($request->all());
        $data = $request->all();
        $customerId = $data['payer'];
        $retailerId = $data['payee'];

        $amount = $request['value']; // 100

        $customer = new Customer();
        $retailer = new Retailer();
        /* if ($this->usersExists($request)) {
            return $this->usersExists($request);
        } */

        if ($customer->find($customerId)->amount > 0) {
            dd('tem saldo');
        }
    }

    public function usersExists(Request $request)
    {
        $data = $request->all();
        $customerId = $data['payer'];
        $retailerId = $data['payee'];
        $customer = new Customer;
        $retailer = new Retailer;

        if (!($customer->where('id', '=', $customerId)->exists() && $retailer->where('id', '=', $retailerId)->exists())) {
            return response()->json(["error" => 'Um dos usuários não foi encontrado'], 400);
        }
    }
}
