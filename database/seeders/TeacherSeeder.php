<?php

namespace Database\Seeders;


use App\Models\Teacher;
use App\Models\College;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teachers')->delete();

        $teacher= new Teacher();
        $teacher->name=['ar'=> 'جاهد باشا', 'en'=>'jahed basha'];
        $teacher->email='jahedbasha@gmail.com';
        $teacher->birthday='1988-10-08';
        $teacher->user_id=2;
        $teacher->gender= 'male';
        $teacher->college_id=2;
        $teacher->level='doctor';
        $teacher->save();


        // $teacher= new Teacher();
        // $teacher->name=['ar'=> 'وضاح عابد', 'en'=>'waddahabed'];
        // $teacher->email='waddahabed@gmail.com';
        // $teacher->birthday='1977-10-08';
        // $teacher->password= Hash::make('12345678');
        // $teacher->gender= 'male';
        // $teacher->college_id=4;
        // $teacher->level='master';
        // $teacher->save();

        // $teacher= new Teacher();
        // $teacher->name=['ar'=> 'عبد الحليم مصطفى', 'en'=>'abdulhalim mostafa'];
        // $teacher->email='abdulmos@gmail.com';
        // $teacher->birthday='1978-10-08';
        // $teacher->password= Hash::make('12345678');
        // $teacher->gender= 'male';
        // $teacher->college_id=4;
        // $teacher->level='master';
        // $teacher->save();
    }
}
