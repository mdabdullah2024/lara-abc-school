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

class EmployeeRegController extends Controller
{
    public function index()
    {
        $data['allData'] = User::where('usertype','employee')->get();
    
        return view('backend.Employee.employee_reg.employee_reg_view',$data);
    }

    public function create()
    {
        $data['designations']=Designation::all();
        return view('backend.Employee.employee_reg.employees_reg_create',$data);
    }

    public function classYearWise(Request $request)
    {
        $data['years']= Year::orderBy('id','desc')->get();
        $data['classes']= StudentClass::all();
        $data['year_id']= $request->year_id;
        $data['class_id']= $request->class_id;
        $data['allData'] = AssignStudent::where('year_id',$request->year_id)->where('class_id',$request->class_id)->get();
        return view('backend.students.students_reg.students_reg_view',$data);
    }

    public function store(Request $request)
    {
        DB::transaction(function() use($request){

            $checkYear = date('Ym',strtotime($request->join_date));
            $employee = User::where('usertype','employee')->orderBy('id','DESC')->first();
            if($employee == null){
                $firstReg = 0;
                $employeeId = $firstReg+1;
                if($employeeId<10){
                    $id_no = '000'.$employeeId;
                }elseif ($employeeId<100) {
                    $id_no = '00'.$employeeId;
                }elseif ($employeeId<1000) {
                    $id_no = '0'.$employeeId;
                }
            }else{
                $employee = User::where('usertype','employee')->orderBy('id','DESC')->first()->id;
                $employeeId = $employee+1;
                if($employeeId<10){
                    $id_no = '000'.$employeeId;
                }elseif ($employeeId<100) {
                    $id_no = '00'.$employeeId;
                }elseif ($employeeId<1000) {
                    $id_no = '0'.$employeeId;
                }
            }
            $finalId = $checkYear.$id_no;
            $code = rand(0000,9999);
            $user = new User();
            $user->id_no = $finalId;
            $user->usertype = 'employee';
            $user->password = bcrypt($code);
            $user->code = $code;
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address= $request->address;
            $user->gender= $request->gender;
            $user->salary= $request->salary;
            $user->designation_id = $request->designation_id ;
            $user->religion = $request->religion;
            $user->dob = date('Y-m-d',strtotime($request->dob));
            $user->join_date = date('Y-m-d',strtotime($request->join_date));
            if($request->file('image')){
                $file = $request->file('image');
                $filename = uniqid().$file->getClientOriginalName();
                $file->move(public_path('upload/employees_images'),$filename);
                $user->image = $filename;
            }
            $user->save();

            $employee_salary = new EmployeeSalaryLog ();
            $employee_salary->employee_id = $user->id;
            $employee_salary->effected_date = date('Y-m-d',strtotime($request->join_date));
            $employee_salary->previous_salary = $request->salary;
            $employee_salary->present_salary = $request->salary;
            $employee_salary->increment_salary = '0';
            $employee_salary->save();


        });

        return redirect()->route('employees.registration.index')->with('success','Data Inserted Successfully. ');
    }

    public function edit($id)
    {
        $data['editData'] = User::find($id);
        $data['designations']=Designation::all();
        
        return view('backend.Employee.employee_reg.employees_reg_create ',$data);
    }
    public function update(Request $request,$id)
    {
            $user = User::find($id);
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address= $request->address;
            $user->gender= $request->gender;
            $user->designation_id = $request->designation_id ;
            $user->religion = $request->religion;
            $user->dob = date('Y-m-d',strtotime($request->dob));
            if($request->file('image')){
                $file = $request->file('image');
                @unlink(public_path('upload/employees_images',$user->image));
                $filename = uniqid().$file->getClientOriginalName();
                $file->move(public_path('upload/employees_images'),$filename);
                $user->image = $filename;
            }
            $user->save();
        return redirect()->route('employees.registration.index')->with('success','Data Updated Successfully. ');
    }

     

    public function details($id)
    {
        $data['details'] = User::find($id);
            $pdf = PDF::loadView('backend.Employee.employee_reg.employees_reg_details_pdf', $data);
            $pdf->SetProtection(['copy', 'print'], '', 'pass');
            return $pdf->stream('document.pdf');
    }
}
