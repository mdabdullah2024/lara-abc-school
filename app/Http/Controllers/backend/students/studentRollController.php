<?php

namespace App\Http\Controllers\backend\students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssignStudent;
use App\Models\DiscountStudent;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\StudentShift;
use App\Models\year;
use App\Models\User;
use DB;
use PDF;

class studentRollController extends Controller
{
    public function index()
    {

        $data['years']= Year::orderBy('id','desc')->get();
        $data['classes']= StudentClass::all();
        return view('backend.students.roll_generate.roll_generate_view',$data);
    }
    public function getStudent(Request $request)
    {

        $allData = AssignStudent::with(['student'])->where('year_id',$request->year_id)->where('class_id',$request->class_id)->get();
         

        return response()->json($allData);
    }

    public function store(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        if ($request->student_id != NULL) {
            for ($i=0; $i < count($request->student_id) ; $i++) { 

                AssignStudent::where('year_id',$year_id)->where('class_id',$class_id)->where('student_id',$request->student_id[$i])->update(['roll'=>$request->roll[$i]]);
            }
            }else{
                return redirect()->back()->with('error','Sorry! There is no Student');
        }
        return redirect()->route('students.roll.index')->with('success','Well Done ! Successfully Roll Generated');
    }
}
