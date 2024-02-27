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
use App\Models\Designation;
use DB;
use PDF;

class EmployeeSalaryController extends Controller
{
    public function index()
    {

        $data['allData'] = User::where('usertype','employee')->get();
    
        return view('backend.Employee.employee_salary.employee_salary_view',$data);
    }

   

    public function increment($id)
    {
        $data['editData'] = User::find($id);
        $data['designations']=Designation::all();
        
        return view('backend.Employee.employee_salary.employees_salary_create ',$data);
    }
    public function store(Request $request,$id)
    {
            $user = User::find($id);
            $previous_salary = $user->salary;
            $present_salary = (float)$previous_salary + (float)$request->increment_salary;
            $user->salary = $present_salary;
            $user->save();

            $salaryData = new EmployeeSalaryLog();
            $salaryData->employee_id = $id;
            $salaryData->previous_salary = $previous_salary;
            $salaryData->present_salary = $present_salary;
            $salaryData->increment_salary = $request->increment_salary;
            $salaryData->effected_date = date('Y-m-d',strtotime($request->effected_date));
            $salaryData->save();

        return redirect()->route('employees.salary.index')->with('success','Data Inserted Successfully. ');
    }

     

    public function details($id)
    {
        $data['details'] = User::find($id);
        $data['salary_log']=EmployeeSalaryLog::where('employee_id',$data['details']->id)->get();
        
        return view('backend.Employee.employee_salary.employees_salary_details ',$data);
    }
}
