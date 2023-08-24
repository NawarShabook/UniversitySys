<?php

namespace App\Http\Controllers;

use App\Models\College;
use App\Models\Classroom;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Requests\StoreClassroom;

class ClassroomController extends Controller
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
        $classrooms =Classroom::all();
        $colleges=College::all();
        return view('pages.classroom.index', compact('classrooms', 'colleges'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $List_Classes = $request->List_Classes;

        try {
          
            $this->validate($request,[
                'name' =>['required','in:"1","2","3","4","5","6"'],
                'college_id' =>'required'
            ]);
            $newClassroom = Classroom::create([
                'name' => $request->name,
                'college_id'=>$request->college_id,
            ]);

            Section::create([
                'name' => ['en'=>'general' , 'ar'=>'عام'],
                'college_id'=>$request->college_id,
                'classroom_id'=>$newClassroom->id,
            ]);


            // $validated = $request->validated();
            // foreach ($List_Classes as $List_Class) {

            //     $My_Classes = new Classroom();

            //     $My_Classes->name = ['en' => $List_Class['name_en'], 'ar' => $List_Class['name']];

            //     $My_Classes->college_id = $List_Class['college_id'];

            //     $My_Classes->save();

            // }
            toastr()->success('add ClassRoom success');

            return redirect()->route('classroom.index');
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function show(Classroom $classroom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function edit(Classroom $classroom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classroom $classroom)
    {
        try {
            $cn_ar=Classroom::where('name->'.'ar', $request->name)->where('id','<>', $request->id)
            ->where('college_id',$request->college_id)->first();

            $cn_en=Classroom::where('name->'.'en', $request->name_en)->where('id','<>', $request->id)
            ->where('college_id',$request->college_id)->first();
            if($cn_ar || $cn_en)
            {
                toastr()->error('dublicate Classroom');
                return redirect()->route('classroom.index');
            }


            $classroom=Classroom::findOrFail($request->id);
            $classroom->update([
                $classroom->name = ['en'=>$request->name_en , 'ar'=>$request->name],
                $classroom->college_id=$request->college_id,
            ]);
            toastr()->success('UPDATE ClassRoom success');

            return redirect()->route('classroom.index');
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Classroom $classroom)
    {
        $classroom=Classroom::findOrFail($request->id)->delete();
        toastr()->success('delete ClassRoom success');

        return redirect()->route('classroom.index');
    }
}
