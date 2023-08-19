<?php

namespace App\Models;

use App\Models\Image;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;
    use HasFactory;
    use HasTranslations;
    protected $table = 'students';
    public $translatable =['name'];
    protected $fillable = ['name',
    'email',
    'password',
    'birthday',
    'gender',
    'college_id',
    'classroom_id',
    'section_id',
    'academic_year',];
    protected $guarded =[];

    public function college(){
        return $this->belongsTo(College::class,'college_id');
     }

     public function classroom(){
         return $this->belongsTo(Classroom::class,'classroom_id');

     }

     public function section(){
         return $this->belongsTo(Section::class,'section_id');
     }
   
     public function subjects(){
        return $this->belongsToMany(Subject::class);
    }

    //  public function images()
    //  {
    //      return $this->morphMany(Image::class, 'imageable');
    //  }

 }


