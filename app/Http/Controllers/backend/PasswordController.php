<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class PasswordController extends Controller
{
    public function index()
    {  
        $id = Auth::User()->id;
        $data = User::find($id);
        return view('backend.layouts.password.password_view',['password' =>$data]);
    }

    // public function create()
    // {
    //     return view('backend.layouts.profiles.profiles_create');
    // }
    // public function store(Request $request)
    // {
    //     $this->validate($request,[
    //         'usertype' => 'required',
    //         'name' => 'required',
    //         'email' => 'required | unique:profiles,email',
    //         'password' =>'required',
    //         'password2' =>'required',
    //     ]);

    //     $user = new User();

    //     $user->usertype = $request->usertype;
    //     $user->name = $request->name;
    //     $user->email = $request->email;
    //     $user->password = bcrypt($request->password);
    //     $user->save();

    //     return redirect()->route('profiles.index')->with('success','User Added Successfully.');
    // }

    // public function edit()
    // {
    //     $id = Auth::User()->id;
    //     $password = User::find($id);
    //     return view('backend.layouts.passwords.password_edit',['password' =>$password]);
    // }
    public function update(Request $request)
    {
    	if (Auth::attempt(['id' => Auth::User()->id, 'password' => $request->current_password])) {
    		$user = User::find(Auth::User()->name);
    		$user->password = bcrypt($request->new_password);
    		$user->save();

    		return redirect()->route('profiles.index')->with('success','Password Updated Successfully.');
    		
    	}
    	else{
    		return redirect()->back()->with('error','Sorr! Your Current Password does not match . ');	
    	}


       
    }

   
}
