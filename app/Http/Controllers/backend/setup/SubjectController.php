<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentClass;
use App\Models\FeeCategory;
use App\Models\Subject;
use DB;

class SubjectController extends Controller
{
     public function index()
    {  

        
        $allData = Subject::all();
    
        return view('backend.setup.Subject.Subject_view',['allData' => $allData]);
    }

    public function create()
    {
        
        return view('backend.setup.Subject.Subject_create');
    }

    public function store(Request $request)
    {

        $this->validate($request,[
            'name' => 'required | unique:subjects,name',
        ]);
        $data = new Subject();
        $data->name = $request->name;
        $data->save();

        return redirect()->route('setup.subject.index')->with('success','Data Added Successfully.');
    }

    public function edit($id)
    {
        $editData = Subject::find($id);
        return view('backend.setup.Subject.Subject_create',['editData' =>$editData]);
    }
    public function update(Request $request,$id)
    {
        $data = Subject::find($id);
        $this->validate($request,[
            'name' => 'required | unique:subjects,name,'.$data->id
        ]);


        $data->name = $request->name;
        $data->save();

        return redirect()->route('setup.subject.index')->with('success','Data Updated Successfully.');
    }

     public function destroy($id)
        {
          
            $data = Subject::find($id);
            $data->delete();
            return redirect()->route('setup.subject.index')->with('success','Data Deleted Successfully.');
        }
}
