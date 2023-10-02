<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    //product list page
    public function productList(){
        $product = Product::get();
        $user = User::get();
        $data = [
            'product' => $product,
            'user' => $user,
        ];
        return response()->json($data, 200);
    }

    //category list page api
    public function categoryList(){
        $category = Category::get();

        return response()->json($category, 200);
    }

    //delete category
    public function deleteCategory($id){
        $data = Category::where('id',$id)->first();

        if(isset($data)){
            Category::where('id',$id)->delete();

            return response()->json(['status'=> true], 200);
        }

        return response()->json(['status'=> false], 200);
        
    }

    //create product 
    public function createCategory(Request $request){
        $data = [
            'name' => $request->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        $response = Category::create($data);
         return response()->json($response, 200);
    }

    //create contact
    public function createContact(Request $request){
        $data = $this->getData($request);
        Contact::create($data);
        $response = Contact::orderBy('id','desc')->get();

         return response()->json($response, 200);
    }

    //deleteContact

    public function deleteContact(Request $request){

        $data = Contact::where('id',$request->contactId)->first();
        if(isset($data)){   
            Contact::where('id',$request->contactId)->delete();

            return response()->json(['status'=>true,'message' => 'delete success'], 200);
        }

        return response()->json(['status'=>false,'message' => 'delete fail'], 200);

        
    }


    //category detail
    public function categoryDetail($id){
       $data =  Category::where('id',$id)->first();

       if(isset($data)){
            return response()->json(['status'=>true,'category'=>$data], 200);
       }

       return response()->json(['status'=>false,'category'=>'There is no category here..'], 200);
    }

    //category update
    public function categoryUpdate(Request $request){
        $categoryId = $request->category_id;

        $dbSource = Category::where('id',$categoryId)->first();

        if(isset($dbSource)){
            $categoryData= $this->getCategoryData($request);
           Category::where('id',$categoryId)->update($categoryData);

           $response = Category::where('id',$categoryId)->first();

           return response()->json(['status'=>'success','category'=>$response], 200);
        }
        return response()->json(['status'=>false,'category'=>'THere is no category here .. '], 200);
       
    }

    //getData
    private function getData($request){
        return  [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ];
    }

    //getCategoryData
    private function getCategoryData($request){
        return[
            'name' => $request->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
