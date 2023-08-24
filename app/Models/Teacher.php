<?php

namespace App\Models;

use App\Models\Section;
use App\Models\College;
use App\Models\Classroom;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Teacher extends Model
{
    use HasFactory;
    use HasTranslations;
    protected $table = 'teachers';
    public $translatable =['name'];
    protected $fillable=[
        'name','email','password', 'gender', 'birthday', 'college_id', 'level', 'user_id'
    ];
    protected $guarded =[];

    public function college()
    {
       return $this->belongsTo(College::class,'college_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
