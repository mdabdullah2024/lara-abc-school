<?php

namespace App\Http\Controllers\backend\students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssignStudent;
use App\Models\DiscountStudent;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\StudentShift;
use App\Models\year;
use App\Models\User;
use DB;
use PDF;
class studentRegController extends Controller
{
    public function index()
    {  
        $data['years']= Year::orderBy('id','desc')->get();
        $data['year_id']= Year::orderBy('id','desc')->first()->id;
        $data['class_id']= StudentClass::orderBy('id','asc')->first()->id;
        $data['classes']= StudentClass::all();
        $data['allData'] = AssignStudent::where('year_id',$data['year_id'])->where('class_id',$data['class_id'])->get();
    
        return view('backend.students.students_reg.students_reg_view',$data);
    }

    public function create()
    {
        $data['years']= Year::orderBy('id','desc')->get();
        $data['classes']= StudentClass::all();
        $data['groups']= StudentGroup::all();
        $data['shifts']= StudentShift::all();
        return view('backend.students.students_reg.students_reg_create',$data);
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

            $checkYear = Year::find($request->year_id)->name;
            $student = User::where('usertype','student')->orderBy('id','DESC')->first();
            if($student == null){
                $firstReg = 0;
                $studentId = $firstReg+1;
                if($studentId<10){
                    $id_no = '000'.$studentId;
                }elseif ($studentId<100) {
                    $id_no = '00'.$studentId;
                }elseif ($studentId<1000) {
                    $id_no = '0'.$studentId;
                }
            }else{
                $student = User::where('usertype','student')->orderBy('id','DESC')->first()->id;
                $studentId = $student+1;
                if($studentId<10){
                    $id_no = '000'.$studentId;
                }elseif ($studentId<100) {
                    $id_no = '00'.$studentId;
                }elseif ($studentId<1000) {
                    $id_no = '0'.$studentId;
                }
            }
            $finalId = $checkYear.$id_no;
            $code = rand(0000,9999);
            $user = new User();
            $user->id_no = $finalId;
            $user->usertype = 'student';
            $user->password = bcrypt($code);
            $user->code = $code;
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address= $request->address;
            $user->gender= $request->gender;
            $user->religion = $request->religion;
            $user->dob = date('Y-m-d',strtotime($request->dob));
            if($request->file('image')){
                $file = $request->file('image');
                $filename = uniqid().$file->getClientOriginalName();
                $file->move(public_path('upload/students_images'),$filename);
                $user->image = $filename;
            }
            $user->save();

            $AssignStudent = new AssignStudent();
            $AssignStudent->student_id = $user->id;
            $AssignStudent->year_id = $request->year_id;
            $AssignStudent->class_id = $request->class_id;
            $AssignStudent->shift_id = $request->shift_id;
            $AssignStudent->group_id = $request->group_id;
            $AssignStudent->save();

            $studentDiscount = new DiscountStudent();
            $studentDiscount->assign_student_id = $AssignStudent->id;
            $studentDiscount->discount = $request->discount;
            $studentDiscount->fee_category_id = 1;
            $studentDiscount->save();

            
        });

        return redirect()->route('students.registration.index')->with('success','Data Inserted Successfully. ');
    }

    public function edit($student_id)
    {
        $data['editData'] = AssignStudent::with(['student','discount'])->where('student_id',$student_id)->first();

        //dd($data['editData']->toArray());
        $data['years']= Year::orderBy('id','desc')->get();
        $data['classes']= StudentClass::all();
        $data['groups']= StudentGroup::all();
        $data['shifts']= StudentShift::all();
        return view('backend.students.students_reg.students_reg_create',$data);
    }
    public function update(Request $request,$student_id)
    {
         DB::transaction(function() use($request,$student_id){

           
            $user = User::where('id',$student_id)->first();
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address= $request->address;
            $user->gender= $request->gender;
            $user->religion = $request->religion;
            $user->dob = date('Y-m-d',strtotime($request->dob));
            if($request->file('image')){
                $file = $request->file('image');
                @unlink(public_path('upload/students_images',$user->image));
                $filename = uniqid().$file->getClientOriginalName();
                $file->move(public_path('upload/students_images'),$filename);
                $user->image = $filename;
            }
            $user->save();

            $AssignStudent =  AssignStudent::where('id',$request->id)->where('student_id',$student_id)->first();
            $AssignStudent->year_id = $request->year_id;
            $AssignStudent->class_id = $request->class_id;
            $AssignStudent->shift_id = $request->shift_id;
            $AssignStudent->group_id = $request->group_id;
            $AssignStudent->save();

            $studentDiscount =  DiscountStudent::where('assign_student_id',$request->id)->first();
            $studentDiscount->assign_student_id = $AssignStudent->id;
            $studentDiscount->discount = $request->discount;
            $studentDiscount->save();

            
        });

        return redirect()->route('students.registration.index')->with('success','Data Updated Successfully. ');
    }

     public function studentPromotion($student_id)
     {
        $data['editData'] = AssignStudent::with(['student','discount'])->where('student_id',$student_id)->first();
        $data['years']= Year::orderBy('id','desc')->get();
        $data['classes']= StudentClass::all();
        $data['groups']= StudentGroup::all();
        $data['shifts']= StudentShift::all();
        return view('backend.students.students_reg.promotion',$data);
     }
     public function studentPromotionStore(Request $request,$student_id)
    {
         DB::transaction(function() use($request,$student_id){

           
            $user = User::where('id',$student_id)->first();
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address= $request->address;
            $user->gender= $request->gender;
            $user->religion = $request->religion;
            $user->dob = date('Y-m-d',strtotime($request->dob));
            if($request->file('image')){
                $file = $request->file('image');
                @unlink(public_path('upload/students_images',$user->image));
                $filename = uniqid().$file->getClientOriginalName();
                $file->move(public_path('upload/students_images'),$filename);
                $user->image = $filename;
            }
            $user->save();

            $AssignStudent = new AssignStudent();
            $AssignStudent->student_id = $student_id;
            $AssignStudent->year_id = $request->year_id;
            $AssignStudent->class_id = $request->class_id;
            $AssignStudent->shift_id = $request->shift_id;
            $AssignStudent->group_id = $request->group_id;
            $AssignStudent->save();

            $studentDiscount = new DiscountStudent();
            $studentDiscount->assign_student_id = $AssignStudent->id;
            $studentDiscount->discount = $request->discount;
            $studentDiscount->fee_category_id = 1;
            $studentDiscount->save();

            
        });

        return redirect()->route('students.registration.index')->with('success','Data Promoted Successfully. ');
    }

    public function details($student_id)
    {
        $data['details'] = AssignStudent::with(['student','discount','feeAmount'])->where('student_id',$student_id)->first();
            $pdf = PDF::loadView('backend.students.students_reg.students_reg_details_pdf', $data);
            $pdf->SetProtection(['copy', 'print'], '', 'pass');
            return $pdf->stream('document.pdf');
    }
}
