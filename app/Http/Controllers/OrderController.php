<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\BiteshipService;
use App\Models\Order;

class OrderController extends Controller
{
    public function indexCourier()
    {
        $res = BiteshipService::getCourier();

        return $res;
    }

    public function indexMaps()
    {
        $res = BiteshipService::getMaps();

        return $res;
    }

    public function indexOrderAdmin()
    {
        $res = Order::all();

        return response()->json($res, 200);
    }

    public function indexOrderUser($id)
    {
        $res = Order::where('id', $id)->get();

        return response()->json($res, 200);
    }

    public function createOrder(Request $request)
    {
        $res = BiteshipService::postOrder($request->all());

        return $res;
    }

    public function trackingOrder($trackingId)
    {
        $res = BiteshipService::getTrackingOrder($trackingId);

        return response()->json($res, 200);
    }
}
