<?php

namespace App\Models;
use App\Models\Section;
use App\Models\Student;
use App\Models\College;
use App\Models\Classroom;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Graduated extends Model
{
    use HasFactory;
    protected $guarded =[];

    protected $fillable=[
        'student_id','classroom_id', 'section_id', 'college_id'
    ];


    public function student(){
        return $this->belongsTo(Student::class,'student_id')->withTrashed();
    }


     
     public function classroom(){
         return $this->belongsTo(Classroom::class,'classroom_id');

     }

     public function section(){
         return $this->belongsTo(Section::class,'section_id');
     }
}
