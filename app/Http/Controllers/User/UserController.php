<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //user home page
    public function homePage(){
        $pizza = Product::orderBy('created_at','desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizza','category','cart'));
    }

    //filter pizza
    public function filterPizza($categoryId){
        $pizza = Product::where('category_id',$categoryId)->orderBy('created_at','desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizza','category','cart'));
    }

    //user password change page
    public function changePasswordPage(){
        return view('user.password.change');
    }

    //user change password
    public function changePassword(Request $request){
         
        $this->passwordValidationCheck($request);

        $user = User::select('password')->where('id',Auth::user()->id)->first();
        $dbPassword = $user->password;

        if(Hash::check($request->oldPassword, $dbPassword)){
            $data = [
                'password' => Hash::make($request->newPassword),
            ];
            User::where('id',Auth::user()->id)->update($data);

            // Auth::logout();
            // return redirect()->route('auth#login');

            return back()->with(['changeSuccess'=>'The Password Changed Successfully!!']);
        }
        return back()->with(['failMessage'=>'The Password Does Not Match . Try Again!!']);
    }

    //account edit page
    public function editProfilePage(){
        return view('user.account.profileEdit');
    }

    //account update profile
    
    public function updateUserProfile($id, Request $request){
        $this->accountValidationCheck($request);
        $data = $this->getUserData($request);

        if($request->hasFile('image')){

            $oldImage = User::where('id',$id)->first();
            $dbImage = $oldImage->image;

            if($dbImage != null){
                Storage::delete('public',$dbImage);
            }

            $fileName = uniqid() . "_wpa_" . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image'] = $fileName;
        }

        User::where('id',$id)->update($data);
        return back()->with(['updateSuccess'=>'The Profile Updated Successfully!!']);
    }

    //pizza detail page
    public function pizzaDetail($pizzaId){
        $pizza = Product::where('id',$pizzaId)->first();
        $pizzaList = Product::get();
        return view('user.main.details',compact('pizza','pizzaList'));
    }

    //pizza Cart Page
    public function pizzaCartList(){
        $cartList = Cart::select('carts.*','products.name as product_name','products.price as product_price','products.image as product_image')
                    ->leftJoin('products','carts.product_id','products.id')
                    ->where('user_id',Auth::user()->id)->get();
        $totalPrice = 0;
        foreach($cartList as $c){
            $totalPrice += $c->product_price * $c->qty;
        }
        return view('user.main.cart',compact('cartList','totalPrice'));
    }

    //get user data
    private function getUserData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'address' => $request->address,

        ];
    }

    // account validation check
    private function accountValidationCheck($request){
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'image' => 'mimes:jpg,jpeg,png,webp|file'
        ])->validate();
    }


    //validation check password
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword' => 'required|min:6|max:10',
            'newPassword' => 'required|min:6|max:10',
            'confirmPassword' => 'required|min:6|max:10|same:newPassword',
        ])->validate();
    }

}
