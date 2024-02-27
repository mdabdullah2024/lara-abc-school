<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentClass;
use App\Models\Subject;
use Auth;
use App\Models\AssignSubject;
use DB;


class AssignSubjectController extends Controller
{
    public function index()
    {  
        $allData = AssignSubject::select('class_id')->groupBy('class_id')->get();
    
        return view('backend.setup.AssignSubject.assign_subject_view',[
            'allData' => $allData
        ]);
    }

    public function create()
    {
        $data['subjects']= Subject::all();
        $data['student_classes']= StudentClass::all();
        
        return view('backend.setup.AssignSubject.assign_subject_create',$data);
    }

    public function store(Request $request)
    {
        $countSubject = count($request->subject_id);
        if ($countSubject != NULL) {
            for ($i=0; $i <$countSubject ; $i++) { 
               $fa = new AssignSubject();
               $fa->class_id = $request->class_id;
               $fa->subject_id = $request->subject_id[$i];
               $fa->full_marks = $request->full_marks[$i];
               $fa->pass_marks = $request->pass_marks[$i];
               $fa->obtain_marks = $request->obtain_marks[$i];
               $fa->save();
            }
        }
        return redirect()->route('setup.assign.subject.index')->with('success','Data Added Successfully.');
    }

    public function edit($class_id)
    {
        $data['editData'] = AssignSubject::where('class_id',$class_id)->get();
        $data['subjects']= Subject::all();
        $data['student_classes']= StudentClass::all();
        
       
        return view('backend.setup.AssignSubject.assign_subject_edit',$data);
    }
    public function update(Request $request,$class_id)
    {

        if ($request->subject_id == NULL) {
            return redirect()->back()->with('error','Sorry! You do not Select Any item.');
        }else{

            AssignSubject::whereNotIn('subject_id',$request->subject_id)->where('class_id',$request->class_id)->delete();
            foreach($request->subject_id as $key => $value){
                $assign_subject_exist = AssignSubject::where('subject_id',$request->subject_id[$key])->where('class_id',$request->class_id)->first();
                if ($assign_subject_exist) {
                    $assign_subjects =$assign_subject_exist;
                }else{
                    $assign_subjects= new AssignSubject();
                }
                $assign_subjects->class_id = $request->class_id;
                $assign_subjects->subject_id = $request->subject_id[$key];
                $assign_subjects->full_marks = $request->full_marks[$key];
                $assign_subjects->pass_marks = $request->pass_marks[$key];
                $assign_subjects->obtain_marks = $request->obtain_marks[$key];
                $assign_subjects->updated_by = Auth::user()->id;
                $assign_subjects->save();
            }
        }

        return redirect()->route('setup.assign.subject.index')->with('success','Data Updated Successfully.');
    }

    public function show($class_id)
    {
        $data['editData'] = AssignSubject::where('class_id',$class_id)->orderBy('class_id','asc')->get();
       
        return view('backend.setup.AssignSubject.assign_subject_show',$data);
    }

     public function destroy($id)
        {
          
            $data = AssignSubject::find($id);
            $data->delete();
            return redirect()->route('setup.fee.amount.index')->with('success','Data Deleted Successfully.');
        }
}
