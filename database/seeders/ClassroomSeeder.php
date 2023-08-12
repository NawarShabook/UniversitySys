<?php

namespace Database\Seeders;

use App\Models\College;
use App\Models\Classroom;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('classrooms')->delete();
        $classrooms=[
            ['en'=>'First group','ar'=>'الفرقة الأولي'],
            ['en'=>'Second group','ar'=>'الفرقة الثانية'],
            ['en'=>'Third group','ar'=>'الفرقة الثالثة'],
            ['en'=>'Fourth group','ar'=>'الفرقة الرابعة'],
        ];

        foreach($classrooms as $classroom){
            Classroom::create([
                'college_id' => College::all()->random()->id,
                'name'=>$classroom,
            ]);
        }
    }
}
