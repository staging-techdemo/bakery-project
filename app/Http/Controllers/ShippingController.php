<?php

namespace App\Http\Controllers;

use App\Services\ShippoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ShippingController extends Controller
{
    protected $shippoService;

    public function __construct(ShippoService $shippoService)
    {
        $this->shippoService = $shippoService;
    }

    public function updateShipping(Request $request)
    {
        try {
            // Validate the incoming request data
            $request->validate([
                'address' => 'required|string',
                'city' => 'required|string',
                'state' => 'required|string',
                'zip' => 'required|string',
                'parcel' => 'required|array',
            ]);

            // Create the "to" address
            $toAddress = $this->shippoService->createAddress([
                'name' => 'Customer',
                'street1' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'zip' => $request->zip,
                'country' => 'US',
                'validate' => true,
            ]);

            // Check if the "to" address is valid
            if (isset($toAddress['validation_results']) && !$toAddress['validation_results']['is_valid']) {
                return response()->json(['error' => 'Invalid destination address'], 400);
            }

            // Define the "from" address
            $fromAddress = [
                'name' => 'MR Hippo',
                'street1' => '733 N Kedzie Ave',
                'city' => 'Chicago',
                'state' => 'IL',
                'zip' => '60612-1015',
                'country' => 'US',
                'validate' => true,
            ];

            // Create the shipment
            $shipment = $this->shippoService->createShipment($fromAddress, $toAddress, $request->parcel);

            // Get the rates
            $rates = $shipment['rates'];
            if (empty($rates)) {
                return response()->json(['error' => 'No rates available for this shipment'], 500);
            }

            // Return the shipping price
            $shippingPrice = $rates[0]['amount'];
            return response()->json(['shipping_price' => $shippingPrice, 'total_amount' => $shippingPrice + $request->total_amount]);
        } catch (\Exception $e) {
            Log::error('Shipping update error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
