<?php

namespace App\Models;

use App\Models\College;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classroom extends Model
{
    use HasFactory;

    protected $fillable=[
        'name','college_id'
    ];

    public function colleges(){
        return $this->belongsTo(College::class,'college_id');
    }

    public function sections(){
        return $this->hasMany(Section::class, 'classroom_id' );
    }

    public function students(){
        return $this->hasMany(Section::class, 'classroom_id' );
    }


}
