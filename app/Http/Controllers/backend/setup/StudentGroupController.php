<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentGroup;
use DB;

class StudentGroupController extends Controller
{
     public function index()
    {  

        $count = StudentGroup::count();
        $allData = StudentGroup::all();
    
        return view('backend.setup.studentGroup.student_group_view',[
            'allData' => $allData,
            'count'  =>$count
        ]);
    }

    public function create()
    {
        
        return view('backend.setup.studentGroup.student_group_create');
    }

    public function store(Request $request)
    {

        $this->validate($request,[
            'name' => 'required | unique:student_groups,name',
        ]);
        $data = new StudentGroup();
        $data->name = $request->name;
        $data->save();

        return redirect()->route('setup.student.group.index')->with('success','Data Added Successfully.');
    }

    public function edit($id)
    {
        $editData = StudentGroup::find($id);
        return view('backend.setup.studentGroup.student_group_create',['editData' =>$editData]);
    }
    public function update(Request $request,$id)
    {
        $data = StudentGroup::find($id);
        $this->validate($request,[
            'name' => 'required | unique:student_groups,name,'.$data->id
        ]);


        $data->name = $request->name;
        $data->save();

        return redirect()->route('setup.student.group.index')->with('success','Data Updated Successfully.');
    }

     public function destroy($id)
        {
          
            $data = StudentGroup::find($id);
            $data->delete();
            return redirect()->route('setup.student.group.index')->with('success','Data Deleted Successfully.');
        }
}
