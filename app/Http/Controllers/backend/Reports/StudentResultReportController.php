<?php

namespace App\Http\Controllers\backend\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentClass;
use App\Models\Year;
use App\Models\ExamType;
use App\Models\StudentMarks;
use App\Models\AssignSubject;
use App\Models\AssignStudent;
use App\Models\MarksGrade;
use PDF;


class StudentResultReportController extends Controller
{
    public function index ()
    {
        $data['years'] = Year::orderBy('id','desc')->get();
        $data['classes'] = StudentClass::all();
        $data['exam_types'] = ExamType::all();

        return view('backend.ReportsManagement.examResultsReport.result_view',$data);
    }
    public function getStudentResults (Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $exam_type_id = $request->exam_type_id;
        $singleResult = StudentMarks::where('year_id',$year_id)->where('class_id',$class_id)->where('exam_type_id',$exam_type_id)->first();
        if ($singleResult == true) {

             $data['allData']=StudentMarks::select('year_id','class_id','exam_type_id','student_id')->where('year_id',$year_id)->where('class_id',$class_id)->where('exam_type_id',$exam_type_id)->groupBy('year_id')->groupBy('class_id')->groupBy('exam_type_id')->groupBy('student_id')->get();
            $pdf = PDF::loadView('backend.ReportsManagement.examResultsReport.pdf',$data);
            $pdf->SetProtection(['copy','print'],'','pass');
            return $pdf->stream('document.pdf');
        }

    }
}
