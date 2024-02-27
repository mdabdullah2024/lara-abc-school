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
use App\Models\FeeAmount;
use App\Models\ExamType;
use DB;
use PDF;

class studentexamFeeController extends Controller
{
    public function index()
    {

        $data['years']= Year::orderBy('id','desc')->get();
        $data['classes']= StudentClass::all();
        $data['examtypes']= ExamType::all();
        return view('backend.students.ExamFee.exam_fee_view',$data);
    }
    public function getStudent(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        if ($year_id !='') {
            $where[] = ['year_id','like',$year_id.'%'];
        }
        if ($class_id !='') {
            $where[] = ['class_id','like',$class_id.'%'];
        }
        $allData = AssignStudent::with(['discount'])->where($where)->get();
        $html['thsource'] = '<th>SL</th>';
        $html['thsource'] .= '<th>ID No</th>';
        $html['thsource'] .= '<th>Student Name</th>';
        $html['thsource'] .= '<th>Roll No</th>';
        $html['thsource'] .= '<th>Exam Fee</th>';
        $html['thsource'] .= '<th>Discount Amount</th>';
        $html['thsource'] .= '<th>Fee(This Student)</th>';
        $html['thsource'] .= '<th>Action</th>';

        foreach($allData as $key =>$v){
            $ExamFee = FeeAmount::where('fee_category_id','3')->where('class_id',$v->class_id)->first();
            $color = 'success';
            $html[$key]['tdsource']='<td>'.($key+1).'</td>';
            $html[$key]['tdsource'].='<td>'.$v['student']['id_no'].'</td>';
            $html[$key]['tdsource'].='<td>'.$v['student']['name'].'</td>';
            $html[$key]['tdsource'].='<td>'.$v->roll.'</td>';
            $html[$key]['tdsource'].='<td>'.$ExamFee->amount.'TK'.'</td>';
            $html[$key]['tdsource'].='<td>'.$v['discount']['discount'].'%'.'</td>';


            $originalfee = $ExamFee->amount;
            $discount = $v['discount']['discount'];
            $discountablefee = $discount/100*$originalfee;
            $finalfee = (float)$originalfee - (float)$discountablefee;

            $html[$key]['tdsource'] .= '<td>'.$finalfee.'TK'.'</td';
            $html[$key]['tdsource'] .= '<td>';
            $html[$key]['tdsource'] .='<a style="right: -136px;
    position: relative;" class=" btn btn-sm btn-'.$color.'" title="Payslip" target="_blank" href="'.route("students.exam-fee.get-student-payslip").'?class_id='.$v->class_id.'&student_id='.$v->student_id.'&examtype='.$request->examtype.'" >Fee Slip</a>';
            $html[$key]['tdsource'] .= '</td>';

            

            }
            return response()->json(@$html);
    }
    public function payslip(Request $request)
    {
        $student_id = $request->student_id;
        $class_id = $request->class_id;
        $data['examtype'] = $request->examtype;
        $data['details']= AssignStudent::with(['discount','student','student_class'])->where('student_id',$student_id)->where('class_id',$class_id)->first();
        $pdf= PDF::loadView('backend.students.ExamFee.student_info-report',$data);
        $pdf->SetProtection(['copy','print'],'','pass');
        return $pdf->stream('document.pdf');
    }
}
