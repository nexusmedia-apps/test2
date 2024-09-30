<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ShopifyController extends Controller
{
    public function getOrders(Request $request)
    {
        $query = Order::with('customer')
            ->where('total_price', '>', 100);

        if ($request->has('financial_status') && !empty($request->input('financial_status'))) {
            $query->where('financial_status', $request->input('financial_status'));
        }

        $totalOrders = $query->count();
        $perPage = 5;
        $page = $request->input('page', 1);
        $offset = ($page - 1) * $perPage;

        $orders = $query->offset($offset)->limit($perPage)->get();

        return response()->json([
            'orders' => $orders,
            'total' => $totalOrders,
            'per_page' => $perPage,
            'current_page' => $page,
            'last_page' => ceil($totalOrders / $perPage)
        ]);
    }

    public function import()
    {
        Artisan::call('app:shopify-update');

        return ;
    }
}
