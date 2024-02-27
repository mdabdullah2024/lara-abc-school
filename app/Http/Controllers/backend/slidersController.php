<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Auth;

class slidersController extends Controller
{
    public function index()
    {  
        $count = Slider::count();
        $data = Slider::all();
    
        return view('backend.layouts.Sliders.Slider_view',[
            'sliders' => $data,
            'count'  =>$count
        ]);
    }

    public function create()
    {
        return view('backend.layouts.Sliders.Slider_create');
    }
    public function store(Request $request)
    {

        $this->validate($request,[
            'short_description' => 'required',
            'long_description' => 'required',
            'image' =>'sometimes| image:jpeg,jpg,png,jif'
        ]);
        $slider = new Slider();
        $slider->created_by = Auth::User()->name;
        $slider->short_description = $request->short_description;
        $slider->long_description = $request->long_description;

        if($request->file('image')){
            $file = $request->file('image');
            $filename = uniqid().$file->getClientOriginalName();
            $file->move(public_path('upload/slider_images'),$filename);
            $slider->image = $filename;
        }
        $slider->save();

        return redirect()->route('sliders.index')->with('success','slider Added Successfully.');
    }

    public function edit($id)
    {
        $slider = Slider::find($id);
        return view('backend.layouts.Sliders.Slider_edit',['slider' =>$slider]);
    }
    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'image' => 'sometimes| image:jpeg,jpg,png,jif',
            'short_description' => 'required',
            'long_description' => 'required '
            
        ]);

        $slider = Slider::find($id);
        $slider->updated_by = Auth::User()->name;
        $slider->short_description = $request->short_description;
        $slider->long_description = $request->long_description;
        if($request->file('image')){
            $file = $request->file('image');
            @unlink(public_path('upload/slider_images/'.$slider->image));
            $filename = uniqid().$file->getClientOriginalName();
            $file->move(public_path('upload/slider_images'),$filename);
            $slider->image = $filename;
        }
        $slider->save();

        return redirect()->route('sliders.index')->with('success','Slider Updated Successfully.');
    }

     public function destroy($id)
        {
          
            $slider = Slider::find($id);
            if (file_exists(public_path('upload/slider_images/'.$slider->image) ) AND !empty($slider->image)) {
                @unlink(public_path('upload/slider_images/'.$slider->image));
            }
            $slider->delete();
            return redirect()->route('sliders.index')->with('success','Slider Deleted Successfully.');
        }
}
