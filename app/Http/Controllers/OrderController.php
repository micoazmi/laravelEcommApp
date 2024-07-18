<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Item;

class OrderController extends Controller
{
    /**
     * Store a newly created order with items in storage.
     */
  public function addToCart(Request $request){
        $validate= $request->validate([
            'item_id'=>'required|exists:items,id',
            'item_qty'=>'required|integer'
    ]);

          try {
            $item = Item::findOrFail($validate['item_id']);
            $itemQuantity = $validate['item_qty'];
            $itemPrice=$item->price;
            $totalPrice=$itemPrice * $itemQuantity;

            $orderItem = new Order();
            $orderItem->item_id=$item->id;
            $orderItem->item_qty=$itemQuantity;
            $orderItem->total_price=$totalPrice;


            $orderItem->save();
            return response()->json(
                [
                    'status'=>201,
                    'message'=>'Item Added to cart',
                ]
            );

          } catch (\Exception $e) {
                return response()->json(
                    [
                        'status'=>500,
                        'message'=>'Failed to add item',
                        'error'=>$e->getMessage()
                    ]
                );
              }

  }

 

  public function gerOrdersWithItem(){
    try {
        $order = Order::with('item')->get();
        return response()->json([
            'status'=>200,
            'data'=>$order
        ]);
    } catch (\Throwable $th) {
        return response()->json([
            'status'=>500,
            'message'=>'failed to retrieve order',
            'error'=>$th->getMessage()
        ]);
    }
  }

  public function getAll()
  {
    $orders = Order::get();
    return response()->json($orders, 200);
  }

  public function deleteOrder($id)
  {
    $order = Order::find($id);

    if(!$order){
        return response()->json([
            'status'=>404,
            'message'=>'order not found'
        ],404);
    }
    $order->delete();
    return response()->json([
        'status'=>200,
        'message'=>'Order deleted succesfully'
    ],200);

  }
}
