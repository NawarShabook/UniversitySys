<?php

namespace Database\Seeders;

use App\Models\College;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CollegeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('colleges')->delete();
        $colleges=[
            ['en'=>'College Of Education', 'ar'=>'كلية التربية '],
            ['en'=>'College of Computer and Information','ar'=>'كلية حاسبات ومعلومات'],
            ['en'=>'college Of Medicine','ar'=>'كلية الطب'],
            ['en'=>'College of Engineering','ar'=>'كلية الهندسة'],
            ['en'=>'College of Literature','ar'=>'كلية الأداب '],
            ['en'=>'College of Science','ar'=>'كلية العلوم'],
            ['en'=>'College of Archaeology','ar'=>'كلية الاثار']
        ];

        foreach($colleges as $college){
            College::create(['name'=>$college]);
        }
    }
}
