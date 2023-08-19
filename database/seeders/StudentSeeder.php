<?php

namespace Database\Seeders;


use App\Models\Section;
use App\Models\Student;
use App\Models\College;
use App\Models\Classroom;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students')->delete();

        $students= new Student();
        $students->name='Nawar Shabook';
        $students->email='nawarshabook@gmail.com';
        $students->birthday='1999-10-08';
        $students->password= Hash::make('12345678');
        $students->gender= 'male';
        $students->college_id=College::all()->unique()->random()->id;
        $students->classroom_id=Classroom::all()->unique()->random()->id;
        $students->section_id=Section::all()->unique()->random()->id;
        $students->academic_year='2022';
        $students->save();

        $students2= new Student();
        $students2->name='Nawar Shabook22';
        $students2->email='nawarshabook1@gmail.com';
        $students2->birthday='1999-10-08';
        $students2->password= Hash::make('12345678');
        $students2->gender= 'male';
        $students2->college_id=College::all()->unique()->random()->id;
        $students2->classroom_id=Classroom::all()->unique()->random()->id;
        $students2->section_id=Section::all()->unique()->random()->id;
        $students2->academic_year='2022';
        $students2->save();

        $students3= new Student();
        $students3->name=["ar"=>'ياسين' , "en"=>'yaseen'];
        $students3->email='yaseen@gmail.com';
        $students3->birthday='2000-10-08';
        $students3->password= Hash::make('12345678');
        $students3->gender= 'male';
        $students3->college_id=4;
        $students3->classroom_id=11;
        $students3->section_id=4;
        $students3->academic_year='2023';
        $students3->save();
    }
}
