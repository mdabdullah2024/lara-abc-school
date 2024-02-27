<?php

namespace App\Http\Controllers\backend\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentClass;
use App\Models\Year;
use App\Models\ExamType;
use App\Models\StudentMarks;
use App\Models\AssignSubject;
use App\Models\MarksGrade;

class MarksheetController extends Controller
{
    public function index()
    {
        $data['years'] = Year::orderBy('id','desc')->get();
        $data['classes'] = StudentClass::all();
        $data['exam_types'] = ExamType::all();

        return view('backend.ReportsManagement.Marksheet.marksheet_view',$data);
    }

    public function getMarksheet(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $exam_type_id = $request->exam_type_id;
        $id_no = $request->id_no;

        $count_fail = StudentMarks::where('year_id',$year_id)->where('class_id',$class_id)->where('exam_type_id',$exam_type_id)->where('id_no',$id_no)->where('marks','<','33')->get()->count();
        $singleStudent = StudentMarks::where('year_id',$year_id)->where('class_id',$class_id)->where('exam_type_id',$exam_type_id)->where('id_no',$id_no)->where('marks','>','33')->first();
        if ($singleStudent == true) {
            $allMarks = StudentMarks::with(['assign_subjects','year'])->where('year_id',$year_id)->where('class_id',$class_id)->where('exam_type_id',$exam_type_id)->where('id_no',$id_no)->get();
            $allGrade = MarksGrade::all();
            
            return view('backend.ReportsManagement.Marksheet.marksheet_pdf',compact('allMarks','allGrade','count_fail'))->with('Marksheet Generated Successfully.');
        }else{
            return redirect()->back()->with('error','Sorry! These criteria does not match');
        }
    }
}
