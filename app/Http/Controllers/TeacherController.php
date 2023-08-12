<?php

namespace App\Http\Controllers;

use App\Models\College;
use App\Models\Section;
use App\Models\Teacher;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $teachers=Teacher::all();
        $colleges=College::all();
        // if ($request->has('search')) {
        //     $teachers = Teacher::where('name', 'like', "%{$request->search}%")->orWhere('email', 'like', "%{$request->search}%")->get();
        // }

        return view('pages.teacher.index',compact('teachers','colleges'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.teacher.create',[  
        'colleges'=>College::all(),
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
                'name' =>['string','required','max:20',],
                'email'=>['string','required','email','max:255', 'unique:teachers'],
                'password' =>['string','required','min:8'],
                'gender' =>['string','required'],
                'birthday' =>['date','required'],
                'college_id'=>['required'],
                'level'=>['required'],
            
            ]);

            Teacher::create([
                'name' => ['en'=>$request->name_en , 'ar'=>$request->name],
                'email'=>$request->email,
                'password' => Hash::make($request->password),
                'gender'=>$request->gender,
                'birthday'=>$request->birthday,
                'college_id'=>$request->college_id,
                'level'=>$request->level,
            ]);
            toastr()->success('success');

            return redirect()->route('teacher.index');   
        }catch(\Exception $e){
            toastr()->error($e->getMessage());
            return redirect()->route('teacher.index');   
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $teacher= Teacher::find($id);
        return view('pages.teacher.edit',['teacher'=>$teacher,
        'colleges'=>College::all(),

    ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        
       try{
        $request->validate([
            'name' =>['string','required','max:20',],
            'email'=>['string','required','email','max:255', 'unique:teachers'],
            'password' =>['string','required','min:8'],
            'gender' =>['string','required'],
            'birthday' =>['date','required'],
            'college_id'=>['required'],
            'level'=>['required'],
        
        ]);
        $teacher->update([
            'name' => $request->name,
            'email'=>$request->email,
            'password' =>$request->password,
            'college_id'=>$request->college_id,
            'gender'=>$request->gender,
            'level'=>$request->level,
            'birthday'=>$request->birthday,
           ]);
           toastr()->success('success');
    
           return redirect()->route('teacher.index');

       }catch(\Exception $e){
        toastr()->error($e->getMessage());
        return redirect()->back()->withErrors(['error'=>$e->getMessage()]);

       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Teacher $teacher)
    {
        teacher::findOrFail($request->id)->delete();
        toastr()->success('Delete Teacher successfully');
        return redirect()->back();
    }
}
