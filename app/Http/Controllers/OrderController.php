<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    //order list page
    public function orderList(){
        $order = Order::select('orders.*','users.name as user_name')
                ->when(request('key'),function($query){
                    $query->orWhere('users.name','like','%'.request('key').'%')
                    ->orWhere('users.id','like','%'.request('key').'%')
                    ->orWhere('orders.total_price','like','%'.request('key').'%')
                    ->orWhere('orders.status','like','%'.request('key').'%')
                    ->orWhere('orders.order_code','like','%'.request('key').'%');
                })
                ->leftJoin('users','orders.user_id','users.id')
                ->paginate(5);
        return view('admin.order.orderList',compact('order'));
    }
}
