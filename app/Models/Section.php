<?php

namespace App\Models;

use App\Models\College;
use App\Models\Classroom;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Section extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['name'];
    protected $fillable = ['name','status','college_id','classroom_id'];

    public function classrooms(){
        return $this->belongsTo(Classroom::class,'classroom_id');
    }
    public function colleges(){
        return $this->belongsTo(College::class,'college_id');
    }
    public function students(){
        return $this->hasMany(Section::class, 'section_id' );
    }
}
