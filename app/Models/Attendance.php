<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'student_id',
        'grade_id',
        'date',
        'reason', //null
        'status',
    ];

    public function student(){
        return $this->belongsTo(Student::class);
    }

    public function grade(){
        return $this->belongsTo(Grade::class);
    }
}
