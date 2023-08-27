<?php

namespace App\Http\Controllers\Student;

use App\Models\DormStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
class DormStudentController extends Controller
{
    public function __construct()
    {
        // $this->middleware('role:admin')->only(['method1', 'method2']); // Apply to method1 and method2
        $this->middleware('role:admin')->except(['index']); // Apply to other methods except method1 and method2
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $dorm_students=DormStudent::all();
        return view('pages.student.dorm.index',[
            'dorm_students' => $dorm_students,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
                'city' =>['required','max:20',],
                'unit_name' =>['required','max:20'],
                'room_number'=>['numeric', 'min:0'],
                'student_id'=>['required'],
                
            ]);
            
            $dorm_student= DormStudent::create([
                'city' => $request->city, 
                'unit_name'=>$request->unit_name,
                'room_number'=>$request->room_number,
                'student_id'=>$request->student_id,
            ]);
            toastr()->success('success');

            return redirect()->route('dorm.index');
        }catch(\Exception $e){
            toastr()->error($e->getMessage());
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DormStudent  $dormStudent
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student=DormStudent::findOrfail($id);

        return view('pages.student.dorm.show',['student'=>$student]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DormStudent  $dormStudent
     * @return \Illuminate\Http\Response
     */
    public function edit(DormStudent $dormStudent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DormStudent  $dormStudent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $dorm_student=DormStudent::findOrfail($id);

            $request->validate([
                'city' =>['required','max:20',],
                'unit_name' =>['required','max:20'],
                'room_number'=>['numeric', 'min:0'],
            ]);
            
            $dorm_student->update([
                'city' => $request->city, 
                'unit_name'=>$request->unit_name,
                'room_number'=>$request->room_number,
            ]);

            toastr()->success('UPDATE success');

            return redirect()->route('dorm.index');
        }catch(\Exception $e){
            toastr()->error($e->getMessage());
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
    
           }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DormStudent  $dormStudent
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student=DormStudent::findOrFail($id);
        $student->delete();
        toastr()->success('Delete student success');
        return redirect()->route('dorm.index');
    }
}
