<?php

namespace App\Http\Controllers\backend\accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmployeeAttendance;
use App\Models\AccountEmployeeSalary;
use App\Models\User;
use DB;

class EmployeeAccountSalaryController extends Controller
{
     public function index ()
    {
        $data['all'] = AccountEmployeeSalary::all();
        return view('backend.accounts.EmployeeFee.employee_fee_index',$data);
    }

    public function create ()
    {
        return view('backend.accounts.EmployeeFee.employee_fee_create');
    }

    public function getEmployee (Request $request)
    {
        $date = date('Y-m',strtotime($request->date));
        if ($date !='') {
            $where[] = ['date','like',$date.'%']; 
        }
        $data= EmployeeAttendance::select('employee_id')->groupBy('employee_id')->where($where)->with(['employee'])->get();
        $html['thsource'] = '<th>SL.</th>';
        $html['thsource'] .= '<th>ID No</th>';
        $html['thsource'] .= '<th>Employee Name</th>';
        $html['thsource'] .= '<th>Basic Salary</th>';
        $html['thsource'] .= '<th>Salary (This Month)</th>';
        $html['thsource'] .= '<th>Select</th>';

        foreach ($data as $key => $value) {
            $accont_salary = AccountEmployeeSalary::where('employee_id',$value->employee_id)->where('date',$date)->first();
            if ($accont_salary != null) {
                $checked = 'checked';
            }else{
                $checked = '';
            }
            $total_attend = EmployeeAttendance::with(['employee'])->where($where)->where('employee_id',$value->employee_id)->get();
            $absent_count = count($total_attend->where('attend_status','Absent'));


            $html[$key]['tdsource'] = '<td>'.($key+1).'</td>';
            $html[$key]['tdsource'] .= '<td>'.$value['employee']['id_no']. '<input type="hidden" name="date" value="'.$date.'">'.'</td>';
            $html[$key]['tdsource'] .= '<td>'.$value['employee']['name'].'</td>';
            $html[$key]['tdsource'] .= '<td>'.$value['employee']['salary'].'TK'.'</td>';

            $salary =(float)$value['employee']['salary'];
            $salary_per_day = (float)$salary/30;
            $total_salary_minus = (float)$absent_count*(float)$salary_per_day;
            $totalSalary = (float)$salary-(float)$total_salary_minus;

            $html[$key]['tdsource'] .= '<td>'.$totalSalary.'<input type="hidden" name="amount[]" value="'.$totalSalary.'" />'.'</td>';
            $html[$key]['tdsource'] .= '<td>'.'<input type="hidden" name="employee_id[]" value="'.$value->employee_id.'" />'.'<input type="checkbox" name="checkmanage[]" value="'.$key.'" '.$checked.' style="transform:scale(1.5);margin-left:10px;" />'.'</td>';
        }
        return response()->json(@$html);

    }
    public function store(Request $request)
    {
        $date = date('Y-m',strtotime($request->date));

        AccountEmployeeSalary::where('date',$date)->delete();
        $checkdata = $request->checkmanage;
        if ($checkdata != null) {
            for ($i=0; $i < count($checkdata) ; $i++) { 
            $data = new AccountEmployeeSalary();
            $data->date = $date;
            $data->employee_id = $request->employee_id[$checkdata[$i]];
            $data->amount = $request->amount[$checkdata[$i]];
            $data->save();
            }
        }
        if (!empty(@$data) || empty($checkdata)) {
            return redirect()->route('employee.accounts.fee.index')->with('success','well done ! Successfully updated');
        }else{
            return redirect()->back()->with('error','Sorry! Data Not Saved');
        }
    }
}
