<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\College;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $colleges= College::with(['sections'])->get();
        $list_colleges= College::all();

        // $sections=Section::all();
        return view('pages.section.index', compact('colleges', 'list_colleges'));
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
            $sn_ar=Section::where('name->'.'ar', $request->name)->where('classroom_id',$request->classroom_id)
            ->where('college_id',$request->college_id)->first();
            $sn_en=Section::where('name->'.'en', $request->name)->where('classroom_id',$request->classroom_id)
            ->where('college_id',$request->college_id)->first();
            if($sn_ar || $sn_en)
            {
                toastr()->error('dublicate section');
                return redirect()->route('sections.index');
            }

            Section::create([
            'name' => ['en'=>$request->name_en , 'ar'=>$request->name],
            'status'=> 1,
            'college_id' => $request->college_id,
            'classroom_id' => $request->classroom_id,
        ]);
        toastr()->success('CREATE ClassRoom success');
        return redirect()->route('sections.index');
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Section $section)
    {

        try{
            $sn_ar=Section::where('name->'.'ar', $request->name)->where('id','<>', $request->id)
            ->where('classroom_id',$request->classroom_id)
            ->where('college_id',$request->college_id)->first();

            $sn_en=Section::where('name->'.'en', $request->name)->where('id','<>', $request->id)
            ->where('classroom_id',$request->classroom_id)
            ->where('college_id',$request->college_id)->first();
            if($sn_ar || $sn_en)
            {
                toastr()->error('dublicate section');
                return redirect()->route('sections.index');
            }

            $section=Section::findOrFail($request->id);
             $section->update([
                'name' => ['en'=>$request->name_en , 'ar'=>$request->name],
                'status'=>1,
                'college_id' => $request->college_id,
                'classroom_id' => $request->classroom_id,
            ]);
            toastr()->success('UPDATE ClassRoom success');
            return redirect()->route('sections.index');
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $section=Section::findOrFail($request->id);
        $section->delete();
        toastr()->success('DELETE ClassRoom success');
        return redirect()->route('sections.index');

    }

    public function getclasses($id)
    {
        $list_classes = Classroom::where("college_id", $id)->pluck("name", "id");

        return $list_classes;
    }
}
