<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;

class ShopifyController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::where('total_price', '>', 100)
            ->with('customer')
            ->when($request->input('financial_status'), function ($query, $financialStatus) {
                return $query->where('financial_status', $financialStatus);
            })
            ->paginate(5);

        return view('orders', compact('orders'));
    }

    public function import()
    {
        Artisan::call('app:shopify-update');

        return ;
    }
}
