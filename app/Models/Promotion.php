<?php

namespace App\Models;

use App\Models\Section;
use App\Models\Student;
use App\Models\College;
use App\Models\Classroom;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Promotion extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function students(){
        return $this->belongsTo(Student::class,'student_id');
    }
    public function f_colleges(){
        return $this->belongsTo(College::class,'from_college_id');
     }

     public function f_classrooms(){
         return $this->belongsTo(Classroom::class,'from_classroom_id');

     }

     public function f_sections(){
         return $this->belongsTo(Section::class,'from_section_id');
     }
    public function t_colleges(){
        return $this->belongsTo(College::class,'to_college_id');
     }

     public function t_classrooms(){
         return $this->belongsTo(Classroom::class,'to_classroom_id');

     }

     public function t_sections(){
         return $this->belongsTo(Section::class,'to_section_id');
     }
}
