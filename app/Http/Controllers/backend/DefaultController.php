<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssignStudent;
use App\Models\DiscountStudent;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\StudentShift;
use App\Models\year;
use App\Models\StudentMarks;
use App\Models\User;
use App\Models\AssignSubject;
use DB;
use PDF;

class DefaultController extends Controller
{
    public function getStudent(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $allData = AssignStudent::with(['student'])->where('year_id',$year_id)->where('class_id',$class_id)->get();
        return response()->json($allData);

    }
    public function getSubject(Request $request)
    {
        $class_id = $request->class_id;
        $allData = AssignSubject::with(['subject'])->where('class_id',$class_id)->get();
        return response()->json($allData);
    }
}
