<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentClass;
use DB;

class StudentClassController extends Controller
{
    public function index()
    {  

        
        $allData = StudentClass::all();
    
        return view('backend.setup.studentClass.student_class_view',[
            'allData' => $allData
        ]);
    }

    public function create()
    {
        
        return view('backend.setup.studentClass.student_class_create');
    }

    public function store(Request $request)
    {

        $this->validate($request,[
            'name' => 'required | unique:student_classes,name',
        ]);
        $data = new StudentClass();
        $data->name = $request->name;
        $data->save();

        return redirect()->route('setup.student.class.index')->with('success','Data Added Successfully.');
    }

    public function edit($id)
    {
        $editData = StudentClass::find($id);
        return view('backend.setup.studentClass.student_class_create',['editData' =>$editData]);
    }
    public function update(Request $request,$id)
    {
        $data = StudentClass::find($id);
        $this->validate($request,[
            'name' => 'required | unique:student_classes,name,'.$data->id
        ]);


        $data->name = $request->name;
        $data->save();

        return redirect()->route('setup.student.class.index')->with('success','Data Updated Successfully.');
    }

     public function destroy($id)
        {
          
            $data = StudentClass::find($id);
            $data->delete();
            return redirect()->route('setup.student.class.index')->with('success','Data Deleted Successfully.');
        }
}
