<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeAmount extends Model
{
    use HasFactory;

    public function feeCategory()
    {
        return $this->belongsTo(FeeCategory::class,'fee_category_id');
    }
    public function student_class()
    {
        return $this->belongsTo(StudentClass::class,'class_id');
    }
}
