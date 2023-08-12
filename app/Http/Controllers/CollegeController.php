<?php

namespace App\Http\Controllers;

use toastr;
use App\Models\College;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class CollegeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colleges= College::all();
        
       
        return view('pages.college.index', compact('colleges'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.college.create');
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
            $fn_ar=College::where('name->'.'ar', $request->name)->first();
            $fn_en=College::where('name->'.'en', $request->name_en)->first();
            if($fn_ar || $fn_en)
            {
                toastr()->error('dublicate college name');
                return redirect()->route('college.index');
            }
            College::create([
                'name' => ['en'=>$request->name_en , 'ar'=>$request->name],
                'note'=>$request->note,
            ]);
            toastr()->success('add college success');

            return redirect()->route('college.index');

        }catch(\Exception $e){
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\College  $college
     * @return \Illuminate\Http\Response
     */
    public function show(college $college)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\College  $college
     * @return \Illuminate\Http\Response
     */
    public function edit(college $college)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\college  $college
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, college $college)
    {
       try{
        $fn_ar=college::where('name->'.'ar', $request->name)->where('id','<>', $request->id)->first();
        $fn_en=college::where('name->'.'en', $request->name_en)->where('id','<>', $request->id)->first();
        if($fn_ar || $fn_en)
        {
            toastr()->error('dublicate college name');
            return redirect()->route('college.index');
        }

        $college= College::findOrFail($request->id);
        $college->update([
            $college->name=['en'=>$request->name_en, 'ar'=>$request->name],
            $college->note=$request->note
        ]);
        toastr()->success('Updated College successfully');
        return redirect()->route('college.index');


       }catch(\Exception $e){
        return redirect()->back()->withErrors(['error'=>$e->getMessage()]);

       }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\College  $college
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, College $college)
    {
        $college= College::findOrFail($request->id)->delete();
        toastr()->success('Delete College successfully');
        return redirect()->route('college.index');

    }
}
