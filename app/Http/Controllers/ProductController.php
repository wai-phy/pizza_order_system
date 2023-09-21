<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //pizza product page
    public function pizzaListPage(){
        $pizza = Product::when(request('key'),function($query){
            $query->where('name','like','%'.request('key').'%');
        })
        ->orderBy('created_at','desc')->paginate(4);
        $pizza->appends(request()->all());
        return view('admin.product.pizzaList',compact('pizza'));
    }

    //pizza create page
    public function pizzaCreatePage(){
        $categories = Category::select('id','name')->get();
        return view('admin.product.pizzaCreate',compact('categories'));
    }

    //pizza create
    public function pizzaCreate(Request $request){
        $this->productValidationCheck($request);
        $data = $this->getProductData($request);
        $fileName = uniqid().$request->file('pizzaImage')->getClientOriginalName();
        $request->file('pizzaImage')->storeAs('public',$fileName);
        $data['image'] = $fileName;

        Product::create($data);

        return redirect()->route('product#pizzaPage');
    }

    //pizza delete
    public function pizzaDelete($id){
        Product::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Delete Successfully !!']);
    }

    //pizza edit page
    public function pizzaDetail($id){
       $pizza = Product::where('id',$id)->first();
       dd($pizza->toArray());
        return view('admin.product.pizzaEdit',compact('pizza'));
    }

    //get product data
    private function getProductData($request){
        return [
            'name' => $request->pizzaName,
            'category_id' => $request->pizzaCategory,
            'description' => $request->pizzaDescription,
            'waiting_time' => $request->waitingTime,
            'price' => $request->pizzaPrice,
        ];
    }

    //productValidationCheck
    private function productValidationCheck($request){
        Validator::make($request->all(),[
            'pizzaName' => 'required|min:5|unique:products,name',
            'pizzaCategory' => 'required',
            'pizzaDescription' => 'required',
            'pizzaImage' => 'required|mimes:jpg,jpeg,webp',
            'waitingTime' => 'required',
            'pizzaPrice' => 'required'
        ])->validate();
    }

    


}
