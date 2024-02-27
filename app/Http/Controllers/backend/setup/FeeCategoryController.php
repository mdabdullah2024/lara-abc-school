<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FeeCategory;
use DB;

class FeeCategoryController extends Controller
{
     public function index()
    {  

        $allData = FeeCategory::all();
    
        return view('backend.setup.FeeCategory.fee_category_view',[
            'allData' => $allData
        ]);
    }

    public function create()
    {
        
        return view('backend.setup.FeeCategory.fee_category_create');
    }

    public function store(Request $request)
    {

        $this->validate($request,[
            'name' => 'required | unique:fee_categories,name',
        ]);
        $data = new FeeCategory();
        $data->name = $request->name;
        $data->save();

        return redirect()->route('setup.fee.category.index')->with('success','Data Added Successfully.');
    }

    public function edit($id)
    {
        $editData = FeeCategory::find($id);
        return view('backend.setup.FeeCategory.fee_category_create',['editData' =>$editData]);
    }
    public function update(Request $request,$id)
    {
        $data = FeeCategory::find($id);
        $this->validate($request,[
            'name' => 'required | unique:fee_categories,name,'.$data->id
        ]);


        $data->name = $request->name;
        $data->save();

        return redirect()->route('setup.fee.category.index')->with('success','Data Updated Successfully.');
    }

     public function destroy($id)
        {
          
            $data = FeeCategory::find($id);
            $data->delete();
            return redirect()->route('setup.fee.category.index')->with('success','Data Deleted Successfully.');
        }
}
