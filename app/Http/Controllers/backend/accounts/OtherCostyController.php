<?php

namespace App\Http\Controllers\backend\accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AccountOtherCost;

class OtherCostyController extends Controller
{
     public function index()
    { 
        $data['allData'] = AccountOtherCost::orderBy('id','desc')->get();
    
        return view('backend.accounts.OtherCost.cost_view',$data);
    }

    public function create()
    {
        return view('backend.accounts.OtherCost.cost_create');
    }
    public function store(Request $request)
    {
        $cost = new AccountOtherCost();
        $cost->date = date('Y-m-d',strtotime($request->date));
        $cost->amount = $request->amount;
        $cost->description = $request->description;

        if($request->file('image')){
            $file = $request->file('image');
            $filename = uniqid().$file->getClientOriginalName();
            $file->move(public_path('upload/cost_images'),$filename);
            $cost->image = $filename;
        }
        $cost->save();

        return redirect()->route('cost.fee.index')->with('success','Other Cost Added Successfully.');
    }

    public function edit($id)
    {
        $data['editData'] = AccountOtherCost::find($id);
        return view('backend.accounts.OtherCost.cost_create',$data);

    }
    public function update(Request $request,$id)
    {$cost =  AccountOtherCost::find($id);
        $cost->date = date('Y-m-d',strtotime($request->date));
        $cost->amount = $request->amount;
        $cost->description = $request->description;

        if($request->file('image')){
            $file = $request->file('image');
            @unlink(public_path('upload/cost_images/'.$slider->image));
            $filename = uniqid().$file->getClientOriginalName();
            $file->move(public_path('upload/cost_images'),$filename);
            $cost->image = $filename;
        }
        $cost->save();

        return redirect()->route('cost.fee.index')->with('success','Other Cost Added Successfully.');
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
