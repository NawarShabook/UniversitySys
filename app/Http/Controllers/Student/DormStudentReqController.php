<?php

namespace App\Http\Controllers\Student;

use App\Models\DormStudentReq;
use App\Models\DormStudent;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DormStudentReqController extends Controller
{
    public function __construct()
    {
        // $this->middleware('role:admin')->only(['method1', 'method2']); // Apply to method1 and method2
        $this->middleware('role:admin')->only(['update']); // Apply to method1 and method2
        // $this->middleware('role:admin')->except(['index']); // Apply to other methods except method1 and method2
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $dorm_students_req=DormStudentReq::all();
        return view('pages.student.dorm_req.index',[
            'dorm_students_req' => $dorm_students_req,
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
                'student_id'=>['required'],
            ]);
            $user=Auth::user();
            $student=Student::where('id',$request->student_id)->first();
            // dd($student);
            if($student->user->id != $user->id)
            {
                toastr()->error("you have not access to this user");
                return redirect()->back()->withErrors(['error'=>"you have not access to this user"]);
            }
            elseif($user->student->dorm_student)
            {
                toastr()->error("you are really in dorm");
                return redirect()->back()->withErrors(['error'=>"you are really in dorm"]);
            }
            elseif($user->student->dorm_student_req)
            {
                toastr()->error("you have sent request really please wait");
                return redirect()->back()->withErrors(['error'=>"you have sent request really please wait"]);
            }

            $dorm_student_req= DormStudentReq::create([
                'city' => $request->city, 
                'student_id'=>$request->student_id,
            ]);
            toastr()->success('success');

            return redirect()->route('dashboard');
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
        $student=DormStudentReq::findOrfail($id);

        return view('pages.student.dorm_req.show',['student'=>$student]);
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
            $dorm_student_req=DormStudentReq::findOrfail($id);

            $request->validate([
                'city' =>['required','max:20',],
                'status' =>['required', 'numeric','in:1,2'], //0 value mean not response yet, 1 value mean agree, 2 value mean reject 
            ]);
            
            $dorm_student_req->update([
                'city' => $request->city, 
                'status' => $request->status, 
                'note'=>$request->note,
            ]);
            
            if($request->status==2) //test if response is reject
            {
                toastr()->success('request rejected successfully');
                return redirect()->route('dorm_req.index');
            }

            $request->validate([
                'unit_name' =>['required','max:20'],
                'room_number'=>['numeric', 'min:0'],
            ]);
            $dorm_student= DormStudent::create([
                'city' => $request->city, 
                'unit_name'=>$request->unit_name,
                'room_number'=>$request->room_number,
                'student_id'=>$request->student_id,
            ]);

            toastr()->success('UPDATE success');

            return redirect()->route('dorm_req.index');
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
        $student_req=DormStudentReq::findOrFail($id);
        $student_req->delete();
        toastr()->success('Delete student_req success');
        return redirect()->route('dorm_req.index');

    }
}
