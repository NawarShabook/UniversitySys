<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
      User::create([
            'name' =>'Admin',
            'email' =>'a@a.a',
            'password' =>Hash::make('1')
        ])->assignRole('admin');

      User::create([
            'name' =>'Samer',
            'email' =>'s@a.a',
            'password' =>Hash::make('1')
        ])->assignRole('teacher');

      User::create([
            'name' =>'ahmad',
            'email' =>'ah@a.a',
            'password' =>Hash::make('1')
        ])->assignRole('student');

      User::create([
            'name' =>'khaled',
            'email' =>'k@a.a',
            'password' =>Hash::make('1')
        ])->assignRole('student');
    }
}
