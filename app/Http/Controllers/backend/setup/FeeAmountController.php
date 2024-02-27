<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FeeCategory;
use App\Models\StudentClass;
use App\Models\FeeAmount;
use DB;

class FeeAmountController extends Controller
{
     public function index()
    {  

        $data['allData'] = FeeAmount::select('fee_category_id')->groupBy('fee_category_id')->with('feeCategory')->get();
        return view('backend.setup.FeeAmount.fee_amount_view',$data);
    }

    public function create()
    {
        $data['fee_category']= FeeCategory::all();
        $data['student_classes']= StudentClass::all();
        
        return view('backend.setup.FeeAmount.fee_amount_create',$data);
    }

    public function store(Request $request)
    {
        $countClass = count($request->class_id);
        if ($countClass != NULL) {
            for ($i=0; $i <$countClass ; $i++) { 
               $fa = new FeeAmount();
               $fa->fee_category_id = $request->fee_category_id;
               $fa->class_id = $request->class_id[$i];
               $fa->amount = $request->amount[$i];
               $fa->save();
            }
        }
        return redirect()->route('setup.fee.amount.index')->with('success','Data Added Successfully.');
    }

    public function edit($fee_category_id)
    {
        $data['editData'] = FeeAmount::where('fee_category_id',$fee_category_id)->orderBy('class_id','asc')->get();
        $data['fee_category']= FeeCategory::all();
        $data['student_classes']= StudentClass::all();
       
        return view('backend.setup.FeeAmount.fee_amount_edit',$data);
    }
    public function update(Request $request,$fee_category_id)
    {
        if ($request->class_id == NULL) {
            return redirect()->back()->with('error','Sorry! You do not Select Any item.');
        }else{
            FeeAmount::where('fee_category_id',$fee_category_id)->delete();
            $countClass = count($request->class_id);
            for ($i=0; $i <$countClass ; $i++) { 
               $fa = new FeeAmount();
               $fa->fee_category_id = $request->fee_category_id;
               $fa->class_id = $request->class_id[$i];
               $fa->amount = $request->amount[$i];
               $fa->save();
            }
        
        }

        return redirect()->route('setup.fee.amount.index')->with('success','Data Updated Successfully.');
    }

    public function show($fee_category_id)
    {
        $data['editData'] = FeeAmount::where('fee_category_id',$fee_category_id)->orderBy('class_id','asc')->get();
       
        return view('backend.setup.FeeAmount.fee_amount_show',$data);
    }

     public function destroy($id)
        {
          
            $data = FeeAmount::find($id);
            $data->delete();
            return redirect()->route('setup.fee.amount.index')->with('success','Data Deleted Successfully.');
        }
}
