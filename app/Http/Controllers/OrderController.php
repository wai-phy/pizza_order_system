<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    //order list page
    public function orderList(){
        $order = Order::select('orders.*','users.name as user_name')

                ->leftJoin('users','orders.user_id','users.id')
                ->get();
        return view('admin.order.orderList',compact('order'));
    }

    //->where('orders.status',$request->status)
    //order status
    public function orderStatus(Request $request){
        $order = Order::select('orders.*','users.name as user_name')
                ->leftJoin('users','orders.user_id','users.id')
                ->orderBy('created_at','desc');

                if($request->orderStatus == null){
                    $order = $order->get();
                }else{
                    $order = $order->where('orders.status',$request->orderStatus)->get();
                }
                
            return view('admin.order.orderList',compact('order'));
    }

    //change status 
    public function changeStatus(Request $request){
        Order::where('id',$request->oderId)->update([
            'status' => $request->status
        ]);

        $order = Order::select('orders.*','users.name as user_name')
                ->leftJoin('users','orders.user_id','users.id')
                ->orderBy('created_at','desc')
                ->get();

        return response()->json($order, 200);
    }

    //order list info
    public function listInfo($orderCode){
        $order = Order::where('order_code',$orderCode)->first();
        $orderList = OrderList::select('order_lists.*','users.name as user_name','products.image as product_image','products.name as product_name')
                    ->leftJoin('users','order_lists.user_id','users.id')
                    ->leftJoin('products','order_lists.product_id','products.id')
                    ->where('order_code',$orderCode)->get();
                    // dd($orderList->toArray());
        return view('admin.order.productList',compact('orderList','order'));
    }
}
