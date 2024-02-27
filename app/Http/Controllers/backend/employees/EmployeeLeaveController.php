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
use DB;
use PDF;

class EmployeeLeaveController extends Controller
{
     public function index()
    {

        $data['allData'] = EmployeeLeave::orderBy('id','desc')->get();
    
        return view('backend.Employee.employee_leave.employee_leave_view',$data);
    }

   

    public function create()
    {
        $data['employee']=User::where('usertype','employee')->get();
        $data['leave_purpose']=LeavePurpose::all();
        
        return view('backend.Employee.employee_leave.employee_leave_create ',$data);
    }
    public function store(Request $request)
    {
            
            if ($request->leave_purpose_id == '0') {
                $LeavePurpose = new LeavePurpose();
                $LeavePurpose->name = $request->name;
                $LeavePurpose->save();
                $leave_purpose_id = $LeavePurpose->id;

            }else{
                $leave_purpose_id = $request->leave_purpose_id;
        }
        $employee_leave = new EmployeeLeave();
            $employee_leave->employee_id = $request->employee_id;
            $employee_leave->start_date = date('Y-m-d',strtotime($request->start_date));
            $employee_leave->end_date = date('Y-m-d',strtotime($request->end_date));
            $employee_leave->leave_purpose_id = $leave_purpose_id;
            $employee_leave->save();
        return redirect()->route('employees.leave.index')->with('success','Data Inserted Successfully. ');
    }

     public function edit($id)
     {
        $data['employee']=User::where('usertype','employee')->get();
        $data['leave_purpose']=LeavePurpose::all();
        $data['editData']=EmployeeLeave::find($id);
        
        return view('backend.Employee.employee_leave.employee_leave_create ',$data);
     }

    public function update(Request $request,$id)
    {
         
            if ($request->leave_purpose_id == '0') {
                $LeavePurpose = new LeavePurpose();
                $LeavePurpose->name = $request->name;
                $LeavePurpose->save();
                $leave_purpose_id = $LeavePurpose->id;

            }else{
                $leave_purpose_id = $request->leave_purpose_id;
        }
        $employee_leave =  EmployeeLeave::find($id);
            $employee_leave->employee_id = $request->employee_id;
            $employee_leave->start_date = date('Y-m-d',strtotime($request->start_date));
            $employee_leave->end_date = date('Y-m-d',strtotime($request->end_date));
            $employee_leave->leave_purpose_id = $leave_purpose_id;
            $employee_leave->save();
        return redirect()->route('employees.leave.index')->with('success','Data Updated Successfully. ');
    }

}
