<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    
    //change password page
    public function passwordChange(){
        return view('admin.account.changePassword');
    }

    //change password
    public function change(Request $request){
         
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

    //profile page
    public function profilePage(){
        return view('admin.account.profile');
    }

    //profile edit Page
    public function editPage(){
        return view('admin.account.editProfile');
    }

    //profile update page
    public function updateAccount($id, Request $request){
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
        return redirect()->route('admin#profilePage');
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
