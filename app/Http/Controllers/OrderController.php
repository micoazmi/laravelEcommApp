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
        'item_qty'=>'required|integer|min:1',
        'item_price'=>'required|numeric',
        'item_name'=>'required|string|max:255',
      ]);
      try {
                $total_price = $validate['item_price'] * $validate['item_qty'];
                $orderitem = new Order();
                $orderitem -> item_id = $validate['item_id'];
                $orderitem -> total_price = $total_price;
                $orderitem -> item_qty = $validate['item_qty'];
                $orderitem -> item_price = $validate['item_price'];
                $orderitem -> item_name = $validate['item_name'];
                $orderitem->save();
                return response()->json(
                    [
                        'status'=>201,
                        'message'=>'I am in cart'
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
