<?php

namespace App\Console\Commands;

use App\Services\ShopifyApiService;
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

    private $shopifyApiService;
    private $customer;
    private $order;

    public function __construct(
        ShopifyApiService $shopifyApiService,
        Customer $customer,
        Order $order
    )
    {
        parent::__construct();
        $this->shopifyApiService = $shopifyApiService;
        $this->customer = $customer;
        $this->order = $order;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $response = $this->shopifyApiService->getOrders();

        if (!$response->orders) {
            echo('Error with API');
            return;
        }

        $this->customer->delete();
        $this->order->delete();

        foreach($response->orders as $orderData) {
            $customer = $this->customer->create([
                'name' => $orderData->name,
                'email' => $orderData->email,
            ]);

            if($customer) {
                $this->order->create([
                    'customer_id' => $customer->id,
                    'total_price' => $orderData->total_price,
                    'financial_status' => $orderData->financial_status,
                    'fulfillment_status' => $orderData->fulfillment_status,
                ]);
            }
        }
    }
}
