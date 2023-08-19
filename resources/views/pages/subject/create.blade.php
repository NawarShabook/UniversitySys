@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    Add Subject
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    Add Subject
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if(session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ session()->get('error') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">


                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="col-xs-12">
                        <div class="col-md-12">
                            <br>
                            <form action="{{route('subject.store')}}" method="post" autocomplete="off" enctype="multipart/form-data" >
                             @csrf
                                

                            <div class="form-row">
                                <div class="col">
                                    <label for="title">{{__('general.name_ar')}}</label>
                                    <input required type="text" name="name" class="form-control">
                                    @error('name_ar')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="title">{{__('general.name_en')}}</label>
                                    <input required type="text" name="name_en" class="form-control">
                                    @error('name_en')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col">
                                    <label for="title">{{__('college.note')}}</label>
                                    <input type="text" name="note" class="form-control">
                                </div>
                            </div>
                            <br>
                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="inputCity">{{__('general.college')}}</label>
                                    <select  class="custom-select my-1 mr-sm-2" name="college_id" required>
                                        <option value="" selected disabled >اختر الكلية</option>
                                        @foreach($colleges as $college)
                                            <option value="{{$college->id}}">{{$college->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('college_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col">
                                    <label for="inputCity">{{__('general.level')}}</label>
                                    <select  class="custom-select my-1 mr-sm-2" name="classroom_id" required>
                                        <option value="" selected disabled >اختر الفرقة الدراسية</option>
                                       
                                    </select>
                                    @error('classroom_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col">
                                    <label for="inputCity">{{__('general.section')}}</label>
                                    <select  class="custom-select my-1 mr-sm-2" name="section_id">
                                        <option value="" selected disabled>اختر  قسم الكلية</option>
                                        
                                    </select>
                                    @error('section_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group col">
                                    <label for="inputState">{{__('teacher.teacher')}}</label>
                                    <select class="custom-select my-1 mr-md-2" name="teacher_id" required>
                                        <option value="" selected disabled>{{__('general.choose').' '.__('teacher.teacher')}}</option>
                                    
                                    </select> 
                                    @error('teacher_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                
                
                            </div>
                            <br>
                            

                            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">Next</button>
                    </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
