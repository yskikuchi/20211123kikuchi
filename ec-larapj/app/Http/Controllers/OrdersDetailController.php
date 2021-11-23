<?php

namespace App\Http\Controllers;

use App\Models\OrdersDetail;
use Illuminate\Http\Request;

class OrdersDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items=OrdersDetail::with(['user','item'])
        ->where('user_id', $request->input('user_id'))
        ->paginate(8);
        return response()->json([
            'data'=>$items
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $items=[];
        foreach($request->all() as $val){
        $item = OrdersDetail::create([
            'user_id' => $val['user_id'],
            'item_id' => $val['item_id'],
            'order_id' => $val['order_id'],
            'quantity' => $val['quantity']
        ]);
        $items[]=$item;
    }
        return response()->json([
            'data'=>$items
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrdersDetail  $ordersDetail
     * @return \Illuminate\Http\Response
     */
    public function show(OrdersDetail $ordersDetail)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrdersDetail  $ordersDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrdersDetail $ordersDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrdersDetail  $ordersDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrdersDetail $ordersDetail)
    {
        //
    }
}
