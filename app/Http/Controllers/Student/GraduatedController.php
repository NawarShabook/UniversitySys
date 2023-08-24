<?php

namespace App\Http\Controllers\Student;

use App\Models\Student;
use App\Models\College;
use App\Models\Classroom;
use App\Models\Section;
use App\Models\Graduated;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GraduatedController extends Controller
{
    public function __construct()
    {
        // $this->middleware('role:admin')->only(['method1', 'method2']); // Apply to method1 and method2
        $this->middleware('role:admin')->except(['']); // Apply to other methods except method1 and method2
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $graduateds=Graduated::all();
        
        foreach ($graduateds as $value) {

        }
        return view('pages.student.graduated.index',['graduateds'=>$graduateds]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id=0)
    {
        if($id>0)
        {
            $student=Student::where('id',$id)->first();
            return view('pages.student.graduated.create', [
                'students'=>Student::all(),
                'student' => $student,
                'classrooms'=>Classroom::all(),
                'sections'=>Section::all(),
            ]);
        }
        else{
            return view('pages.student.graduated.create', [
            'students'=>Student::all(),
            'classrooms'=>Classroom::all(),
            'sections'=>Section::all(),
        ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $students= Student::all();
        if($students->count() < 1){
            return redirect()->back()->with('error','لا يوجد بيانات في جدول الطلاب ');
        }
        try{
            $request->validate([
                // 'name' =>['required','max:20',],
                'student_id'=>['string','required'],
                'college_id'=>['required'],
                'classroom_id'=>['required'],
            ]);
            
            Graduated::create([
                'student_id' => $request->student_id,
                'college_id'=>$request->college_id,
                'classroom_id' => $request->classroom_id,
            ]);
            $student=Student::where('id',$request->student_id)->first();
            $student->delete();
            toastr()->success('success');

            return redirect()->route('Graduateds.index');
        }catch(\Exception $e){
            toastr()->error($e->getMessage());
            return redirect()->back()->with('error',$e->getMessage());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        // dd($request);
        $graduated=Graduated::findOrFail($id);
        Student::onlyTrashed()->where('id', $graduated->student->id)->first()->restore();
        $graduated->delete();
        toastr()->success('success back');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $graduated= Graduated::findOrFail($request->id)->delete();
        toastr()->success('Delete graduated successfully');
        return redirect()->route('Graduateds.index');
    }
}
