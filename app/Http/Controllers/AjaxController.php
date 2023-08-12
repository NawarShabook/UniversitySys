<?php

namespace App\Http\Controllers;

use App\Models\College;
use App\Models\Classroom;
use App\Models\Section;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    // Get Classrooms
    public function getClassrooms($id)
    {
        $classrooms= Classroom::where("college_id", $id)->pluck("name", "id");
        // $classrooms = College::where("id", $id)->first()->classrooms()->pluck("name", "id");

        return $classrooms;

    }

    //Get Sections
    public function Get_Sections($id){

        return Section::where("classroom_id", $id)->pluck("name", "id");
        // $sections = Classroom::where("id", $id)->first()->sections()->pluck("name", "id");
        // return $sections;

    }
}
