<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DormStudent extends Model
{
    use HasFactory;
    protected $fillable = ['city', 'room_number', 'unit_name', 'student_id'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
