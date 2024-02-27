<?php

namespace App\Http\Controllers\backend\MarksManagements;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssignStudent;
use App\Models\DiscountStudent;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\ExamType;
use App\Models\StudentShift;
use App\Models\year;
use App\Models\StudentMarks;
use App\Models\User;
use DB;
use App\Models\MarksGrade;
use PDF;


class MarksGradeController extends Controller
{
    public function index()
    {
        $data['allData']= MarksGrade::all();

        return view('backend.StudentMarksManagements.gradePoint.grade_view',$data);
    }
    public function create()
    {
        $data['allData']= MarksGrade::all();

        return view('backend.StudentMarksManagements.gradePoint.grade_create',$data);
    }

    public function store(Request $request)
    {
        $data= new MarksGrade();
        $data->grade_name = $request->grade_name;
        $data->grade_point = $request->grade_point;
        $data->start_marks = $request->start_marks;
        $data->end_marks = $request->end_marks;
        $data->start_point = $request->start_point;
        $data->end_point = $request->end_point;
        $data->remarks = $request->remarks;
        $data->save();

        return redirect()->route('marks.grade.index')->with('success','Data Inserted Successfully.');
    }
    public function edit($id)
    {
        $data['editData']= MarksGrade::find($id);

        return view('backend.StudentMarksManagements.gradePoint.grade_create',$data);
    }
    public function update(Request $request,$id)
    {
        $data=  MarksGrade::find($id);
        $data->grade_name = $request->grade_name;
        $data->grade_point = $request->grade_point;
        $data->start_marks = $request->start_marks;
        $data->end_marks = $request->end_marks;
        $data->start_point = $request->start_point;
        $data->end_point = $request->end_point;
        $data->remarks = $request->remarks;
        $data->save();

        return redirect()->route('marks.grade.index')->with('success','Data Inserted Successfully.');
    }

}
 