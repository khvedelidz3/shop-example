<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderStatus;
use Illuminate\Http\Request;

class OrdersController extends Controller
{

    public function index()
    {
        if (!is_null(\request('filter'))) {
            $status = OrderStatus::query()->findOrFail(\request('filter'));
            $orders = $status->orders()->with(['status', 'user'])->paginate();
        } else {
            $orders = Order::with(['status', 'user'])->paginate();
        }

        $statuses = OrderStatus::all();

        return view('cms.orders.index', [
            'orders'   => $orders,
            'statuses' => $statuses
        ]);
    }

    public function order($id)
    {
        $statusId = OrderStatus::query()->where('default', '=', true)
            ->pluck('id')
            ->first();


        Order::query()->create([
            'user_id'    => auth()->user()->id,
            'status_id'  => $statusId,
            'product_id' => $id
        ]);

        return redirect()->back();
    }

    public function update($id)
    {
        $order = Order::query()->findOrFail($id)->first();

        $order->update([
            'status_id' => \request('status')
        ]);
        return redirect()->back();
    }
}
