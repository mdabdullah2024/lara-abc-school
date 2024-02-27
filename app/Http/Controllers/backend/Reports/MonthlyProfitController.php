<?php

namespace App\Http\Controllers\backend\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AccountStudentFee;
use App\Models\AccountOtherCost;
use App\Models\AccountEmployeeSalary;
use PDF;

class MonthlyProfitController extends Controller
{
    public function index ()
    {
        return view('backend.ReportsManagement.MonthlyProfit.monthly_profit_view');
    }

    public function getProfit(Request $request)
    {
        
        $start_date = date('Y-m',strtotime($request->start_date));
        $end_date = date('Y-m',strtotime($request->end_date));
        $sdate = date('Y-m-d',strtotime($request->start_date));
        $edate = date('Y-m-d',strtotime($request->end_date));

        $student_fee = AccountStudentFee::whereBetween('date',[$start_date,$end_date])->sum('amount');
        $other_cost = AccountOtherCost::whereBetween('date',[$sdate,$edate])->sum('amount');
        $emp_salary = AccountEmployeeSalary::whereBetween('date',[$start_date,$end_date])->sum('amount');

        $total_cost  = $other_cost+$emp_salary;
        $profit = $student_fee-$total_cost;

        $html['thsource'] ='<th>Students Fees</th>';
        $html['thsource'].='<th>Other Cost</th>';
        $html['thsource'].='<th>Employee Salary</th>';
        $html['thsource'].='<th>Total Costs</th>';
        $html['thsource'].='<th>Profit/Loss</th>';
        $html['thsource'].='<th>Action</th>';

        $color = 'success';

        $html['tdsource']  ='<td>'.$student_fee.'</td>';
        $html['tdsource'] .='<td>'.$other_cost.'</td>';
        $html['tdsource'] .='<td>'.$emp_salary.'</td>';
        $html['tdsource'] .='<td>'.$total_cost.'</td>';
        $html['tdsource'] .='<td>'.$profit.'</td>';
        $html['tdsource'] .='<td><a class="btn btn-sm btn-'.$color.'" title="Reports" target="_blank" href="'.route('reports.profit.pdf').'?start_date='.$sdate.'&end_date='.$edate.'"><i class="fa fa-file"></i></a></td>';


        return response()->json(@$html);
    }
    public function profitPdf(Request $request)
    {
        $start_date = date('Y-m',strtotime($request->start_date));
        $end_date = date('Y-m',strtotime($request->end_date));
        $sdate = date('Y-m-d',strtotime($request->start_date));
        $edate = date('Y-m-d',strtotime($request->end_date));

        $data['sdate'] = date('Y-m',strtotime($request->start_date));
        $data['edate'] = date('Y-m',strtotime($request->end_date));
        $data['start_date'] = date('Y-m-d',strtotime($request->start_date));
        $data['end_date'] = date('Y-m-d',strtotime($request->end_date));
        $data['student_fee'] = AccountStudentFee::whereBetween('date',[$start_date,$end_date])->sum('amount');
        $data['other_cost'] = AccountOtherCost::whereBetween('date',[$sdate,$edate])->sum('amount');
        $data['emp_salary'] = AccountEmployeeSalary::whereBetween('date',[$start_date,$end_date])->sum('amount');

        $pdf = PDF::loadView('backend.ReportsManagement.MonthlyProfit.profit_pdf',$data);
        $pdf->SetProtection(['copy','print'],'','pass');
        return $pdf->stream('document.pdf');

    }
}
