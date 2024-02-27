<?php

namespace App\Http\Controllers\backend\employees;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssignStudent;
use App\Models\DiscountStudent;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\StudentShift;
use App\Models\year;
use App\Models\User;
use App\Models\EmployeeSalaryLog;
use App\Models\EmployeeLeave;
use App\Models\LeavePurpose;
use App\Models\Designation;
use App\Models\EmployeeAttendance;
use DB;
use PDF;

class EmployeeMonthlySalaryController extends Controller
{
     public function index()
    {

        $data['allData'] = EmployeeAttendance::select('date')->groupBy('date')->orderBy('id','desc')->get();
    
        return view('backend.Employee.employee_Monthly_Salary.employee_Monthly_Salary_view',$data);
    }

   

    public function getSalary(Request $request)
    {
        $date = date('Y-m',strtotime($request->date));
        if ($date !='') {
            $where[] = ['date','like',$date.'%'];
        }
        $allData = EmployeeAttendance::select('employee_id')->groupBy('employee_id')->with(['employee'])->where($where)->get();
        $html['thsource'] = '<th>SL</th>';
        $html['thsource'] .= '<th>Employee Name</th>';
        $html['thsource'] .= '<th>Basic Salary</th>';
        $html['thsource'] .= '<th>Salary(This Month)</th>';
        $html['thsource'] .= '<th>Action</th>';

        foreach($allData as $key =>$v){
            $total_attend = EmployeeAttendance::with(['employee'])->where($where)->where('employee_id',$v->employee_id)->get();
            $absent_count = count($total_attend->where('attend_status','Absent'));

            $color = 'success';

            $html[$key]['tdsource']='<td>'.($key+1).'</td>';
            $html[$key]['tdsource'].='<td>'.$v['employee']['name'].'</td>';
            $html[$key]['tdsource'].='<td>'.$v['employee']['salary'].'</td>';
            $salary =(float)$v['employee']['salary'];
            $dailySalary = (float)$salary/30;
            $total_salary_minus = (float)$absent_count*(float)$dailySalary;
            $totalSalary = (float)$salary-(float)$total_salary_minus;

            $html[$key]['tdsource'].='<td>'.$totalSalary.'</td>';
            $html[$key]['tdsource'] .='<td><a  class=" btn btn-sm btn-'.$color.'" title="Payslip" target="_blank" href="'.route("employees.salary.monthly.payslip",$v->employee_id).'" >Fee Slip</a></td>';

            

            }
            return response()->json(@$html);
    }
    public function payslip(Request $request,$employee_id)
    {
            $id = EmployeeAttendance::where('employee_id',$employee_id)->first();
            $date = date('Y-m',strtotime($id->date));
            if($date!=''){
                $where[] = ['date','like',$date.'%'];
            }

            $data['total_attend_groupBy_id'] = EmployeeAttendance::with(['employee'])->where($where)->where('employee_id',$id->employee_id)->get();
            $pdf = PDF::loadView('backend.Employee.employee_Monthly_Salary.employee_Monthly_Salary_payslip.pdf',$data);
            $pdf->SetProtection(['copy','print'],'','pass');
            return  $pdf->stream('document.pdf');
    }

}
