<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class costumerController extends Controller
{
    public function customer() {
        return view('pages.costumers');
    }

    public function createPage() {
        return view('pages.customer_create');
    }
    
    public function detailPage() {
        return view('pages.customer_detail');
    }

    public function getCustomerDetails($id)
{
    $customer = Customer::findOrFail($id);
    return response()->json($customer);
}

public function getDetails($id)
    {
        $customer = Customer::findOrFail($id);
        return response()->json($customer);
    }

}
