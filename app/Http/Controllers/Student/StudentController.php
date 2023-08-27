<?php

namespace App\Http\Controllers\Student;

use App\Models\Image;
use App\Models\Teacher;
use App\Models\Section;
use App\Models\Student;
use App\Models\DormStudent;
use App\Models\DormStudentReq;
use App\Models\College;
use App\Models\Classroom;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
class StudentController extends Controller
{
    public function __construct()
    {
        // $this->middleware('role:admin')->only(['method1', 'method2']); // Apply to method1 and method2
        $this->middleware('role:admin')->except(['index','show']); // Apply to other methods except method1 and method2
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $students=Student::all();   

        return view('pages.student.index',[
        'students' => $students,
        'colleges'=>College::all(),
        'from_method' => "كل الطلاب"
        ]);
    }

    public function get_trashed_stu()
    {
        $trashedStudents = Student::onlyTrashed()->get();

        return view('pages.student.trash', ['students' => $trashedStudents]);

       
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $user=User::where('id', $user_id)->first();
        // return view('pages.student.create',[
        // 'user'=>$user,
        // 'colleges'=>College::all(),
        // 'classrooms'=>Classroom::all(),
        // 'sections'=>Section::all(),

        // ]);
    }

    public function create_stu_user($user_id)
    {
        $user=User::where('id', $user_id)->first();
        return view('pages.student.create',[
        'user'=>$user,
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
                'name' =>['required','max:20',],
                'user_id' =>['required',],
                'email'=>['string','required','email','max:255'],
                'birthday'=>['required'],
                'gender'=>['required'],
                'college_id'=>['required'],
                'classroom_id'=>['required'],
                'section_id'=>['required'],
                'academic_year'=>['required'],
            ]);
            
            $student= Student::create([
                'name' => ['en'=>$request->name_en , 'ar'=>$request->name],
                'email'=>$request->email,
                'birthday'=>$request->birthday,
                'gender'=>$request->gender,
                'user_id' => $request->user_id,
                'college_id'=>$request->college_id,
                'classroom_id'=>$request->classroom_id,
                'section_id'=>$request->section_id,
                'academic_year'=>$request->academic_year,
            ]);
            toastr()->success('success');

            return redirect()->route('student.index');
        }catch(\Exception $e){
            toastr()->error($e->getMessage());
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
        $user=Auth::user();
        
        $user_role=$user->roles->first()->name;
        
        if($user_role=='admin')
        {
            
            $student=Student::findOrfail($id);
            return view('pages.student.show',['student'=>$student]);
        }
        elseif($user->student)
        {
            if($user->student->id == $id)
            {
                $student=Student::findOrfail($id);
                return view('pages.student.show',['student'=>$student]);
            }
        }
        else
        {
            toastr()->error("you have not permission");
            return redirect()->back()->withErrors("you have not permission");
        }
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
                'section_id'=>['required'],
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
        try {
            $student=Student::find($request->id)->delete();
            
            toastr()->success('Student deleted successfully');
            return redirect()->route('student.index')->with('success', 'Student deleted permanently');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('student.index')->with('error', 'Student not found in trash');
        }

    }

    public function restore_student($id)
    {
        try {
            $restoredStudent = Student::onlyTrashed()->findOrFail($id);
            $restoredStudent->restore();
            toastr()->success('Student restored successfully');
            return redirect()->route('student.index')->with('success', 'Student restored successfully');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('get_trashed_stu')->with('error', 'Student not found in trash');
        }
    }

    public function force_delete($id)
    {
        try {
            $deletedStudent = Student::withTrashed()->findOrFail($id);
            $deletedStudent->forceDelete();
            toastr()->success('Student deleted successfully');
            return redirect()->route('get_trashed_stu')->with('success', 'Student deleted permanently');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('get_trashed_stu')->with('error', 'Student not found in trash');
        }
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
