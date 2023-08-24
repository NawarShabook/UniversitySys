<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Section;
use App\Models\College;
use App\Models\Classroom;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SubjectController extends Controller
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

        
        $subjects = Subject::all();
        return view('pages.subject.index', compact('subjects', 'subjects'));
        
        
    }


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
            
            Subject::create([
                'name' => ['en'=>$request->name_en , 'ar'=>$request->name],
                'note' => $request->note,
                'college_id'=>$request->college_id,
                'classroom_id'=>$request->classroom_id,
                'section_id'=>$request->section_id,
                'teacher_id'=>$request->teacher_id,
            ]);
            
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
    public function show($for_type, $id )
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
