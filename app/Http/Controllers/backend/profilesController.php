<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class profilesController extends Controller
{
    public function index()
    {  
        $id = Auth::User()->id;
        $data = User::find($id);
        return view('backend.layouts.profiles.profiles_view',['profiles' =>$data]);
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

    public function edit()
    {
        $id = Auth::User()->id;
        $profile = User::find($id);
        return view('backend.layouts.profiles.profiles_edit',['profiles' =>$profile]);
    }
    public function update(Request $request)
    {
        $id = Auth::User()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->address = $request->address;
        $data->mobile = $request->mobile;
        $data->gender = $request->gender;

        if($request->file('image')){
            $file = $request->file('image');
            @unlink(public_path('upload/user_images/'.$data->image));
            $filename = uniqid().$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'),$filename);
            $data->image = $filename;
        }

        $data->save();

        return redirect()->route('profiles.index',['profiles' =>$data])->with('success','Profile Updated Successfully.');
    }

    //  public function destroy($id)
    //     {
          
    //         $user = User::find($id);
    //         $user->delete();
    //         return redirect()->route('profiles.index')->with('success','User Deleted Successfully.');
    //     }
}
