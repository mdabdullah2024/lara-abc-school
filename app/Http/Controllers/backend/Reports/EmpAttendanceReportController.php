<?php

namespace App\Http\Controllers\backend\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmployeeAttendance;
use App\Models\User;
use PDF;

class EmpAttendanceReportController extends Controller
{
    public function index()
    {
        $data['employees'] = User::where('usertype','employee')->get();
        return view('backend.ReportsManagement.EmployeeAttendanceReport.attendance_view',$data);
    }

    public function getattendance(Request $request)
    {
        $employee_id = $request->employee_id;
        if ($employee_id != '') {
            $where[] = ['employee_id',$employee_id];
        }
        $date = date('Y-m',strtotime($request->date));

        if ($date != '') {
            $where[] = ['date','like',$date.'%'];
        }
        $singleAttendance = EmployeeAttendance::with(['employee'])->where($where)->first();
        if ($singleAttendance == true) {
            $data['allData']=EmployeeAttendance::with(['employee'])->where($where)->get();
            $data['absents']=EmployeeAttendance::with(['employee'])->where($where)->where('attend_status','Absent')->get()->count();
            $data['leaves']=EmployeeAttendance::with(['employee'])->where($where)->where('attend_status','Leave')->get()->count();
            $data['month']= date('M-Y',strtotime($request->date));
            $pdf = PDF::loadView('backend.ReportsManagement.EmployeeAttendanceReport.pdf',$data);
            $pdf->SetProtection(['copy','print'],'','pass');
            return $pdf->stream('document.pdf');
        }
    }
}
