<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Year;
use DB;


class YearController extends Controller
{
    public function index()
    {  

        
        $allData = Year::all();
    
        return view('backend.setup.Year.year_view',['allData' => $allData]);
    }

    public function create()
    {
        
        return view('backend.setup.Year.year_create');
    }

    public function store(Request $request)
    {

        $this->validate($request,[
            'name' => 'required | unique:years,name',
        ]);
        $data = new Year();
        $data->name = $request->name;
        $data->save();

        return redirect()->route('setup.student.year.index')->with('success','Data Added Successfully.');
    }

    public function edit($id)
    {
        $editData = Year::find($id);
        return view('backend.setup.Year.year_create',['editData' =>$editData]);
    }
    public function update(Request $request,$id)
    {
        $data = Year::find($id);
        $this->validate($request,[
            'name' => 'required | unique:years,name,'.$data->id
        ]);


        $data->name = $request->name;
        $data->save();

        return redirect()->route('setup.student.year.index')->with('success','Data Updated Successfully.');
    }

     public function destroy($id)
        {
          
            $data = Year::find($id);
            $data->delete();
            return redirect()->route('setup.student.year.index')->with('success','Data Deleted Successfully.');
        }
}
