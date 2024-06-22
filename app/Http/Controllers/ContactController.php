<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller


{
    public function userContact(){
        return view('user.contact.shopContact');
    }

    public function userContactCreate(Request $request){
        $this->contactValidationCheck($request);
        $data=$this->requestUserContact($request);
        Contact::create($data);
        return redirect()->route('user#home');
    }
    private function requestUserContact($request){
        return[
            'name'=>$request->contactName,
            'email'=>$request->contactEmail,
            'message'=>$request->contactMessage
        ];
    }
    private function contactValidationCheck($request){
        Validator::make($request->all(),[
            'contactName'=>'required',
            'contactEmail'=>'required',
            'contactMessage'=>'required'
        ])->validate();
    }

    public function adminContact(){
        $contacts=Contact::get();
        return view('admin.contact.shopContact',compact('contacts'));
    }

    public function deleteContact($id){
        Contact::where('id',$id)->delete();
        return redirect()->route('admin#contactList');
    }
}

