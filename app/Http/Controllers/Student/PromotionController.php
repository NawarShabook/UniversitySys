<?php

namespace App\Http\Controllers\Student;

use App\Models\Section;
use App\Models\Student;
use App\Models\College;
use App\Models\Classroom;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promotions=Promotion::all();
    
        return view('pages.student.promotion.index', [
            'promotions' => Promotion::all(),
        ]);
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
            return view('pages.student.promotion.create', [
                'promotions' => Promotion::all(),
                'students'=>Student::all(),
                'student' => $student,
                'classrooms'=>Classroom::all(),
                'sections'=>Section::all(),
            ]);
        }
        else{
            return view('pages.student.promotion.create', [
            'promotions' => Promotion::all(),
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

        DB::beginTransaction();
        try {
            
        
        Student::where('id', $request->student_id)->first()
            ->update([
                'classroom_id'=>$request->classroom_id_new,
                'section_id'=>$request->section_id_new,
                'academic_year'=>$request->academic_year_new,
            ]);

            // dd($request);
        Promotion::updateOrCreate([
            'student_id'=>$request->student_id,
            'from_college_id'=>$request->college_id,
            'from_classroom_id'=>$request->classroom_id,
            'from_section_id'=>$request->section_id,
            'to_college_id'=>$request->college_id_new,
            'to_classroom_id'=>$request->classroom_id_new,
            'to_section_id'=>$request->section_id_new,
            'academic_year'=>$request->academic_year,
            'academic_year_new'=>$request->academic_year_new,
        ]);
        
        DB::commit();
        toastr()->success('success');

        return redirect()->route('promotion.index');
        }catch(\Exception $e){
            DB::rollback();
            toastr()->error($e->getMessage());
            return redirect()->back()->with('error_promotions', $e->getMessage());
            // return redirect()->back()->withErrors(['error' ]);

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function show(Promotion $promotion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function edit(Promotion $promotion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Promotion $promotion)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promotion $promotion,Request $request)
    {
        DB::beginTransaction();

        try {

            // التراجع عن الكل
            if($request->page_id ==1){

            $promotion = Promotion::all();
            foreach ($promotion as $promotion){

                //التحديث في جدول الطلاب
                $ids = explode(',',$promotion->student_id);
                Student::whereIn('id', $ids)
                ->update([
                'classroom_id'=>$promotion->from_classroom_id,
                'section_id'=> $promotion->from_section_id,
                'academic_year'=>$promotion->academic_year,
            ]);

                //حذف جدول الترقيات
                Promotion::truncate();

            }
                DB::commit();
                toastr()->error('DELETE');
                return redirect()->back();

            }

            else{

                $promotion = Promotion::findorfail($request->id);
                Student::where('id', $promotion->student_id)
                    ->update([
                        'classroom_id'=>$promotion->from_classroom_id,
                        'section_id'=> $promotion->from_section_id,
                        'academic_year'=>$promotion->academic_year,
                    ]);


                Promotion::destroy($request->id);
                DB::commit();
                toastr()->error('DELETE');
                return redirect()->back();

            }

        }

        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
