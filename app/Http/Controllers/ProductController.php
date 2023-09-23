<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //pizza product page
    public function pizzaListPage(){
        $pizza = Product::select('products.*','categories.name as category_name')
                ->when(request('key'),function($query){
                    $query->where('products.name','like','%'.request('key').'%');
                })
                ->leftJoin('categories','products.category_id','categories.id')
                ->orderBy('products.created_at','desc')->paginate(4);
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
        $this->productValidationCheck($request,"create");
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

    //pizza detail page
    public function pizzaDetail($id){
       $pizza = Product::select('products.*','categories.name as category_name')
                ->leftJoin('categories','products.category_id','categories.id')
                ->where('products.id',$id)->first();
        return view('admin.product.pizzaDetail',compact('pizza'));
    }

    //pizza edit page
    public function pizzaEdit($id){
       $pizza = Product::where('id',$id)->first();
       $categories = Category::select('id','name')->get();
        return view('admin.product.pizzaEdit',compact('pizza','categories'));
    }

    //pizza update
    public function pizzaUpdate( Request $request){
       $this->productValidationCheck($request,"update");
       $data = $this->getProductData($request);

       if($request->hasFile('pizzaImage')){
            $oldImage = Product::where('id',$request->pizzaId)->first();
            $oldImage = $oldImage->image;

            if($oldImage != null){
                Storage::delete('public/',$oldImage);
            }

            $fileName = uniqid().$request->file('pizzaImage')->getClientOriginalName();
            $request->file('pizzaImage')->storeAs('public',$fileName);
            $data['image'] = $fileName;
       }

       Product::where('id',$request->pizzaId)->update($data);
       return redirect()->route('product#pizzaPage');
       
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
    private function productValidationCheck($request, $action){
        $ValidationRules =[
            'pizzaName' => 'required|min:5|unique:products,name,'. $request->pizzaId,
            'pizzaCategory' => 'required',
            'pizzaDescription' => 'required',
            'waitingTime' => 'required',
            'pizzaPrice' => 'required'
        ];
        $ValidationRules['pizzaImage'] = $action == "create" ?  'required|mimes:jpg,jpeg,webp' : 'mimes:jpg,jpeg,webp';
        Validator::make($request->all(),$ValidationRules)->validate();
    }

    


}
