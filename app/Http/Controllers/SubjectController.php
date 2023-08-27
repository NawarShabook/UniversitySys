<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Section;
use App\Models\College;
use App\Models\Classroom;
use App\Models\Teacher;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;

class SubjectController extends Controller
{

    public function __construct()
    {
        // $this->middleware('role:admin')->only(['method1', 'method2']); // Apply to method1 and method2
        $this->middleware('role:admin')->except(['index','show', 'edit_mark', 'show_student_subjects']); // Apply to other methods except method1 and method2
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function index()
    {

        
        $subjects = Subject::all();
        return view('pages.subject.index', compact('subjects', 'subjects'));
        
        
    }

    public function show_student_subjects($id)
    {
        $student = Student::where('id', $id)->first();
        return view('pages.subject.show_student_subjects',[
                'student' => $student,
        ]);

    }
    // public function get_stu_sub($subject_id)
    // {
    //     $subject = Subject::find($subject_id);   
    //     $students = $subject->students;
    //     return view('pages.student.index',[
    //     'students' => $students,
    //     ]);
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.subject.create',[
            'colleges'=>College::all(),
            'classrooms'=>Classroom::all(),
            'sections'=>Section::all(),
            'teachers'=>Teacher::all(),
    
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
        try{
            $request->validate([
                'name' =>['required','max:20',],
                'college_id'=>['required'],
                'classroom_id'=>['required'],
                'section_id'=>['required'],

            ]);
            
            $subject=Subject::create([
                'name' => ['en'=>$request->name_en , 'ar'=>$request->name],
                'note' => $request->note,
                'college_id'=>$request->college_id,
                'classroom_id'=>$request->classroom_id,
                'section_id'=>$request->section_id,
                'teacher_id'=>$request->teacher_id,
            ]);
            
            $students=Student::where('section_id',$request->section_id)->get();
            foreach ($students as $student) {
                $student->subjects()->attach($subject->id);
            }
            toastr()->success('success');

            return redirect()->route('subject.index');
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subject = Subject::where('id', $id)->first();
        $user=Auth::user();
        $role=$user->roles->first()->name;
        if($role=='student' || ($role=='teacher' && $user->id != $subject->teacher->user->id))
        {
            toastr()->error("you don't have permission");
            return redirect()->back()->withErrors("you don't have permission");
        }

        else
        {
            return view('pages.subject.show', ['subject'=>$subject]);
        }

    }

    public function get_subjects_for($for_type, $id )
    {
       
        $subjects = Subject::where($for_type, $id)->get();
         return view('pages.subject.index', ['subjects'=> $subjects, 'for_type'=>$for_type]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {

        return view('pages.subject.edit',[
            'subject' => $subject,
            'colleges'=>College::all(),
            'classrooms'=>Classroom::all(),
            'sections'=>Section::all(),
            'teachers'=>Teacher::all(),
    
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        try{
            $request->validate([
                'name' =>['required','max:20',],
                'college_id'=>['required'],
                'classroom_id'=>['required'],
                'section_id'=>['required'],

            ]);
            
            $subject->update([
                'name' => ['en'=>$request->name_en , 'ar'=>$request->name],
                'note' => $request->note,
                'college_id'=>$request->college_id,
                'classroom_id'=>$request->classroom_id,
                'section_id'=>$request->section_id,
                'teacher_id'=>$request->teacher_id,
            ]);
            // dd($subject);
            toastr()->success('UPDATE success');

            return redirect()->route('subject.index');
        }catch(\Exception $e){
            toastr()->error($e->getMessage());
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
    
           }
    }

    public function edit_mark(Request $request)
    {
       
        try{
            $request->validate([
                'mark' =>['required', 'numeric', 'min:0' ,'max:100',],
                'student_id'=>['required'],
                'subject_id'=>['required'],
            ]);
            
            $student=Student::where('id',$request->student_id)->first();

            $subject = Subject::where('id', $request->subject_id)->first();
            $user=Auth::user();
            $role=$user->roles->first()->name;
            if($role=='student' || ($role=='teacher' && $user->id != $subject->teacher->user->id))
            {
                toastr()->error("you don't have permission");
                return redirect()->back()->withErrors("you don't have permission");
            }
            $student->subjects()->sync([$request->subject_id => ['mark' => $request->mark]]);
            
            toastr()->success('success');

            return redirect()->back();
        }catch(\Exception $e){
            toastr()->error($e->getMessage());
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        $subject=Subject::findOrFail($subject->id);
        $subject->delete();
        toastr()->success('Delete Subject success');
        return redirect()->route('subject.index');
    }
}
