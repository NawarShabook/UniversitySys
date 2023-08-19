<?php

namespace App\Http\Controllers\Student;

use App\Models\Image;
use App\Models\Teacher;
use App\Models\Section;
use App\Models\Student;
use App\Models\College;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\App;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $students=Student::all();   

        return view('pages.student.index',[
        'students' => $students,
        'colleges'=>College::all(),
   
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.student.create',[
        'colleges'=>College::all(),
        'classrooms'=>Classroom::all(),
        'sections'=>Section::all(),

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // DB::beginTransaction();
        
        try{
            $request->validate([
                // 'name' =>['required','max:20',],
                'email'=>['string','required','email','max:255'],
                'password' =>['string','required','min:8'],
                'birthday'=>['required'],
                'gender'=>['required'],
                'college_id'=>['required'],
                'classroom_id'=>['required'],
                // 'section_id'=>['required'],
                'academic_year'=>['required'],

            ]);
            
            Student::create([
                'name' => ['en'=>$request->name_en , 'ar'=>$request->name],
                'email'=>$request->email,
                'password' => Hash::make($request->password),
                'birthday'=>$request->birthday,
                'gender'=>$request->gender,
                'college_id'=>$request->college_id,
                'classroom_id'=>$request->classroom_id,
                'section_id'=>$request->section_id,
                'academic_year'=>$request->academic_year,
            ]);
            
            toastr()->success('success');

            return redirect()->route('student.index');
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }

            // if ($request->hasfile('photos')) {
            //     foreach ($request->file('photos') as $file) {
            //         $name = $file->getClientOriginalName();
            //         $file->storeAs('attachments/students/'.$student->name, $file->getClientOriginalName(), 'upload_attachments');

            //         // insert in image_table
            //         Image::create([
            //             'filename'=>$name,
            //             'imageable_id'=>$student->id,
            //             'imageable_type'=>Student::class,
            //         ]);
            //     }
            // }
        // DB::commit(); // insert data

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student=Student::findOrfail($id);

        return view('pages.student.show',['student'=>$student]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student=Student::find($id);
        return view('pages.student.edit',['student' => $student,
        'colleges'=>College::all(),
        'classrooms'=>Classroom::all(),
        'sections'=>Section::all(),
    ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        try{
            $this->validate($request,[
                'name' =>['required','max:20',],
                'email'=>['string','required','email','max:255'],
                'password' =>['string','required','min:8'],
                'birthday'=>['required'],
                'gender'=>['required'],
                'college_id'=>['required'],
                'classroom_id'=>['required'],
                // 'section_id'=>['required'],
                'academic_year'=>['required'],
    
            ]);
    
           
            $student->update([
                'name' =>$request->name,
                'email'=>$request->email,
                'password' => Hash::make($request->password),
                'birthday'=>$request->birthday,
                'college_id'=>$request->college_id,
                'classroom_id'=>$request->classroom_id,
                'section_id'=>$request->section_id,

                'academic_year'=>$request->academic_year
        ]);

            toastr()->success('UPDATE success');

            return redirect()->route('student.index');
        }catch(\Exception $e){
            toastr()->error($e->getMessage());
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
    
           }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Student $student)
    {
        $student=Student::find($request->id)->delete();
        return redirect()->back();
    }
    
    public function Get_classrooms($id){

        $list_classes = Classroom::where("college_id", $id)->pluck("name", "id");
        return $list_classes;

    }

    public function Upload_attachment(Request $request , Student $student){
    if ($request->hasfile('photos')) {
        foreach ($request->file('photos') as $file) {
            $name = $file->getClientOriginalName();
            $file->storeAs('attachments/students/'.$request->name, $file->getClientOriginalName(), 'upload_attachments');

            // insert in image_table
            Image::create([
                'filename'=>$name,
                'imageable_id'=>$request->student_id,
                'imageable_type'=>Student::class,
            ]);
        }
    }
    toastr()->success('UPDATE success');

    return redirect()->route('student.show',$request->student_id);
}


    public function Download_attachment($studentname , $filename){


        return response()->download(public_path('attachments/students/'.$studentname.'/'.$filename));

    }




        public function Delete_attachment(Request $request)
        {
            // Delete img in server disk
            Storage::disk('upload_attachments')->delete('attachments/students/'.$request->name.'/'.$request->filename);

            // Delete in data
            image::where('id',$request->id)->where('filename',$request->filename)->delete();

            toastr()->error('DELETE FILE SUCCESSFUL');
            return redirect()->route('student.show',$request->student_id);
        }



}
