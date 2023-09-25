<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AjaxController extends Controller
{
    //return pizzaList sorting
    // public function pizzaList(Request $request){
    //     if($request->status == 'desc'){
    //         $pizza = Product::orderBy('created_at','desc')->get();
    //     }else{
    //         $pizza = Product::orderBy('created_at','asc')->get();
    //     }

    //     return response()->json($pizza,200);
    // }

    //return pizza list add to cart

    public function addToCart(Request $request){
        
        $data = $this->getOrderData($request);
        
        Cart::create($data);
        
        $response = [
            'message' => 'Add To Cart Complete',
            'status' => 'Success'
        ];
            
       
        return response()->json($response,200);
    }

    //getOrderData
    private function getOrderData($request){
        return [
            'user_id' => $request->userId,
            'product_id' => $request->pizzaId,
            'qty' => $request->count,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}
