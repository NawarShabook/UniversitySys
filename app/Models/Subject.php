<?php

namespace App\Models;
use App\Models\Teacher;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Subject extends Model
{
    use HasFactory;
    use HasTranslations;
    protected $table = 'subjects';
    public $translatable =['name'];
    
    protected $fillable = ['name',
    'note',
    'college_id',
    'classroom_id',
    'section_id',
    'student_id',
    'teacher_id',
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function college()
    {
        return $this->belongsTo(College::class);
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }
    
    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
