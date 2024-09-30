<?php

namespace App\Services;

class ShopifyApiService
{
    private $apiKey;
    private $password;

    public function __construct()
    {
        $this->apiKey = env('SHOPIFY_API_KEY');
        $this->password = env('SHOPIFY_API_PASSWORD');
    }

    private function makeRequest($endpoint, $method = 'GET', $data = null)
    {
        $url = 'https://'.$this->apiKey.':'.$this->password.'@shortcodesdev.myshopify.com/admin/'.$endpoint;

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
//        curl_setopt($ch, CURLOPT_USERPWD, "{$this->apiKey}:{$this->password}");

        if ($method === 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response);
    }

    public function getOrders()
    {
        return $this->makeRequest('orders.json');
    }
}
