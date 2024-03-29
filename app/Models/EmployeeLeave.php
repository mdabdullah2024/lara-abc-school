<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeLeave extends Model
{
    use HasFactory;

    public function employee()
    {
        return $this->belongsTo(User::class,'employee_id');
    }

    public function leavePurpose()
    {
        return $this->belongsTo(LeavePurpose::class,'leave_purpose_id');
    }
}
