<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentShift;
use DB;

class StudentShiftController extends Controller
{
    public function index()
    {  

        $allData = StudentShift::all();
    
        return view('backend.setup.StudentShift.student_shift_view',[
            'allData' => $allData
        ]);
    }

    public function create()
    {
        
        return view('backend.setup.StudentShift.student_shift_create');
    }

    public function store(Request $request)
    {

        $this->validate($request,[
            'name' => 'required | unique:student_shifts,name',
        ]);
        $data = new StudentShift();
        $data->name = $request->name;
        $data->save();

        return redirect()->route('setup.student.shift.index')->with('success','Data Added Successfully.');
    }

    public function edit($id)
    {
        $editData = StudentShift::find($id);
        return view('backend.setup.StudentShift.student_shift_create',['editData' =>$editData]);
    }
    public function update(Request $request,$id)
    {
        $data = StudentShift::find($id);
        $this->validate($request,[
            'name' => 'required | unique:student_shifts,name,'.$data->id
        ]);


        $data->name = $request->name;
        $data->save();

        return redirect()->route('setup.student.shift.index')->with('success','Data Updated Successfully.');
    }

     public function destroy($id)
        {
          
            $data = StudentShift::find($id);
            $data->delete();
            return redirect()->route('setup.student.shift.index')->with('success','Data Deleted Successfully.');
        }
}
