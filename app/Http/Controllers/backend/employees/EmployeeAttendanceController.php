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

class EmployeeAttendanceController extends Controller
{
     public function index()
    {

        $data['allData'] = EmployeeAttendance::select('date')->groupBy('date')->orderBy('id','desc')->get();
    
        return view('backend.Employee.employee_attendance.employee_attendance_view',$data);
    }

   

    public function create()
    {
        $data['employee']=User::where('usertype','employee')->get();
        $data['leave_purpose']=LeavePurpose::all();
        
        return view('backend.Employee.employee_attendance.employee_attendance_create ',$data);
    }
    public function store(Request $request)
    {
        EmployeeAttendance::where('date',date('Y-m-d',strtotime($request->date)))->delete();
        $countEmployee = count($request->employee_id);
        for ($i=0; $i <$countEmployee ; $i++) { 
            $attend_status = 'attend_status'.$i;
            $attend = new EmployeeAttendance();
            $attend->date = date('Y-m-d',strtotime($request->date));
            $attend->employee_id = $request->employee_id[$i];
            $attend->attend_status = $request->$attend_status;
            $attend->save();
        }
        return redirect()->route('employees.attendance.index')->with('success','Data Inserted Successfully. ');
    }

     public function edit($date)
     {
        $data['editData']=EmployeeAttendance::where('date',$date)->get();
        $data['employee']=User::where('usertype','employee')->get();
        
        
        return view('backend.Employee.employee_attendance.employee_attendance_create ',$data);
     }

    public function details($date)
    {
         
        $data['details']=EmployeeAttendance::where('date',$date)->get();
       return view('backend.Employee.employee_attendance.employee_attendance_details ',$data);
    }
}
