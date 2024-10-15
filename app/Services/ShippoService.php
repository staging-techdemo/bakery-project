<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class ShippoService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('SHIPPO_TEST_KEY'); // Retrieve API key from .env file
        $this->client = new Client([
            'base_uri' => 'https://api.goshippo.com/',
            'headers' => [
                'Authorization' => 'ShippoToken ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    public function createAddress($address)
    {
        try {
            $response = $this->client->post('addresses/', [
                'json' => $address
            ]);
            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            \Log::error('Error creating address: ' . $e->getMessage());
            throw $e;
        }
    }

    public function createShipment($fromAddressId, $toAddressId, $parcel)
    {
        try {
            $response = $this->client->post('shipments/', [
                'json' => [
                    'address_from' => $fromAddressId,
                    'address_to' => $toAddressId,
                    'parcels' => [$parcel],
                ]
            ]);
            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            \Log::error('Error creating shipment: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getRates($shipmentId)
    {
        try {
            $response = $this->client->get("shipments/{$shipmentId}/rates/");
            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            \Log::error('Error fetching rates: ' . $e->getMessage());
            throw $e;
        }
    }
}
