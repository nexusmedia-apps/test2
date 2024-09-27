<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Customer;
use App\Models\Order;

class ShopifyUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:shopify-update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get new data from Shopify API and save it in customers and orders tables';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $url = 'https://'.env('SHOPIFY_API_KEY').':'.env('SHOPIFY_API_PASSWORD').'@shortcodesdev.myshopify.com/admin/orders.json';

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $output = curl_exec($curl);

        curl_close($curl);

        $response = json_decode($output);

        if (!$response->orders) {
            echo('Error with API');
            return;
        }

        (new Order())->delete();
        (new Customer())->delete();

        foreach($response->orders as $orderData) {
            $customer = new Customer;

            $customer->name = $orderData->name;
            $customer->email = $orderData->email;

            $customer->save();

            $order = new Order;

            $order->customer_id = $customer->id;
            $order->total_price = $orderData->total_price;
            $order->financial_status = $orderData->financial_status;
            $order->fulfillment_status = $orderData->fulfillment_status;

            $order->save();
        }
    }
}
