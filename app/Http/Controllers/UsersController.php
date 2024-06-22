<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    //direct users list page
    public function userList(){
        $users=User::where('role','user')->paginate(4);
        return view('admin.user.list',compact('users'));
    }

    public function userChangeRole(Request $request){
        $updateSource=[
            'role'=>$request->role
        ];
        User::where('id',$request->userId)->update($updateSource);
    }
}
