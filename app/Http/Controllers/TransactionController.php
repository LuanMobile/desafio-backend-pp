<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Retailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function transaction(Request $request)
    {
        /* {
            "value": 100,
            "payer": 4, // customer
            "payee": 15 // retailer
        } */
        $customer = Customer::find($request->payer);
        $customer2 = Customer::find($request->payer2);
        $retailer = Retailer::find(2);
        $amount = $request->value;

        $arrayKeys = array_keys($request->all());
        // dd($arrayKeys);

        if ($arrayKeys[2] == 'payer2') {
            if ($this->usersExists($request)) {
                return $this->usersExists($request);
            }
            DB::transaction(function () use ($customer, $customer2, $amount) {
                if ($customer->amount > 0) {
                    $customer->amount -= $amount;
                    //$customer->save();

                    $customer2->amount += $amount;
                    // $retailer->save();
                    return response()->json('Transferência realizada com sucesso');
                }
            });
        }

        if ($this->usersExists($request)) {
            return $this->usersExists($request);
        }

        dd('oi');
        DB::transaction(function () use ($customer, $retailer, $amount) {
            if ($customer->amount > 0) {
                $customer->amount -= $amount;
                //$customer->save();

                $retailer->amount += $amount;
                // $retailer->save();
            }
            return response()->json('Transferência realizada com sucesso');
        });
    }

    public function usersExists(Request $request)
    {
        $arrayKeys = array_keys($request->all());
        // dd($arrayKeys);
        $userCustomer = Customer::find($request->payer);
        $userCustomer2 = Customer::find($request->payer2);
        $userRetailer = Retailer::find($request->payee);

        if ($arrayKeys[2] == 'payee') {
            if (is_null($userCustomer) || is_null($userRetailer)) {
                return response()->json(["error" => 'Um dos usuários não foi encontrado!!!!!!!!!!!!!!!!!'], 400);
            }
        }

        if (is_null($userCustomer) || is_null($userCustomer2)) {
            return response()->json(["error" => 'Um dos usuários não foi encontrado'], 400);
        }
    }
}
