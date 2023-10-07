<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{

    //contact page
    public function contactPage(){
         return view('user.contact.contactPage');
     }

    //contact page
    public function createContact(Request $request){
        $this->contactValidationCheck($request);
        $contactData = $this->getContData($request);
        
       Contact::create($contactData);
        return redirect()->route('user#thankYou');
    }

    //thankYou page
    public function thankYou(){
        return view('user.contact.thankyou');
    }

    //getContData
    private function getContData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ];
    }

    // contact validation check
    private function contactValidationCheck($request){
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
        ])->validate();
    }
}
