<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountStudentFee extends Model
{
    use HasFactory;
    public function student(){
        return $this->belongsTo(User::class,'student_id');
    }

    public function year(){
        return $this->belongsTo(Year::class,'year_id','id');
    }

    public function student_class(){
        return $this->belongsTo(StudentClass::class,'class_id','id');
    }

    public function fee_category(){
        return $this->belongsTo(FeeCategory::class,'fee_category_id');
    }

    
}
