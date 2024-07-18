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
        $item_id=$request->item_id;
        $total_price=$request->total_price;
        $item_qty=$request->item_qty;
        $item_price=$request->item_price;
        $item_name=$request->item_name;
      
                $orderitem= new Order;
                $orderitem -> item_id = $item_id;
                $orderitem -> total_price = $total_price;
                $orderitem -> item_qty = $item_qty;
                $orderitem -> item_price = $item_price;
                $orderitem -> item_name = $item_name;
                $orderitem->save();
                return response()->json(
                    [
                        'status'=>201,
                        'message'=>'I am in cart'
                    ]
                );

            
     

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
