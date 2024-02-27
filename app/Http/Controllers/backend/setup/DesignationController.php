<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentClass;
use App\Models\Subject;
use App\Models\Designation;
use DB;

class DesignationController extends Controller
{
    public function index()
    {  

        
        $allData = Designation::all();
    
        return view('backend.setup.Designation.Designation_view',['allData' => $allData]);
    }

    public function create()
    {
        
        return view('backend.setup.Designation.Designation_create');
    }

    public function store(Request $request)
    {

        $this->validate($request,[
            'name' => 'required | unique:designations,name',
        ]);
        $data = new Designation();
        $data->name = $request->name;
        $data->save();

        return redirect()->route('setup.designation.index')->with('success','Data Added Successfully.');
    }

    public function edit($id)
    {
        $editData = Designation::find($id);
        return view('backend.setup.Designation.Designation_create',['editData' =>$editData]);
    }
    public function update(Request $request,$id)
    {
        $data = Designation::find($id);
        $this->validate($request,[
            'name' => 'required | unique:designations,name,'.$data->id
        ]);


        $data->name = $request->name;
        $data->save();

        return redirect()->route('setup.designation.index')->with('success','Data Updated Successfully.');
    }

     public function destroy($id)
        {
          
            $data = Designation::find($id);
            $data->delete();
            return redirect()->route('setup.d esignation.index')->with('success','Data Deleted Successfully.');
        }
}
