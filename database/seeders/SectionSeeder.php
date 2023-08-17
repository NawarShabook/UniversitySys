<?php

namespace Database\Seeders;

use App\Models\Section;
use App\Models\College;
use App\Models\Classroom;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sections')->delete();

        $section1=[
            'en'=>'informatics','ar'=>'معلوماتية'
        ];
        $section2=[
             'en'=>'software','ar'=>'برمجيات'
         ];
         $section3=[
             'en'=>'heart','ar'=>'قلبية'
         ];
         $section4=[
            'en'=>'software','ar'=>'برمجيات'
         ];

        
        Section::create([
            'college_id'=>2,
            'classroom_id'=>8,
            'name'=>$section2,
            'status'=>1
        ]);
        Section::create([
            'college_id'=>4,
            'classroom_id'=>14,
            'name'=>$section1,
            'status'=>1
        ]);
        Section::create([
            'college_id'=>3,
            'classroom_id'=>10,
            'name'=>$section3,
            'status'=>1
        ]);

        Section::create([
            'college_id'=>4,
            'classroom_id'=>25,
            'name'=>$section4,
            'status'=>1
        ]);
            
    }
    
}
