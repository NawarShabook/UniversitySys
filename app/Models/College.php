<?php

namespace App\Models;

use App\Models\Section;
use App\Models\Classroom;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class College extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['name'];

    protected $fillable=[
        'name','note'
    ];

    public function classrooms(){
        return $this->hasMany(Classroom::class, 'college_id');

    }
    public function sections(){
        return $this->hasMany(Section::class, 'college_id' );
    }
    public function teachers(){
        return $this->hasMany(Section::class, 'college_id' );
    }
    public function students(){
        return $this->hasMany(Section::class, 'college_id' );
    }
}
