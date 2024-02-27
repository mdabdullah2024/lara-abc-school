<?php

namespace App\Http\Controllers\backend\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssignStudent;
use App\Models\Year;
use App\Models\StudentClass;
use App\Models\ExamType;
use PDF;

class StudentIdCardReportController extends Controller
{
    public function index()
    {
        $data['years'] = Year::orderBy('id','desc')->get();
        $data['classes'] = StudentClass::all();
        return view('backend.ReportsManagement.IDCard.idcard_view
',$data);
    }

    public function getStudentidcard(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $check_data = AssignStudent::where('year_id',$year_id)->where('class_id',$class_id)->first();

        if ($check_data == true) {

             $data['allData']=AssignStudent::where('year_id',$year_id)->where('class_id',$class_id)->get();
            $pdf = PDF::loadView('backend.ReportsManagement.IDCard.pdf',$data);
            $pdf->SetProtection(['copy','print'],'','pass');
            return $pdf->stream('document.pdf');
        }
    }
}
