<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;

class UsersController extends Controller
{
    public function index()
    {  

        $data = User::where('usertype','admin')->get();
        
        return view('backend.layouts.users.user_view',[
            'users' => $data
        ]);
    }

    public function create()
    {
        return view('backend.layouts.users.user_create');
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required | unique:users,email'
        ]);

        $user = new User();

        $code = rand(0000,9999);
        $user->usertype = 'admin';
        $user->role = $request->role;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($code);
        $user->code =$code;
        $user->save();

        return redirect()->route('users.index')->with('success','User Added Successfully.');
        Alert::success('User Added Successfully.','Welcome To User List');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('backend.layouts.users.user_edit',['user' =>$user]);
    }
    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required '
            
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->save();

        return redirect()->route('users.index')->with('success','User Updated Successfully.');
        Alert::success('User Added Successfully.','Welcome To User List');
    }

     public function destroy($id)
        {
          
            $user = User::find($id);
            $user->delete();
            return redirect()->route('users.index')->with('success','User Deleted Successfully.');
        }
}
