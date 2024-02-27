<?php

namespace App\Http\Controllers\backend\accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssignStudent;
use App\Models\DiscountStudent;
use App\Models\FeeAmount;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\ExamType;
use App\Models\StudentShift;
use App\Models\year;
use App\Models\StudentMarks;
use App\Models\AccountStudentFee;
use App\Models\User;
use DB;
use App\Models\MarksGrade;
use App\Models\FeeCategory;
use PDF;

class StudentAccountFeeController extends Controller
{
    public function index ()
    {
        $data['allData'] = AccountStudentFee::all();
        return view('backend.accounts.StudentFee.student_fee_index',$data);
    }

    public function create ()
    {
        $data['years'] = Year::orderBy('id','desc')->get();
        $data['classes'] = StudentClass::all();
        $data['fee_categories'] = FeeCategory::all();

        return view('backend.accounts.StudentFee.student_fee_create',$data);
    }

    public function getStudent (Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $fee_category_id = $request->fee_category_id;
        $date = date('Y-m',strtotime($request->date));
        $data= AssignStudent::with(['discount'])->where('year_id',$year_id)->where('class_id',$class_id)->get();
        $html['thsource'] = '<th>ID No.</th>';
        $html['thsource'] .= '<th>Student Name</th>';
        $html['thsource'] .= '<th>Father Name</th>';
        $html['thsource'] .= '<th>Original Fee</th>';
        $html['thsource'] .= '<th>Discount Amount</th>';
        $html['thsource'] .= '<th>Fee (this Student)</th>';
        $html['thsource'] .= '<th>Select</th>';

        foreach ($data as $key => $value) {
            $registrationfee = FeeAmount::where('fee_category_id',$fee_category_id)->where('class_id',$class_id)->first();
            $accountsStudentFee = AccountStudentFee::where('student_id',$value->student_id)->where('year_id',$value->year_id)->where('class_id',$value->class_id)->where('fee_category_id',$value->fee_category_id)->where('date',$date)->first();
            if ($accountsStudentFee != NULL) {
                $checked = 'checked';
            }else{
                $checked = '';
            }
            $color = 'success';
            $html[$key]['tdsource'] = '<td>'.$value['student']['id_no']. '<input type="hidden" name="fee_category_id" value="'.$fee_category_id.'">'.'</td>';
            $html[$key]['tdsource'] .= '<td>'.$value['student']['name']. '<input type="hidden" name="year_id" value="'.$value->year_id.'">'.'</td>';
            $html[$key]['tdsource'] .= '<td>'.$value['student']['fname']. '<input type="hidden" name="class_id" value="'.$value->class_id.'">'.'</td>';
            $html[$key]['tdsource'] .= '<td>'.$registrationfee->amount.'TK'. '<input type="hidden" name="date" value="'.$date.'">'.'</td>';
            $html[$key]['tdsource'] .= '<td>'.$value['discount']['discount'].'%'.'</td>';

            $originalfee =$registrationfee->amount;
            $discount = $value['discount']['discount'];
            $discountablefee = ($discount/100)*$originalfee;
            $finalfee = (int)$originalfee-(int)$discountablefee;
            $html[$key]['tdsource'] .= '<td>'.'<input type="text" name="amount[]" value="'.$finalfee.'" class="form-control" readonly />'.'</td>';
            $html[$key]['tdsource'] .= '<td>'.'<input type="hidden" name="student_id[]" value="'.$value->student_id.'" />'.'<input type="checkbox" name="checkmanage[]" value="'.$key.'" '.$checked.' style="transform:scale(1.5);margin-left:10px;" />'.'</td>';
        }
        return response()->json(@$html);

    }
    public function store(Request $request)
    {
        $date = date('Y-m',strtotime($request->date));
        AccountStudentFee::where('year_id',$request->year_id)->where('class_id',$request->class_id)->where('fee_category_id',$request->fee_category_id)->where('date',$date)->delete();
        $checkdata = $request->checkmanage;
        if ($checkdata != null) {
            for ($i=0; $i < count($checkdata) ; $i++) { 
            $data = new AccountStudentFee();
            $data->year_id = $request->year_id;
            $data->class_id = $request->class_id;
            $data->date = $date;
            $data->fee_category_id = $request->fee_category_id;
            $data->student_id = $request->student_id[$checkdata[$i]];
            $data->amount = $request->amount[$checkdata[$i]];
            $data->save();
            }
        }
        if (!empty(@$data) || empty($checkdata)) {
            return redirect()->route('students.accounts.fee.index')->with('success','well done ! Successfully updated');
        }else{
            return redirect()->back()->with('error','Sorry! Data Not Saved');
        }
    }
}
