<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Contact;
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

    //admin list page
    public function adminList(){
        $admin = User::when(request('key'),function($query){
                        $query->orWhere('name','like','%'.request('key').'%')
                        ->orWhere('name','like','%'.request('key').'%')
                        ->orWhere('email','like','%'.request('key').'%')
                        ->orWhere('gender','like','%'.request('key').'%')
                        ->orWhere('phone','like','%'.request('key').'%')
                        ->orWhere('address','like','%'.request('key').'%');
                    })
                    ->where('role','admin')->paginate(2);
        return view('admin.account.adminList',compact('admin'));
    }

    //user list
    public function userList(){
        $userList = User::where('role','user')->paginate(1);
        return view('admin.account.userList',compact('userList'));
    }

    //user delete in admin view
    public function deleteUser($id){
        User::where('id',$id)->delete();
        return back();
    }

    //user to admin role change
    public function userChangeRole(Request $request){
        // logger($request->all());
        $updateSource = ['role' =>$request->role];
        $user = User::where('id',$request->userId)->update($updateSource);
    }

    //  admin to user role change
    public function changeRole(Request $request){
        $updateSource = ['role' =>$request->role];
        $user = User::where('id',$request->userId)->update($updateSource);
    }

    //contact list 
    public function contactList(){
        $getContact = Contact::paginate(4);
        return view('admin.account.contactList',compact('getContact'));
    }

    //contact delete
    public function deleteContact($id){
        Contact::where('id',$id)->delete();
        return back();
    }


    //admin delete 
    public function deleteAdmin($id){
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Admin has been deleted Successfully!!']);
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
