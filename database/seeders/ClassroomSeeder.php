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
        $classrooms=["1","2","3","4"];

        foreach($classrooms as $classroom){
            $colleges=College::pluck('id');
            foreach($colleges as $college){

                Classroom::create([
                    'college_id' => $college,
                    'name'=>$classroom,
                ]);
            }
            
        }
    }
}
