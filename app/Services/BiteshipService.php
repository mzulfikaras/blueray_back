<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

use App\Models\Order;

class BiteshipService
{
    public static function getCourier()
    {
        $res = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-type' => 'application/json',
                'Authorization' => env('BITESHIP_API_KEY')
            ])->get(env('BITESHIP_BASE_URL').'/v1/couriers');

        return $res->json();
    }

    public static function getMaps()
    {
        $res = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-type' => 'application/json',
            'Authorization' => env('BITESHIP_API_KEY')
        ])->get(env('BITESHIP_BASE_URL').'/v1/maps/areas');

        return $res->json();
    }

    public static function postOrder($request)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-type' => 'application/json',
            'Authorization' => env('BITESHIP_API_KEY')
        ])->post(env('BITESHIP_BASE_URL').'/v1/orders', [
            'origin_contact_name' => $request['origin_contact_name'] ?? null,
            'origin_contact_phone' => $request['origin_contact_phone'] ?? null,
            'origin_address' => $request['origin_address'] ?? null,
            'origin_area_id' => $request['origin_area_id'] ?? null,
            'destination_contact_name' => $request['destination_contact_name'] ?? null,
            'destination_contact_phone' => $request['destination_contact_phone'] ?? null,
            'destination_address' => $request['destination_address'] ?? null,
            'destination_area_id' => $request['destination_area_id'] ?? null,
            'courier_company' => $request['courier_company'] ?? null,
            'courier_type' => $request['courier_type'] ?? null,
            'delivery_type' => $request['delivery_type'] ?? null,
            'items' => [
                [
                    'name' => $request['items_name'] ?? null,
                    'description' => $request['items_description'] ?? null,
                    'value' => $request['items_value'] ?? null,
                    'quantity' => $request['items_quantity'] ?? null,
                    'weight' => $request['items_weight'] ?? null,
                ]
            ]
        ]);

        if ($response->successful()) {
            $res = $response->json();
            Order::create([
                'shipper_name' => $res['origin']['contact_name'],
                'shipper_tlp' => $res['origin']['contact_phone'],
                'shipper_address' => $res['origin']['address'],
                'recipient_name' => $res['destination']['contact_name'],
                'recipient_tlp' => $res['destination']['contact_phone'],
                'recipient_address' => $res['destination']['address'],
                'courier_company' => $res['courier']['company'],
                'tracking_id' => $res['courier']['tracking_id'],
                'waybill_id' => $res['courier']['waybill_id'],
                'item_name' => $request['items_name'],
                'item_desc' => $request['items_description'],
                'item_qty' => $request['items_quantity'],
                'item_value' => $request['items_value'],
                'item_weight' => $request['items_weight'],
                'created_by' => $request['created_by'] ?? 1,
            ]);

            return $res;
        } else {
            return response()->json([
                'status' => 'error',
                'message' => $response->body(),
            ], $response->status());
        }
    }

    public static function getTrackingOrder($trackingId)
    {
        $res = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-type' => 'application/json',
            'Authorization' => env('BITESHIP_API_KEY')
        ])->get(env('BITESHIP_BASE_URL').'/v1/trackings/'.$trackingId);

        return $res->json();
    }

}
