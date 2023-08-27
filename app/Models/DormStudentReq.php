<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DormStudentReq extends Model
{
    use HasFactory;
    protected $fillable = ['city', 'student_id','note', 'status'];
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

}
