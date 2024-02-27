<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class AssignSubject extends Model
{
    use HasFactory;

    public function student_class()
    {
        return $this->belongsTo(StudentClass::class,'class_id','id');
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class,'subject_id','id');
    }

    
}
