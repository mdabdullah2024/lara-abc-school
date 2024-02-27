<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentClass;
use App\Models\FeeCategory;
use App\Models\ExamType;
use DB;

class ExamTypeController extends Controller
{
    public function index()
    {  

        
        $allData = ExamType::all();
    
        return view('backend.setup.ExamType.ExamType_view',['allData' => $allData]);
    }

    public function create()
    {
        
        return view('backend.setup.ExamType.ExamType_create');
    }

    public function store(Request $request)
    {

        $this->validate($request,[
            'name' => 'required | unique:exam_types,name',
        ]);
        $data = new ExamType();
        $data->name = $request->name;
        $data->save();

        return redirect()->route('setup.exam.type.index')->with('success','Data Added Successfully.');
    }

    public function edit($id)
    {
        $editData = ExamType::find($id);
        return view('backend.setup.ExamType.ExamType_create',['editData' =>$editData]);
    }
    public function update(Request $request,$id)
    {
        $data = ExamType::find($id);
        $this->validate($request,[
            'name' => 'required | unique:exam_types,name,'.$data->id
        ]);


        $data->name = $request->name;
        $data->save();

        return redirect()->route('setup.exam.type.index')->with('success','Data Updated Successfully.');
    }

     public function destroy($id)
        {
          
            $data = ExamType::find($id);
            $data->delete();
            return redirect()->route('setup.exam.type.index')->with('success','Data Deleted Successfully.');
        }
}
