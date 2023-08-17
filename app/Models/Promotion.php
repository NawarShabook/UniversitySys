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

    public function student(){
        return $this->belongsTo(Student::class,'student_id');
    }


     
     public function f_classroom(){
         return $this->belongsTo(Classroom::class,'from_classroom_id');

     }

     public function f_section(){
         return $this->belongsTo(Section::class,'from_section_id');
     }

     public function t_classroom(){
         return $this->belongsTo(Classroom::class,'to_classroom_id');

     }

     public function t_section(){
         return $this->belongsTo(Section::class,'to_section_id');
     }
}
